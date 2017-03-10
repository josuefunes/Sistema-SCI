<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventarioHomeController extends Controller
{
    private $nivel_minimo = 2;

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {

        if(Auth::check())
        {

            if(Auth::user()->rol <= $this->nivel_minimo)
            {
                return view('inventario.inventario');
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
