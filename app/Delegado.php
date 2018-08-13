<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delegado extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ejecutivo_id', 'delegado_id'
    ];
}
