<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    protected $table = "produk";
    protected $primarykey = "id";
    protected $fillable = [
    	'name', 'harga','image',
    ];
}
