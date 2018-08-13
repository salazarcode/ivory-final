<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CredencialTipo;

class CredencialesTiposController extends Controller
{
    public function retrieve($id = null)
    { 
        return ($id != null) ? CredencialTipo::find($id) : CredencialTipo::all();  
    }
    
    public function create(Request $rq)
    {
        return CredencialTipo::create(['titulo'=> $rq->titulo]);
    }

    public function update(Request $rq, $id)
    {
        $servicio_tipo = CredencialTipo::find($id);        
        $servicio_tipo->titulo = $rq->titulo;
        $servicio_tipo->save();
        return $servicio_tipo;
    }

    public function delete($id)
    {
        CredencialTipo::destroy($id);
        return CredencialTipo::all();
    }
}
