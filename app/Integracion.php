<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integracion extends Model
{
    protected $table = 'integracion';

    protected $fillable = [
        'DATA_Generate_Payment',
        'DATA_Response',
        'fecha_expiracion',
        'pago_id',
        'status_id',
    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];
}
