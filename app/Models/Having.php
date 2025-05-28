<?php
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : Eloquent model representing pivot table linking orders and products

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Having model
 *
 * Represents the pivot table 't_having' linking orders to products.
 */
class Having extends Model
{

    protected $table = 't_having';

    /**
     * Get the order associated with this pivot record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Get the product associated with this pivot record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
