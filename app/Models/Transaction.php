<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'store_id',
        'user_id',
        'address_id',
        'subtotal',
        'ongkir',
        'service',
        'status',
        'resi',
        'bukti_transfer'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
}
