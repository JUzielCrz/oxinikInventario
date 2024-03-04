<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'venta';
    public $timestamps =  true;
    protected $fillable = ['folio',
                        'fecha',
                        'cliente_id',
                        'total_general',
                        'unidad_medida',
                        'observaciones'
                        ];
    public $incrementing = true;
}
