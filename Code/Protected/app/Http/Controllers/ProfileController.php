<?php

namespace Podobri\Http\Controllers;

use Auth;
use File;
use Podobri\Models\User;
use Carbon\Carbon;
use Podobri\Models\Comment;
use Podobri\Models\Problem;
use Podobri\Models\Picture;
use Podobri\Models\Solution;
use Podobri\Models\Like;
use Illuminate\Http\Request;
use DB;

class ProfileController extends Controller {

    public function getProfile($id) {
        $user = User::where('id', $id)->first();
        if (!$user) {
            abort(404);
        }

        $problems = $user->problems()->orderBy('created_at', 'desc')->paginate(10);
        if($user->picture){
            $img = 'https://podobri.eu/images/userphotos/'.$user->picture->picture_name;
        }else{
            $img=$user->getAvatarUrl();
        }
        Carbon::setLocale('bg');
        return view('user.index')
                        ->with('problems', $problems)->with('user', $user)->with('img', $img)
                        ->with('title', '' . $user->getFirstAndLastName() . ' | Подобри')
                        ->with('description', $user->getAbout()?:'Профил на ' . $user->getFirstAndLastName() . ' в системата на Подобри');
    }

    public function getEdit() {

        $cities = DB::table('cities')->orderBy('city_name', 'asc')->get();

        return view('profile.edit')
                        ->with('cities', $cities)
                        ->with('title', 'Редакция на профил | Подобри')
                        ->with('description', 'Страница за обновяване, допълване и коригиране на данни за потребител.');
    }

    public function postEdit(Request $request) {
        if ($request->input('day') || $request->input('month') || $request->input('year')) {
            if ($request->input('day') && $request->input('month') && $request->input('year')) {
                $months = [
                    '1' => 'Януари', '2' => 'Февруари', '3' => 'Март',
                    '4' => 'Април', '5' => 'Май', '6' => 'Юни',
                    '7' => 'Юли', '8' => 'Август', '9' => 'Септември',
                    '10' => 'Октомври', '11' => 'Ноември', '12' => 'Декември'
                ];

                foreach ($months as $key => $value) {
                    if ($request->input('month') == $value) {
                        $user_month = $key;
                        break;
                    }
                }

                $dt = $user_month . '/' . $request->input('day') . '/' . $request->input('year'); // с '.' или с '/'

                $dt = preg_replace("([.]+)", "/", $dt);

                $test_arr = explode('/', $dt);

                if (!checkdate($test_arr[0], $test_arr[1], $test_arr[2]) || !preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}/", $dt)) {
                    return redirect()->back()->with('info', 'Невалидна дата! Опитайте отново, моля.');
                }
            } else {
                return redirect()->back()->with('info', 'В случай на попълване, трите полета за дата на раждане са задължителни.');
            }
        }

        $cities = DB::table('cities')->get();

        $is_valid = false;

        if ($request->input('location')) {
            foreach ($cities as $city) {
                if ($city->city_name == $request->input('location')) {
                    $is_valid = true;
                    break;
                }
            }
        }

        if ($request->input('location') == null) {
            $is_valid = true;
        }

        if ($is_valid == false) {
            return redirect()->back()->with('info', 'Не се прави така!');
        }

        $this->validate($request, [
            'first_name' => 'required|alpha|max:20|min:3',
            'last_name' => 'required|alpha|max:20|min:3',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'day' => 'integer',
            'month' => 'alpha',
            'year' => 'integer',
            'location' => 'string',
            'phone' => 'digits:10',
            'about' => 'string|min:10',
            'user_photo' => 'image|mimes:png,jpg,jpeg|between:0,3584',
        ]);

        $problem_photo = $request->file('user_photo');

        if (is_uploaded_file($problem_photo)) {
            $file = pathinfo($problem_photo->getClientOriginalName());
            $destinationPath = './images/userphotos';
            $filename = $file['filename'] . '_' . str_random(8) . '.' . $problem_photo->getClientOriginalExtension();
            $problem_photo->move($destinationPath, $filename);

            Picture::create([
                'picture_name' => $filename,
                'user_id' => Auth::id(),
            ]);
        }

        Auth::user()->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'day' => $request->input('day'),
            'month' => $request->input('month'),
            'year' => $request->input('year'),
            'location' => $request->input('location'),
            'phone' => $request->input('phone'),
            'about' => clean($request->input('about')),
        ]);

        return redirect()->route('profile.edit')
                        ->with('info', 'Профилът ви беше редактиран успешно!');
    }

    public function postDelete() {
        $account = User::where('id', Auth::user()->id)->first();

        if (!$account) {
            return redirect()->back();
        }

        $picture = Picture::where('user_id', $account->id)->first();

        if ($picture) {
            File::delete('./images/userphotos/' . $picture->picture_name);
            $picture->delete();
        }


        Problem::where('user_id', $account->id)->update([
            'user_id' => null,
        ]);

        Solution::where('user_id', $account->id)->update([
            'user_id' => null,
        ]);

        Comment::where('user_id', $account->id)->delete();
        Like::where('user_id', $account->id)->delete();

        Auth::logout();

        $account->delete();

        return redirect()
                        ->route('problems.index');
    }

    public function profileImageDelete() {
        $image = Picture::where('user_id', Auth::user()->id)->first();

        if (!$image) {
            return redirect()->back();
        }

        File::delete('./images/userphotos/' . $image->picture_name);
        $image->delete();

        return redirect()->route('profile.edit')->with('info', 'Профилната ви снимка беше изтрита.');
    }

    public function getFilter($id, $action) {
        $user = User::where('id', $id)->first();
        if (!$user) {
            abort(404);
        }

        if ($action == 'solved') {

            $problems = $user->problems()->whereExists(function($query) {
                                $query->select(DB::raw('*'))
                                ->from('solutions')
                                ->whereRaw('solutions.problem_id = problems.id')
                                ->where('solutions.solution_condition', 2);
                            })
                            ->orderBy('created_at', 'DESC')->paginate(10);

            $action = 'Решени проблеми';
        } elseif ($action == 'unsolved') {

            $currentSolutions = Solution::lists('problem_id');

            $problems = $user->problems()->whereNotIn('problems.id', $currentSolutions)->orderBy('created_at', 'DESC')->paginate(10);

            $action = 'Нерешени проблеми';
        } elseif ($action == 'pending') {

            $problems = $user->problems()->whereExists(function($query) {
                                $query->select(DB::raw('*'))
                                ->from('solutions')
                                ->whereRaw('solutions.problem_id = problems.id')
                                ->where('solutions.solution_condition', 1);
                            })
                            ->orderBy('created_at', 'DESC')->paginate(10);

            $action = 'Чакащи потвърждение проблеми';
        } else {
            abort(404);
        }

        Carbon::setLocale('bg');
        return view('user.index')
                        ->with('problems', $problems)
                        ->with('user', $user)
                        ->with('title', '' . $user->getFirstAndLastName() . ' | ' . $action . ' | Подобри')
                        ->with('description', 'Профил на ' . $user->getFirstAndLastName() . ' в системата на Подобри');
    }

}
