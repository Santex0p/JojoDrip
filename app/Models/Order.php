<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 't_order';
    protected $fillable = [
        'customer_id',
        'quantity',
        'status',
        'price'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }
}
