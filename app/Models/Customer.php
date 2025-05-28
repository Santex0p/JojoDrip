<?php
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : Eloquent model representing a customer (t_customer table)
///
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Customer model
 *
 * Maps to the 't_customer' database table.
 * Attributes 'name', 'email', and 'address' are mass assignable.
 */
class Customer extends Model
{
    protected $table = 't_customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'address'
    ];

}
