<?php

namespace Podobri\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model{
    protected $table = 'solutions';
    
    protected $fillable = [
        'problem_id', 
        'user_id', 
        'user_fullname',
        'user_email',
        'solution_condition',
        'solution_description',
    ];
    
    public function user(){
        return $this->belongsTo('Podobri\Models\User', 'user_id');
    }
    
    public function problem(){
        return $this->belongsTo('Podobri\Models\Problem', 'problem_id');
    }
    
    public function picture(){
        return $this->hasOne('Podobri\Models\Picture', 'solution_id');
    }
    
    public function reports(){
        return $this->morphMany('Podobri\Models\Report', 'reportable');
    }
    
}