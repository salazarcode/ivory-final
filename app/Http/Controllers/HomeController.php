<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bouncer;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->isAn("administrador"))
        {
            return view("administrador.home");
        }
        if($user->isAn("ejecutivo"))
        {
            return view("ejecutivo.home");
        }
        if($user->isAn("delegado"))
        {
            return view("delegado.home");
        }
    }
}
