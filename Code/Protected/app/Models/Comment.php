<?php

namespace Podobri\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model{
    protected $table = 'comments';
    
    protected $fillable = [
        'user_id', 
        'problem_id',
        'parent_id', 
        'comment_body', 
    ];
    
    public function user(){
        return $this->belongsTo('Podobri\Models\User', 'user_id');
    }
    
    public function problem(){
        return $this->belongsTo('Podobri\Models\Problem', 'problem_id');
    }
    
    public function scopeNotReply($query){
        return $query->whereNull('parent_id');
    }
    
    public function likes(){
        return $this->morphMany('Podobri\Models\Like', 'likeable');
    }
    
    public function reports(){
        return $this->morphMany('Podobri\Models\Report', 'reportable');
    }
}