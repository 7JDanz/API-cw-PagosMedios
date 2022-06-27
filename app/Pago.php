<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';

    protected $fillable = [
        'matricula_id',
        'mes_id',
        'concepto_descuento_id',
        'concepto_id',
        'fecha',
        'status_id',
    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];
}
