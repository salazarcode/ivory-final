<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServicioTipo;

class ServiciosTiposController extends Controller
{
    public function retrieve($id = null)
    { 
        return ($id != null) ? ServicioTipo::find($id) : ServicioTipo::all();  
    }
    
    public function create(Request $rq)
    {
        return ServicioTipo::create(['titulo'=> $rq->titulo]);
    }

    public function update(Request $rq, $id)
    {
        $servicio_tipo = ServicioTipo::find($id);        
        $servicio_tipo->titulo = $rq->titulo;
        $servicio_tipo->save();
        return $servicio_tipo;
    }

    public function delete($id)
    {
        ServicioTipo::destroy($id);
        return ServicioTipo::all();
    }
}
