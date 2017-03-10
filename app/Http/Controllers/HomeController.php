<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{


    private $nivel_minimo = 3;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cambiarPassword(Request $request)
    {
        if(Auth::check())
        {
            if (Auth::user()->rol <= $this->nivel_minimo)
            {
                $password = bcrypt($request->input('password'));
                $username = Auth::user()->username;
                error_log("usuario : " . $username);
                $actualizado = User::where('username', $username)->update(['password' => $password]);

                if($actualizado)
                {
                    return response()->json([
                        'status' => 'OK'
                    ]);
                }
                else
                {
                    return response()->json([
                        'status' => 'ERROR'
                    ]);
                }
            }
            else
            {
                abort(-1, "Permiso no otorgado");
            }
        }
        else
        {
            abort(-1, "Permiso no otorgado");
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inicio');
    }
}
