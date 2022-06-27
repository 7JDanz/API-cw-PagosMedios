<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = 'matricula';

    protected $fillable = [
        'fecha_fin',
        'fecha_inicio',
        'grado_id',
        'persona_id',
        'status',
        'matricula',
    ];


    protected $dates = [
        'created_at',
        'fecha_fin',
        'fecha_inicio',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/matriculas/'.$this->getKey());
    }
}
