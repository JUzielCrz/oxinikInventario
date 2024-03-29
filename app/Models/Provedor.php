<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provedor extends Model
{
    protected $table = 'provedor';
    public $timestamps =  true;
    protected $fillable = ['id',
                        'nombre',
                        'direccion',
                        'referencia', 
                        'telefono',
                        'correo',
                        ];
    public $incrementing = true;
}
