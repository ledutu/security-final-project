<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'product';

    protected $fillable = [
        'product_name', 'product_name',
    ];

    // public $timestamps = false;

    protected $primaryKey = 'product_id';
}
