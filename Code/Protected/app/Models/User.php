<?php

namespace Podobri\Models;

use Auth;
use Podobri\Models\Solution;
use Podobri\Models\Problem;
use Podobri\Models\Comment;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'users';

    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'day',
        'month',
        'year',
        'password',
        'phone',
        'location',
        'about',
        'is_admin',
        'is_owner',
        ];

    protected $hidden = [
        'password',
        'remember_token',
        ];
    
    public function getFirstName(){
        if($this->first_name){
            return "{$this->first_name}";
        }
        
        return null;
        
    }
    
    public function getFirstAndLastName(){
        if($this->first_name && $this->last_name){
            return "{$this->first_name} {$this->last_name}";
        }
        
        return null;
    }
    
    public function getBirthday(){
        if($this->day && $this->month && $this->year){
            return "{$this->day} {$this->month} {$this->year}";
        }
        
        return null;
    }
    
    public function getAvatarUrl(){
        return "https://www.gravatar.com/avatar/{{md5($this->email)}}?d=mm&s=200";
    }
    
    public function getLocation(){
        if($this->location){
            return "{$this->location}";
        }
        
        return null;
    }
    
    public function getPhone(){
        if($this->phone){
            return "{$this->phone}";
        }
        
        return null;
    }
    
    public function getAbout(){
        if($this->about){
            return "{$this->about}";
        }
        
        return null;
    }
    
    public function likes(){
        return $this->hasMany('Podobri\Models\Like', 'user_id');
    }
    
    public function reports(){
        return $this->hasMany('Podobri\Models\Report', 'user_id');
    }
    
    public function getEmail(){
        if($this->email){
            return "{$this->email}";
        }
        
        return null;
    }
    
    public function getId(){
        if($this->id){
            return "{$this->id}";
        }
        
        return null;
    }
    
    public function problems(){
        return $this->hasMany('Podobri\Models\Problem', 'user_id');
    }
    
    public function comments(){
        return $this->hasMany('Podobri\Models\Comment', 'user_id');
    }
    
    public function solutions(){
        return $this->hasMany('Podobri\Models\Solution', 'user_id');
    }
    
    public function pending(){
        $problems = Problem::where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->slice(0, 9);
        $pending = [];
        
        foreach($problems as $problem){
            $must = ['problem_id' => $problem->id, 'solution_condition' => 1];
            $condition = Solution::where($must)->first();
            
            if($condition){
                array_push($pending, $problem);
            }
        }
        
        return $pending;
    }
    
    public function hasLikedProblem(Problem $problem){
        return (bool) $problem->likes
                ->where('likeable_id', $problem->id)
                ->where('likeable_type', get_class($problem))
                ->where('user_id', $this->id)
                ->count();
    }
    
    public function hasLikedComment(Comment $comment){
        return (bool) $comment->likes
                ->where('likeable_id', $comment->id)
                ->where('likeable_type', get_class($comment))
                ->where('user_id', $this->id)
                ->count();
    }
    
    public function hasReportedProblem(Problem $problem){
        return (bool) $problem->reports
                ->where('reportable_id', $problem->id)
                ->where('reportable_type', get_class($problem))
                ->where('user_id', $this->id)
                ->count();
    }
    
    public function hasReportedComment(Comment $comment){
        return (bool) $comment->reports
                ->where('reportable_id', $comment->id)
                ->where('reportable_type', get_class($comment))
                ->where('user_id', $this->id)
                ->count();
    }
    
    public function hasReportedSolution(Solution $solution){
        return (bool) $solution->reports
                ->where('reportable_id', $solution->id)
                ->where('reportable_type', get_class($solution))
                ->where('user_id', $this->id)
                ->count();
    }
    
    public function picture(){
        return $this->hasOne('Podobri\Models\Picture', 'user_id');
    }
    
    public function isAdmin(){
        if($this->is_admin == 1){
            return true;
        }
        
        return false;
    }
    
    public function isOwner(){
        if($this->is_owner == 1){
            return true;
        }
        
        return false;
    }
}
