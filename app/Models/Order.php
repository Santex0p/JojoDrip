<?php
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : Eloquent model representing orders (t_order table)

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Order model
 *
 * Maps to the 't_order' database table.
 * Attributes 'customer_id', 'quantity', 'status', and 'price' are mass assignable.
 */
class Order extends Model
{
    protected $table = 't_order';
    protected $fillable = [
        'customer_id',
        'quantity',
        'status',
        'price'
    ];

    /**
     * Get the customer that owns the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Get the products associated with this order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }
}

