<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "users";
    protected $primarykey = "id";
    protected $fillable = [
    	'name', 'level','email', 'password','remember_token','image',
    ];
}
