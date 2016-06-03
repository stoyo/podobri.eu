<?php namespace Podobri\Http\Controllers;

use Auth;
use File;
use Podobri\Models\Solution;
use Podobri\Models\Picture;
use Podobri\Models\Problem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SolutionController extends Controller{
    
    public function getAddSolution($id){
        
        $problem = Problem::where('id', $id)->first();
        $solution = Solution::where('problem_id', $id)->first();
        if(!$problem || $solution){
            abort(404);
        }
        
        Carbon::setLocale('bg');
        return view('problems.solve.index')
                ->with('title', 'Добавете решение за "'.$problem->problem_title.'" | Подобри')
                ->with('problem', $problem)
                ->with('description', 'Ако сте решили проблем, вече добавен в Подобри, тук е мястото да го отбележите.');
    }
    
    public function postAddSolution(Request $request, $id){
        
        $problem = Problem::where('id', $id)->first();
        $solution = Solution::where('problem_id', $id)->first();
        
        if(!$problem || $solution){
            abort(404);
        }
        
        $this->validate($request, [
            'user_fullname'=>'string|max:20',
            'user_email'=> 'email|max:255',
            'solution_description'=>'required|max:2500|string|min:20',
            'solution_photo'=>'required|image|mimes:png,jpg,jpeg|between:0,3584', 
        ]);
        
        $solution_photo=$request->file('solution_photo');

            if(is_uploaded_file($solution_photo)){
                $file=pathinfo($solution_photo->getClientOriginalName());
                $destinationPath = './images/solutionphotos';
                $filename = $file['filename'].'_'.str_random(8).'.'.$solution_photo->getClientOriginalExtension();
                $solution_photo->move($destinationPath, $filename);

            }
        
            $form_inputs = [
                'user_fullname'=>$request->input('user_fullname'),
                'user_email'=>$request->input('user_email'),
                'solution_description'=>clean($request->input('solution_description')),
                'solution_condition'=>1,
                'problem_id'=>$problem->id,
        ];
            
        if(Auth::check()){
            
            $solution = Auth::user()->solutions()->create($form_inputs);
            
        }else{
            
            $solution = Solution::create($form_inputs);
            
        }
                Picture::create([
                    'picture_name' => $filename,
                    'solution_id' => $solution->id,
                ]);
                    
        
            return redirect()->route('problem.custom', ['id'=>$problem->id])
            ->with('info', 'Успешно добавихте решение, от потребителя зависи дали ще го приеме, или не.');
    }
    
    public function postApproveSolution($id){
        
        $solution = Solution::where('id', $id)->first();
        $problem = Problem::where('id', $solution->problem_id)->first();
        
        if(!$solution || $solution->solution_condition != 1 || !Auth::check() || Auth::user()->id != $problem->user_id){
            if(!Auth::check() || Auth::user()->is_admin != 1){
                abort(404);
            }
        }
        
        Solution::where('id', $id)->update([
            'solution_condition'=>2,
        ]);
        
        if(!$solution->user_fullname){
            $solution->user_fullname='анонимния потребител';
        }
        
        return redirect()->route('problem.custom', ['id'=>$solution->problem_id])
            ->with('info', 'Вие приехте решението на '.$solution->user_fullname.'.');
        
    }
    
    public function postDeclineSolution($id){
        
        $solution = Solution::where('id', $id)->first();
        $problem = Problem::where('id', $solution->problem_id)->first();
        
        if(!$solution || $solution->solution_condition != 1 || !Auth::check() || Auth::user()->id != $problem->user_id){
            if(!Auth::check() || Auth::user()->is_admin != 1){
                abort(404);
            }
        }
        
        Solution::where('id', $id)->delete();
        $picture = Picture::where('solution_id', $id)->first();
        File::delete('./images/solutionphotos/'.$picture->picture_name);
        $picture->delete();
        
        if(!$solution->user_fullname){
            $solution->user_fullname='анонимния потребител';
        }
        
        return redirect()->route('problem.custom', ['id'=>$solution->problem_id])
            ->with('info', 'Вие отказахте решението на '.$solution->user_fullname.'.');
        
        
    }
    
    public function deleteSolution($id){
        $solution = Solution::where('id', $id)->first();
        
        if(!$solution || Auth::user()->id != $solution->user_id){
            if(Auth::user()->id_admin != 1){
                redirect()->back();
            }
        }
        
        $picture=Picture::where('solution_id', $solution->id)->first();
            File::delete('./images/solutionphotos/'.$picture->picture_name);
            $picture->delete();
            $solution->delete();
            
        return redirect()->back()->with('info', 'Успешно изтрихте решението.');  
        
    }
    
    public function getReport($id){
        $solution = Solution::where('id', $id)->first();
        
        if(!$solution || !Auth::check() || Auth::user()->id == $solution->user_id){
            redirect()->back();
        }
        
        if(Auth::user()->hasReportedSolution($solution)){
            return redirect()->back();
        }
        
        $report = $solution->reports()->create([]);
        Auth::user()->reports()->save($report);
        
        return redirect()->back()->with('info', 'Успешно докладвахте решението, екипът ни ще погледне какво не е наред.');
        
    }
    
}