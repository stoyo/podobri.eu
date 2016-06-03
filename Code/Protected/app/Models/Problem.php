<?php namespace Podobri\Models;

use DB;
use Podobri\Models\Solution;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model{
    protected $table = 'problems';
    
    protected $fillable = [
        'user_id', 
        'user_fullname', 
        'user_email', 
        'category', 
        'problem_title',
        'problem_description',
        'location',
    ];
    
    public function user(){
        return $this->belongsTo('Podobri\Models\User', 'user_id');
    }
    
    public function categoryslug(){
        $category = $this->category;
        
        $allcategories = DB::table('categories')->get();
        
        foreach($allcategories as $cat){
            if($category==$cat->category_name){
                return $cat->category_slug;
            }
        }
        
        return null;
    }
    
    public function pictures(){
        return $this->hasMany('Podobri\Models\Picture', 'problem_id');
    }
    
    public function video(){
        return $this->hasOne('Podobri\Models\Video', 'problem_id');
    }
    
    public function solution(){
        return $this->hasOne('Podobri\Models\Solution', 'problem_id');
    }
    
    public function comments(){
        return $this->hasMany('Podobri\Models\Comment', 'problem_id');
    }
    
    public function getProblemTitle(){
        if($this->problem_title){
            return "{$this->problem_title}";
        }
        
        return null;
    }
    
    public function getProblemDescription(){
        if($this->problem_description){
            return "{$this->problem_description}";
        }
        
        return null;
    }
    
    public function getProblemUserEmail(){
        if($this->user_email){
            return "{$this->user_email}";
        }
        
        return null;
    }
    
    public function getProblemUserFullname(){
        if($this->user_fullname){
            return "{$this->user_fullname}";
        }
        
        return null;
    }
    
    public function getProblemUserId(){
        if($this->user_id){
            return "{$this->user_id}";
        }
        
        return null;
    }
    
    public function getProblemCreatedAt(){
        if($this->created_at){
            return "{$this->created_at}";
        }
        
        return null;
    }
    
    public function likes(){
        return $this->morphMany('Podobri\Models\Like', 'likeable');
    }
    
    public function reports(){
        return $this->morphMany('Podobri\Models\Report', 'reportable');
    }
    
    public function state($id){
        $condition = Solution::where('problem_id', $id)->first();
        
        if(!$condition){
            return 0;
        }
        
        if($condition->solution_condition==1){
            return 1;
        }
        
        if($condition->solution_condition==2){
            return 2;
        }
    }
    
    public function category(){
        return $this->belongsTo('Podobri\Models\Category', 'category_id');
    }
}