<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store_bank extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'store_id',
        'bank_name',
        'nomor_rekening',
        'atas_nama'
    ];

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
}
