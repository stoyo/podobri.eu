<?php namespace Podobri\Http\Controllers;

use DB;
use Carbon\Carbon;
use Podobri\Models\Problem;
use Podobri\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller{

    public function getResults(Request $request){
        
        $query = $request->input('term');
        
        if(!$query || $query==''){
            return redirect()->route('problems.index');
        }
        
        $problems = Problem::where(DB::raw("CONCAT(problem_title, ' ', problem_description)"), 'LIKE', "%$query%")
                ->orWhere('location', 'LIKE', "%$query%")
                ->orWhere('category', 'LIKE', "%$query%")
                ->orderBy('created_at', 'desc')->paginate(10);
        
        $users=User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%$query%")
                ->get()->shuffle()->slice(0, 9);
        
        Carbon::setLocale('bg');
        return view('search.results')
                ->with('problems', $problems)
                ->with('users', $users)
                ->with('title', 'Резултати за "'."$query".'" | Подобри')
                ->with('description', 'Резултати за "'."$query".'" в системата на Подобри');
    }
}