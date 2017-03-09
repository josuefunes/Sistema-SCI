<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManageUsers extends Controller
{
    private $nivel_minimo = 1;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if(Auth::check())
        {
            if (Auth::user()->rol <= $this->nivel_minimo)
            {
                $users = DB::table('users')->where('unremovable', 0)->simplePaginate(5);
                return view('panel.manageusers')->with('users', $users);
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

    public function cambiarPassword(Request $request)
    {
        if(Auth::check())
        {
            if (Auth::user()->rol <= $this->nivel_minimo)
            {
                $password = bcrypt($request->input('password'));
                $actualizado = User::where('username', $request->input('username'))->update(['password' => $password]);

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

    public function editarUsuario(Request $request)
    {
        if(Auth::check())
        {
            if (Auth::user()->rol <= $this->nivel_minimo) {

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

    public function borrarUsuario(Request $request)
    {
        if(Auth::check())
        {
            if (Auth::user()->rol <= $this->nivel_minimo)
            {

                $borrado = User::where('username', $request->input('username'))->delete();
                if($borrado)
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
}
