<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    protected $table = 'product_histories';
    public $timestamps = false;
    protected $fillable = ['id',
                        'product_id',
                        'name',
                        'description', 
                        'key_sat',
                        'unit_measurement',
                        'price_buy',
                        'price_sale',
                        'price_minimum',
                        'current_date',
                        'event',
                        'user_id',
                        ];
    public $incrementing = true;
}
