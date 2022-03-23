<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compra';
    public $timestamps =  true;
    protected $fillable = ['id',
                        'tipo_folio',
                        'folio',
                        'fecha', 
                        'provedor_id',
                        'total_general',
                        'observaciones',
                        ];
    public $incrementing = true;
}
