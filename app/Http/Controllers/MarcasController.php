<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;
use Auth;

class MarcasController extends Controller
{
    public function retrieve($id = null)
    { 
        if($id == null)
            return Marca::where('user_id', Auth::user()->id)->get();
        else
        {
            $marca = Marca::find($id);
            if($marca->user->id == Auth::user()->id)
                return $marca;
        }
    }
    
    public function create(Request $rq)
    {
        if(Auth::user()->isAn('ejecutivo'))
        {
            if(Auth::user()->marcas->count() < Auth::user()->limite)
            {
                $marca = Marca::create([
                    'titulo'=> $rq->titulo,                        
                    'user_id'=> Auth::user()->id
                ]);
                return $marca;
            }
            else
            {
                return [
                    "code" => 99,
                    "error" => "You have reached the mark's limit for your kind of user",
                    "count" => Auth::user()->limite
                ];
            }
        }
    }

    public function update(Request $rq, $id)
    {
        $marca = Marca::find($id);
        if($marca->user->id == Auth::user()->id)
        {            
            $marca->titulo = $rq->titulo;
            $marca->save();
            return $marca;
        }
    }

    public function delete($id)
    {
        if(Marca::find($id)->user->id == Auth::user()->id)
        {
            Marca::destroy($id);
        }
        return Marca::all();
    }
}
