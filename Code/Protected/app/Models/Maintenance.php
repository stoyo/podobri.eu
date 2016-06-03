<?php

namespace Podobri\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model{
    protected $table = 'maintenance';
    
    protected $fillable = [
        'user_email', 
        'reason',
        'message',
        'url', 
    ];
    
}