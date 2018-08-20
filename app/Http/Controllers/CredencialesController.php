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
    public function retrieve($serviciotipo_id, $credencialtipo_id)
    {
        $serviciotipo = ServicioTipo::find($serviciotipo_id);
        $credencialtipo = CredencialTipo::find($credencialtipo_id);
        
        if(($serviciotipo instanceof ModelNotFoundException) || ($credencialtipo instanceof ModelNotFoundException))
        {
            return [
                "codigo"=> 99,
                "descripcion"=> "Tipo de credencial o tipo de servicio incorrectos"
            ];
        }     
        else
        {
            $credencial = Credencial::where([
                ['serviciotipo_id', '=', $serviciotipo->id],
                ['credencialtipo_id', '=', $credencialtipo->id]
            ])->firstOrFail();
            if($credencial instanceof ModelNotFoundException)
            {
                return [
                    "codigo"=> 99,
                    "descripcion"=> "Credencial no definida"
                ];
            }
            else
            {
                return $credencial;
            }            
        }       
    }
    public function save(Request $rq)
    {
        $serviciotipo = ServicioTipo::find($rq->serviciotipo_id);
        $credencialtipo = CredencialTipo::find($rq->credencialtipo_id);
        
        if(($serviciotipo instanceof ModelNotFoundException) || ($credencialtipo instanceof ModelNotFoundException))
        {
            return [
                "codigo"=> 99,
                "descripcion"=> "Tipo de credencial o tipo de servicio incorrectos"
            ];
        }     
        else
        {        
            if($rq->has('id'))
            {
                $credencial = Credencial::where('id', $rq->id)->first();
                $credencial->value = $rq->value;   
                $credencial->save();
            }
            else
            {
                $credencial = new Credencial;
                $credencial->servicio()->save($serviciotipo);
                $credencial->tipo()->save($credencialtipo);
                $credencial->value = $rq->value;   
                $credencial->save();
            }                    
            return $credencial;
        } 
    }
}
