<?php namespace Podobri\Http\Controllers;

use DB;
use Podobri\Models\Problem;
use Carbon\Carbon;

class HomeController extends Controller{
    
    public function index(){
        
        $problems = Problem::where(function($query){
            return $query;
        })->orderBy('created_at', 'desc')->paginate(10);
        
        $rand_probs = Problem::where(function($query){
            return $query;
        })->get()->shuffle()->slice(0, 9);
        
        $categories = DB::table('categories')->orderBy('category_id', 'asc')->get();
        
        Carbon::setLocale('bg');
        return view('problems.index')
                ->with('categories', $categories)
                ->with('rand_probs', $rand_probs)
                ->with('problems', $problems)
                ->with('title', 'Подобри - решени, нерешени и чакащи потвърждение проблеми')
                ->with('description', 'Подобри е интернет платформа, която позволява на всеки човек, регистриран или не, голям или малък, от Мелник или от София, да опише и локализира проблем от всякакво естество, да следи и коментира, вече добавени проблеми, и да добавя решения за тях.');
    }
    
    public function goal(){
        return view('goal')
                ->with('title', 'За нас | Подобри')
                ->with('description', 'Подобри е интернет платформа, която позволява на всеки човек, регистриран или не, голям или малък, от Мелник или от София, да опише и локализира проблем от всякакво естество, да следи и коментира, вече добавени проблеми, и да добавя решения за тях.');
    }
}