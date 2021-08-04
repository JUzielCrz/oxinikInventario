<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompraProducto extends Model
{
    protected $table = 'compra_productos';
    public $timestamps =  true;
    protected $fillable = ['id',
                        'compra_id',
                        'producto',
                        'cantidad', 
                        'subtotal',
                        'iva',
                        'total',
                        'facturado'
                        ];
    public $incrementing = true;
}
