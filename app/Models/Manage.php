<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manage extends Model
{
    protected $table = 't_manage';

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
