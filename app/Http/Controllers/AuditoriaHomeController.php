<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditoriaHomeController extends Controller
{
    private $nivel_minimo = 3;

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {

        if(Auth::check())
        {

            if(Auth::user()->rol == $this->nivel_minimo || Auth::user()->rol == 1)
            {
                return view('auditoria.auditoria');
            }
            else
            {
                return redirect('/403');
            }
        }
        else
        {
            return redirect('/inicio');
        }
    }
}
