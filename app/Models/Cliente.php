<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    public $timestamps =  true;
    protected $fillable = ['id',
                        'nombre',
                        'telefono',
                        'correo',
                        'rfc',
                        'direccion', 
                        'referencia',
                        'observaciones'
                        ];
    public $incrementing = true;
}
