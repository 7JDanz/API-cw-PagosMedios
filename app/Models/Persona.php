<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';

    protected $fillable = [
        'apellidos',
        'direccion',
        'email',
        'identificacion',
        'nombres',
        'representante_persona_id',
        'status',
        'telefono',
        'tipo_documento_id',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/personas/'.$this->getKey());
    }
    /*
    public function personas(){
        return $this->hasMany(Persona::class);
    }

    public function childrenPersonas(){
        return $this->hasMany(Persona::class)->with('persona');
    }
    */
}
