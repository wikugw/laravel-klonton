<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'store_id',
        'user_id',
        'service'
    ];

    public function cart_detail()
    {
        return $this->hasMany('App\Models\Cart_detail');
    }
}
