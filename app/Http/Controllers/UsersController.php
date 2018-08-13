<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Delegado;
use Auth;
use DB;

class UsersController extends Controller
{
    public $default_email_verified = true; //true while developing
    public function retrieve($id = null)
    { 
        if(Auth::user()->isAn("ejecutivo"))
        {
            $delegados = DB::table('delegados')
            ->where('delegados.ejecutivo_id', Auth::user()->id)
            ->join('users', 'users.id', '=', 'delegados.delegado_id')
            ->select('users.*')
            ->get();
            return $delegados;
        }
        return ($id != null) ? User::find($id) : User::all();  
    }
    
    public function create(Request $rq)
    {
        if(Auth::user()->isAn("administrador"))
        {
            $user = User::create([
                'name' => $rq->name,
                'email' => $rq->email,
                'email_verified' => $this->default_email_verified,
                'email_code' => str_random(32),
                'password' => bcrypt('12345'),
            ]);
            $user->assign("ejecutivo");
            return $user;
        }        
        if(Auth::user()->isAn("ejecutivo"))
        {
            $user = User::create([
                'name' => $rq->name,
                'email' => $rq->email,
                'email_verified' => $this->default_email_verified,
                'email_code' => str_random(32),
                'password' => bcrypt('12345'),
            ]);
            $user->assign("delegado");

            Delegado::create([
                'ejecutivo_id'=> Auth::user()->id,
                'delegado_id' => $user->id
            ]);

            return $user;
        }
    }

    public function update(Request $rq, $id)
    {
        $user = User::find($id);
        if($user != null)
        {
            $user->name = $rq->name;
            $user->email = $rq->email;
            $user->save();
            return [$user];
        }
        else
        {
            return ["User doesn't exist"];
        }
    }

    public function delete($id)
    {
        $target = User::find($id);
        $destroyer = Auth::user();

        if($target->isAn("delegado") && $destroyer->isAn("ejecutivo"))
        {
            $delegados = Delegado::where([
                'ejecutivo_id' => $destroyer->id,
                'delegado_id' => $target->id,
            ])->get();
            if($delegados->isEmpty())
                return ["Este usuario no te pertenece para destruirlo, abusador."];
            else
                User::destroy($target->id);
        }

        if($target->isAn("ejecutivo") && $destroyer->isAn("administrador"))
            User::destroy($target->id);

        return User::all();
    }
}
