<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlmacenFiscal extends Model
{
    protected $table = 'almacen_fiscal';
    public $timestamps =  true;
    protected $fillable = ['id',
                        'producto_id',
                        'entradas',
                        'salidas',
                        'stock',
                        'observaciones'
                        ];
    public $incrementing = true;
}
