<?php 

namespace Podobri\Models;

use Illuminate\Database\Eloquent\Model;

class Password_reset extends Model{
    protected $table = 'password_resets';
    
    protected $fillable = [
        'email', 
        'token',
    ];
    
    public $timestamps = false;
    
}