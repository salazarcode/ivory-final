<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if(Auth::user()->isAn("administrator"))
        {
            return view("administrador.home");
        }
        if(Auth::user()->isAn("ejecutivo"))
        {
            return view("ejecutivo.home");
        }
        if(Auth::user()->isAn("delegado"))
        {
            return view("delegado.home");
        }

    }
}
