<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\ServiciosTipos;
use App\CredencialesTipos;
use App\Marca;
use Auth;
use Bouncer;

class ServiciosController extends Controller
{
    public function create(Request $rq)
    {
        if(Auth::user()->isAn("ejecutivo"))
        {
            $servicio = Servicio::where([
                ['marca_id', '=', $rq->marca_id],
                ['serviciotipo_id', '=', $rq->serviciotipo_id]
            ])->get();

            if($servicio->count() == 0)
            {
                $new = Servicio::create([
                    'serviciotipo_id'=>$rq->serviciotipo_id,
                    'marca_id'=>$rq->marca_id
                ]);
                return $new;
            }
            else
            {
                return ["This type of service has already been created"];
            }
        }
    }
    public function retrieve($marca_id, $serviciotipo_id = null)
    {
        if(Auth::user()->isAn("ejecutivo"))
        {
            $marca = Marca::find($marca_id);
            if($marca->user->id == Auth::user()->id)
            {
                $servicio_tipo = ($serviciotipo_id != null) ? ServiciosTipos::find($serviciotipo_id) : null;

                if($servicio_tipo != null)
                {
                    $servicio = Servicio::where([
                        ['marca_id', '=', $marca->id],
                        ['serviciotipo_id', '=', $servicio_tipo->id]
                    ])->first();
                    return $servicio;
                }
                else
                {
                    $servicios = $marca->servicios;
                    return $servicios;
                }                
            }
        } 
    }
    public function delete($servicio_id)
    {
        $servicio = Servicio::find($servicio_id);
        $marca = $servicio->marca;
        //return $servicio_id;
        if( $servicio->marca->user->id == Auth::user()->id )
        {
            Servicio::destroy($servicio->id);
            return $marca->servicios;
        }
        else
        {
            return ["This service doesn't belong to any mark of yours"];
        }
    }

}
