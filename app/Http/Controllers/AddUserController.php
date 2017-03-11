<?php
namespace App\Http\Controllers;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
Use Illuminate\Http\RedirectResponse;
use App\User;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;
use Illuminate\Support\Facades\DB;

class AddUserController extends Controller
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

            if (Auth::check() <= $this->nivel_minimo) {

                $roles = DB::table('roles')->get();
                return view('panel.addusers')->with('roles', $roles);
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


    public function agregarUsuario(Request $request)
    {

        if(Auth::check())
        {

            if (Auth::check() <= $this->nivel_minimo)
            {

                $usuario = $request->input('username');
                $name = $request->input('name');
                $password = $request->input('password');
                $rol = $request->input('rol');
                $email = $request->input('email');
                $valor = null;
                try
                {
                    $valor = User::create([
                        'name' => $name,
                        'username' => $usuario,
                        'password' => bcrypt($password),
                        'email' => $email,
                        'rol' => $rol
                    ]);

                    if ($valor) {
                        return redirect('/panel/agregarUsuario')->with('statusok', 'OK');
                    }
                }
                catch (QueryException $qex)
                {
                    if($qex->getCode()==23000)
                    {
                        return redirect('/panel/agregarUsuario')->with('statusduplicado', 'DUPLICADO');
                    }
                }
                catch (Exception $ex)
                {
                    error_log($ex->getMessage());

                    return redirect('/panel/agregarUsuario')->with('statuserror', 'ERROR');
                }

            }
            else
            {
                abort(-1, "Permiso no otorgado");
            }
        }
    }
}