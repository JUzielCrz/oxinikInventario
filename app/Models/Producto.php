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
                        'precio_unitario'
                        ];
    public $incrementing = true;
}
