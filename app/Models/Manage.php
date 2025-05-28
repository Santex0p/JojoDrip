<?php
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : Eloquent model representing pivot table linking admins, products, and orders

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Manage model
 *
 * Maps to the 't_manage' database table.
 * Links an admin to a product and an order via pivot relationships.
 */
class Manage extends Model
{
    /**
     * Specify the database table name.
     *
     * @var string
     */
    protected $table = 't_manage';

    /**
     * Get the admin associated with this pivot record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class,'admin_id');
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

    /**
     * Get the order associated with this pivot record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
