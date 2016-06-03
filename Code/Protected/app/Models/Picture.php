<?php

namespace Podobri\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    protected $table = 'pictures';

    protected $fillable = [
        'problem_id', 
        'user_id', 
        'solution_id', 
        'picture_name',
        ];
    
    public function problem(){
        return $this->belongsTo('Podobri\Models\Problem', 'problem_id');
    }
    
    public function user(){
        return $this->belongsTo('Podobri\Models\User', 'user_id');
    }
    
    public function solution(){
        return $this->belongsTo('Podobri\Models\Solution', 'solution_id');
    }
    
    public function getPictureName(){
        if($this->picture_name){
            return "{$this->picture_name}";
        }
        
        return null;
    }
    
}
