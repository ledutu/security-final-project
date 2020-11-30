<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    protected $table = 'material';
    
    protected $primaryKey = 'material_id';
    
    protected $fillable = [
        'material_code',
        'material_name',
        'material_unit',
        'material_price',
        'shop_id',
    ];
}
