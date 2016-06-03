<?php

namespace Podobri\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model{
    protected $table = 'reportable';
    
    public function reportable(){
        return $this->morphTo();
    }
    
    public function user(){
        return $this->belongsTo('Podobri\Models\User', 'user_id');
    }
}