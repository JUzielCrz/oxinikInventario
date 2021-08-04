<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model
{
    protected $table = 'venta_productos';
    public $timestamps =  true;
    protected $fillable = ['id',
                        'venta_id',
                        'producto',
                        'cantidad', 
                        'subtotal',
                        'iva',
                        'total'
                        ];
    public $incrementing = true;
}
