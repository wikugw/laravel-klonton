<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'user_id',
        'profile',
        'is_active',
        'foto_ktp'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function cart()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function store_bank()
    {
        return $this->hasMany('App\Models\Store_bank');
    }

    public function transaction()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function address()
    {
        return $this->hasOne('App\Models\Address');
    }
}
