<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Bouncer;
use App\Credencial;
use App\Servicio;
use App\ServicioTipo;
use App\CredencialTipo;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CredencialesController extends Controller
{
    public function retrieve($servicio_id, $credencialtipo_id)
    {
        try
        {
            $servicio = Servicio::findOrFail($servicio_id);
            $credencialtipo = CredencialTipo::findOrFail($credencialtipo_id);
        }
        catch(ModelNotFoundException $e)
        {
            return [
                "codigo"=> 99,
                "descripcion"=> "Tipo de credencial o tipo de servicio incorrectos"
            ];
        }

        try
        {
            $credencial = Credencial::where([
                ['servicio_id', '=', $servicio->id],
                ['credencialtipo_id', '=', $credencialtipo->id]
            ])->firstOrFail();
            return $credencial;
        }
        catch(ModelNotFoundException $e)
        {
            return [
                "codigo"=> 99,
                "descripcion"=> "Credencial no definida"
            ];
        }    
    }
    public function save(Request $rq)
    {
        try
        {
            if($rq->has('id'))
            {
                $credencial = Credencial::where('id', $rq->id)->firstOrFail();
                $credencial->valor = $rq->valor;   
                $credencial->save();
            }
            else
            {
                $servicio = Servicio::findOrFail($rq->servicio_id);
                $credencialtipo = CredencialTipo::findOrFail($rq->credencialtipo_id);
                $credencial = new Credencial;
                $credencial->servicio_id = $servicio->id;
                $credencial->credencialtipo_id = $credencialtipo->id;
                $credencial->valor = $rq->valor;   
                $credencial->save();
            }
            return $credencial;                    
        }
        catch(ModelNotFoundException $e)
        {
            return [
                "codigo"=> 99,
                "descripcion"=> "Tipo de credencial o tipo de servicio incorrectos"
            ];
        }
    }
}
