<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 't_product';
    protected $fillable = [
        'photo',
        'name',
        'category',
        'price',
        'description'
    ];
}
