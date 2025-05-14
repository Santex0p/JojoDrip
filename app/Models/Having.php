<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Having extends Model
{
    protected $table = 't_having';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
