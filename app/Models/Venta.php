<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'venta';
    public $timestamps =  true;
    protected $fillable = ['folio_factura',
                        'fecha',
                        'cliente', 
                        'cantidad',
                        'producto',
                        'subtotal',
                        'iva',
                        'total'
                        ];
    public $incrementing = true;
}
