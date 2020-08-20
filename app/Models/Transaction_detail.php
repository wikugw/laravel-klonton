<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction_detail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }
}
