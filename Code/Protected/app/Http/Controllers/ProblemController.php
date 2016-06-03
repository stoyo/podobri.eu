<?php namespace Podobri\Http\Controllers;

use Image;
use Auth;
use File;
use DB;
use Podobri\Models\Problem;
use Podobri\Models\Picture;
use Podobri\Models\Comment;
use Podobri\Models\Video;
use Podobri\Models\Like;
use Podobri\Models\Solution;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Vinkla\Vimeo\Facades\Vimeo;

class ProblemController extends Controller {

    public function getProblem($id) {

        $problem = Problem::where('id', $id)->first();
        if (!$problem) {
            abort(404);
        }
        $previous=Problem::where('id', '<', $problem->id)->max('id');
        $next=Problem::where('id', '>', $problem->id)->min('id');
        if ($problem->pictures->first()) {
            $img = "https://podobri.eu/images/problemphotos/{$problem->pictures->first()->picture_name}";
        } else {
            $img = $problem->video->getVideoThumbnail();
        }
        
         Carbon::setLocale('bg');
            return view('problems.customimg')
                ->with('problem', $problem)->with('next', $next)
                ->with('title', '' . $problem->getProblemTitle() . ' | Подобри')->with('previous', $previous)
                ->with('description', $problem->getProblemDescription())->with('img', $img);
    }

    public function getAddProblem() {

        $categories = DB::table('categories')->orderBy('category_id', 'asc')->get();

        return view('add.problem')
                        ->with('categories', $categories)
                        ->with('title', 'Добавете проблем | Подобри')
                        ->with('description', 'Добавете проблем в системата на Подобри');
    }

    public function postAddProblem(Request $request) {
        set_time_limit(240);

        $categories = ['Корупция', 'Финансови измами',
            'Околна среда', 'Образование',
            'Тютюнопушене', 'Изгубени домашни любимци',
            'Инциденти', 'Насилие', 'Други'];

        if (!in_array($request->input('category'), $categories)) {
            return redirect()->back()->with('info', 'Не се прави така!');
        }

        $this->validate($request, [
            'user_fullname' => 'string|max:20|min:3',
            'user_email' => 'email|max:255',
            'category' => 'required|string',
            'problem_title' => 'required|max:1000|string|min:6',
            'problem_description' => 'max:2500|string',
            'location' => 'required|max:255|string',
        ]);

        if (($request->hasFile('problem_photos') != null && $request->hasFile('video') != null)) {
            return redirect()->back()->withInput()->with('info', 'Не може да използвате и двете полета за медийни файлове едновременно.');
        }

        if ($request->hasFile('video') == null && $request->hasFile('problem_photos') == null) {
            return redirect()->back()->withInput()->with('info', 'Трябва да добавите медиен файл.');
        }

        $form_inputs = [
            'user_fullname' => $request->input('user_fullname'),
            'user_email' => $request->input('user_email'),
            'category' => $request->input('category'),
            'problem_description' => clean($request->input('problem_description')),
            'problem_title' => $request->input('problem_title'),
            'location' => $request->input('location'),
        ];
        if ($request->hasFile('problem_photos') != null && count($request->file('problem_photos')) > 0) {
            $problem_photos = $request->file('problem_photos');

            if (count($problem_photos) > 9) {
                return redirect()->back()
                                ->withInput()
                                ->with('info', 'Изглежда сте добавили повече от 9 файла.');
            }

            foreach ($problem_photos as $problem_photo) {
                $rules = array('file' => 'image|mimes:png,jpg,jpeg|between:0,3584');
                $validator = Validator::make(array('file' => $problem_photo), $rules);

                if (!is_uploaded_file($problem_photo)) {
                    return redirect()
                                    ->back()
                                    ->withInput()
                                    ->withErrors($validator)
                                    ->with('info', 'Изглежда не сте добавили файл.');
                }

                if ($validator->fails()) {
                    return redirect()->back()
                                    ->withInput()
                                    ->withErrors($validator)
                                    ->with('info', 'Изглежда файл, който сте добавили, е или с неразрешено разширение, или е над 3.5MB.');
                }
            }
            if (Auth::check()) {

                $problem = Auth::user()->problems()->create($form_inputs);
            } else {

                $problem = Problem::create($form_inputs);
            }
            foreach ($problem_photos as $problem_photo) {
                $file = pathinfo($problem_photo->getClientOriginalName());
                $filename = $file['filename'] . '_' . str_random(8) . '.' . $problem_photo->getClientOriginalExtension();

                $img = Image::make($problem_photo->getRealPath());
                $img->resize(550, null, function($constraint) {
                    $constraint->aspectRatio();
                });
                $img->insert('./images/watermark.png', 'bottom-left', 10, 10);
                $img->save('./images/problemphotos/' . $filename, 99);

                $picture = $problem->pictures()->create([
                    'picture_name' => $filename,
                ]);

                $problem->pictures()->save($picture);
            }
        }


        if ($request->hasFile('video') != null) {

            $problem_video = $request->file('video');
            $mime = $problem_video->getMimeType();

            if ($mime != "video/x-flv" && $mime != "video/mp4" && $mime != "application/x-mpegURL" && $mime != "video/MP2T" && $mime != "video/3gpp" && $mime != "video/quicktime" && $mime != "video/x-msvideo" && $mime != "video/x-ms-wmv") {
                return redirect()->back()->withInput()->with('info', 'Неразрешено разширение на видео файл.');
            }

            $user_response = Vimeo::request('/me', [], 'GET');

            if ($request->file('video')->getSize() > $user_response['body']['upload_quota']['space']['free']) {
                return redirect()->back()->withInput()->with('info', 'Файлът е твърде голям, съжаляваме.');
            }
            Vimeo::upload($problem_video->getRealPath(), false);
            $response = Vimeo::request('/me/videos', ['type' => 'POST', 'redirect_url' => 'https://podobri.eu/'], 'GET');
            
            if ($response['status'] != 200) {
                return redirect()->back()->withInput()->with('info', 'Възникна грешка, съжаляваме.');
            }
            
            Vimeo::request('/videos/'.substr(strrchr($response['body']['data'][0]['uri'], '/'), 1), ['name'=>$request->input('problem_title')], 'PATCH');
            
            if (Auth::check()) {

                $problem = Auth::user()->problems()->create($form_inputs);
            } else {

                $problem = Problem::create($form_inputs);
            }

            Video::create([
                'problem_id' => $problem->id,
                'video_id' => substr(strrchr($response['body']['data'][0]['uri'], '/'), 1),
            ]);
        }

        return redirect()->route('problems.index');
    }

    public function getLike($problemId) {
        $problem = Problem::find($problemId);

        if (!$problem) {
            abort(404);
        }

        if (Auth::user()->hasLikedProblem($problem)) {
            return redirect()->back();
        }

        $like = $problem->likes()->create([]);
        Auth::user()->likes()->save($like);

        return redirect()->back();
    }

    public function getDislike($problemId) {
        $problem = Problem::find($problemId);

        if (!$problem) {
            abort(404);
        }

        if (!Auth::user()->hasLikedProblem($problem)) {
            return redirect()->back();
        }

        $problem->likes()->where('user_id', Auth::user()->id)->delete([]);

        return redirect()->back();
    }

    public function deleteProblem($id) {
        $problem = Problem::where('id', $id)->first();

        if (!$problem || $problem->user_id != Auth::user()->id) {
            if (Auth::user()->is_admin != 1) {
                return redirect()->back();
            }
        }

        $problem_comments = Comment::where('problem_id', $id)->get();
        Like::where('likeable_id', $id)->where('likeable_type', 'Podobri\Models\Problem')->delete();
        $solution = Solution::where('problem_id', $id)->first();
        if ($solution) {
            $picture = Picture::where('solution_id', $solution->id)->first();
            File::delete('./images/solutionphotos/' . $picture->picture_name);
            $picture->delete();
            $solution->delete();
        }


        if (Picture::where('problem_id', $id)->first()) {
            $problem_pictures = Picture::where('problem_id', $id)->get();
            foreach ($problem_pictures as $problem_picture) {
                File::delete('./images/problemphotos/' . $problem_picture->picture_name);
                $problem_picture->delete();
            }
        } else {
            Vimeo::request('/videos/'.$problem->video->video_id, [], 'DELETE');
            Video::where('problem_id', $id)->delete();
        }

        foreach ($problem_comments as $problem_comment) {
            Like::where('likeable_id', $problem_comment->id)->where('likeable_type', 'Podobri\Models\Comment')->delete();
            $problem_comment->delete();
        }

        $problem->delete();

        return redirect()
                        ->route('problems.index')
                        ->with('info', 'Цялата информация за проблема беше изтрита.');
    }

    public function getEditProblem($id) {
        $problem = Problem::where('id', $id)->first();

        if (!$problem || $problem->user_id != Auth::user()->id) {
            if (Auth::user()->is_admin != 1) {
                return redirect()->back();
            }
        }

        Carbon::setLocale('bg');
        return view('problems.edit.index')
                        ->with('title', 'Редактиране на ' . '"' . $problem->problem_title . '"' . ' | Подобри')
                        ->with('problem', $problem)
                        ->with('description', 'Ако сте допуснали неволна грешка при добавяне на проблем, тук е мястото за редактиране.');
    }

    public function postEditProblem(Request $request, $id) {
        $problem = Problem::where('id', $id)->first();

        $this->validate($request, [
            'problem_title' => 'required|max:1000|string|min:6',
            'problem_description' => 'max:2500|string',
        ]);

        $problem->update([
            'problem_title' => $request->input('problem_title'),
            'problem_description' => clean($request->input('problem_description')),
        ]);

        return redirect()->back()
                        ->with('problem', $problem)
                        ->with('info', 'Успешно редактирахте проблема.');
    }

    public function getReport($id) {
        $problem = Problem::find($id);

        if (!$problem) {
            return redirect()->route('problems.index');
        }

        if (Auth::user()->hasReportedProblem($problem)) {
            return redirect()->route('problems.index');
        }

        $report = $problem->reports()->create([]);
        Auth::user()->reports()->save($report);

        return redirect()->back()->with('info', 'Успешно докладвахте проблема, екипът ни ще погледне какво не е наред.');
    }

}
