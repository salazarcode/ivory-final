<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public $default_email_verified = true; //true while developing
    public function retrieve($id)
    {
        return ($id != null) ? User::find($id) : User::all();        
    }
    
    public function createEjecutivo(Request $rq)
    {
        $user = User::create([
            'name' => $rq->name,
            'email' => $rq->email,
            'email_verified' => $default_email_verified,
            'email_code' => str_random(32)
        ]);
        $user->assign("ejecutivo");
        return $user;
    }
    
    public function createDelegado(Request $rq)
    {
        $user = User::create([
            'name' => $rq->name,
            'email' => $rq->email,
            'email_verified' => $default_email_verified,
            'email_code' => str_random(32)
        ]);
        $user->assign("delegado");
        return $user;
    }

    public function update(Request $rq)
    {
        $user = User::find($rq->query);
        if($user != null)
        {
            $user->name = $rq->name;
            $user->email = $rq->email;
        }
        else
        {
            return ["User doesn't exist"];
        }
    }

    public function delete($id)
    {
        User::destroy($id);
        return User::all();
    }
}
