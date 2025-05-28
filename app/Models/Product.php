<?php
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : Eloquent model representing products (t_product table)

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Product model
 *
 * Maps to the 't_product' database table.
 * Attributes 'name', 'price', 'category', 'description', and 'photo' are mass assignable.
 */
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

    /**
     * The orders that include this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class, 't_having', 'product_id', 'order_id');
    }
}
