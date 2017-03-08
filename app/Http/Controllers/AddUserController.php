<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
Use Illuminate\Http\RedirectResponse;
use App\User;

class AddUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('panel.addusers');
    }

    public function agregarUsuario(Request $request)
    {

        $usuario = $request->input('username');
        $name = $request->input('name');
        $password = $request->input('password');
        $rol = $request->input('rol');
        $email = $request->input('email');

        $valor = User::create([
            'name' => $name,
            'username' => $usuario,
            'password' => bcrypt($password),
            'email' => $email,
            'rol' => $rol
        ]);

        if($valor)
        {
            return redirect('/panel/agregarUsuario')->with('statusok', 'OK');
        }
        else
        {
            return redirect('/panel/agregarUsuario')->with('statuserror', 'ERROR');
        }
    }
}
