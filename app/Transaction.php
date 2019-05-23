<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'timeout', 'address', 'regency', 'province', 'total', 'shipping_cost', 'sub_total', 'user_id', 'courier_id', 'proof_of_payment', 'status_transaksi',
    ];
}
