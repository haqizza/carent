<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentTransaction extends Model
{
    protected $table = 'rent_transaction';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer',
        'car',
        'rent_date',
        'return_date',
        'is_return'
    ];
}
