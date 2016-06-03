<?php namespace Podobri\Http\Controllers;

use Podobri\Models\Report;
use Podobri\Models\User;
use Podobri\Models\Picture;
use Podobri\Models\Solution;
use Podobri\Models\Problem;
use Podobri\Models\Comment;
use Podobri\Models\Like;
use Podobri\Models\Maintenance;
use Carbon\Carbon;
use Auth;
use File;

class AdminController extends Controller{
    
    public function getReports(){
        
        $reports = Report::where(function($query){
           return $query; 
        })->orderBy('created_at', 'desc')->paginate(10);
        
        Carbon::setLocale('bg');
        return view('admin.reports')
                ->with('reports', $reports)
                ->with('title', 'Доклади за проблеми, решения, коментари | Подобри')
                ->with('description', 'Информация за всички докладвания от потребители в системата на Подобри');
    }
    
    public function getMaintenance(){
        
        $maintenance = Maintenance::where(function($query){
           return $query; 
        })->orderBy('created_at', 'desc')->paginate(10);
        
        Carbon::setLocale('bg');
        return view('admin.maintenance')
                ->with('maintenance', $maintenance)
                ->with('title', 'Съобщения до екипа на Подобри')
                ->with('description', 'Информация за всички съобщения от потребители в системата на Подобри');
    }
    
    public function makeAdmin($id){
        $user = User::where('id', $id)->first();
        
        if(!$user || $user->is_admin != 0 || Auth::user()->is_owner != 1){
            return redirect()->back();
        }
        
        $user->update(['is_admin'=>1]);
        
        return redirect()->back();
    }
    
    public function makeUser($id){
        $user = User::where('id', $id)->first();
        
        if(!$user || $user->is_admin != 1 || Auth::user()->is_owner != 1){
            return redirect()->back();
        }
        
        $user->update(['is_admin'=>0]);
        
        return redirect()->back();
    }
    
    public function deleteUser($id){
            $account = User::where('id', $id)->first();
              
            if(!$account || Auth::user()->is_owner != 1){
                return redirect()->back();
            }
            
            $picture = Picture::where('user_id', $account->id)->first();
            
            if($picture){
                File::delete('./images/userphotos/'.$picture->picture_name);
                $picture->delete();
            }
            
            
            Problem::where('user_id', $account->id)->update([
                'user_id'=>null,
            ]);
            
            Solution::where('user_id', $account->id)->update([
                'user_id'=>null,
            ]);
            
            Comment::where('user_id', $account->id)->delete();
            Like::where('user_id', $account->id)->delete();
            
            $account->delete();
            
            return redirect()
                ->route('problems.index')->with('info', 'Успешно изтрихте профила на потребителя.');
    }
    
}