<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacen';
    public $timestamps =  true;
    protected $fillable = ['id',
                        'codigoSat',
                        'producto', 
                        'unidad_medida',
                        'inicial',
                        'entradas',
                        'salidas',
                        'iva',
                        'stock',
                        'observaciones'
                        ];
    public $incrementing = true;
}
