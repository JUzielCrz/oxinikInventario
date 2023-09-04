<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    // protected $table = 'product_histories';
    public $timestamps = false;
    protected $fillable = ['id',
                        'logo',
                        ];
    public $incrementing = true;
}