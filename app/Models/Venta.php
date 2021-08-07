<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'venta';
    public $timestamps =  true;
    protected $fillable = ['folio_factura',
                        'fecha',
                        'cliente_id',
                        'total_general'
                        ];
    public $incrementing = true;
}
