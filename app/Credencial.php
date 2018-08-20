<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credencial extends Model
{
    protected $fillable = [
        'servicio_id', 'credencialtipo_id', 'valor'
    ];
    public function servicio()
    {
        return $this->belongsTo('App\Servicio');
    }
    public function tipo()
    {
        return $this->belongsTo('App\CredencialTipo');
    }
}
