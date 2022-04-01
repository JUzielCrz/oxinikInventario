<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    public $timestamps =  true;
    protected $fillable = ['id',
                        'nombre',
                        'descripcion', 
                        'clave_sat',
                        'unidad_medida',
                        'capacidad',
                        'precio_comrpa',
                        'precio_venta',
                        'precio_minimo',
                        ];
    public $incrementing = true;
}
