<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'serviciotipo_id', 'marca_id'
    ];
    public function marca()
    {
        return $this->belongsTo('App\Marca');
    }
    public function credenciales()
    {
        return $this->hasMany('App\Crendencial');
    }    
}
