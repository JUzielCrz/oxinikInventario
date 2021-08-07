<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacen';
    public $timestamps =  true;
    protected $fillable = ['id',
                        'producto_id',
                        'inicial',
                        'entradas',
                        'salidas',
                        'stock',
                        'observaciones'
                        ];
    public $incrementing = true;
}
