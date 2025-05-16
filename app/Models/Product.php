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

    public function orders()
    {
        return $this->belongsToMany(Order::class, 't_having', 'product_id', 'order_id');
    }
}
