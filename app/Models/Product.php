<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'weight',
        'price',
        'is_available',
        'store_id',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function cart_detail()
    {
        return $this->hasMany('App\Models\Cart_detail');
    }

    public function transaction_detail()
    {
        return $this->hasMany('App\Models\Transaction_detail');
    }
}
