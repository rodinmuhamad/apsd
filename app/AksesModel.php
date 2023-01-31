<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AksesModel extends Model
{
    
    protected $table = "akses";
    protected $primarykey = "id";
    protected $fillable = [
    	'user_id', 'akses',
    ];
}
