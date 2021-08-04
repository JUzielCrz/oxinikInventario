<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compra';
    public $timestamps =  true;
    protected $fillable = ['id',
                        'folio_factura',
                        'fecha', 
                        'provedor',
                        'cantidad',
                        'producto',
                        'subtotal',
                        'iva',
                        'total'
                        ];
    public $incrementing = true;
}
