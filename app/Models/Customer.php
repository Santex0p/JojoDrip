<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 't_customer';

    protected $fillable = [
        'name',
        'email',
        'address'
    ];

}
