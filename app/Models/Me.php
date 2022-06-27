<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Me extends Model
{
    protected $fillable = [
        'descripcion',
    
    ];
    
    
    protected $dates = [
    
    ];
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/mes/'.$this->getKey());
    }
}
