<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class SesionUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {

            $user = Auth::user();
            //$users = DB::table('users')->where('user_id', $user->user_id)->get();
            //Session::put('rol', $users);

            return $next($request);
        }
        else
        {
            redirect('/login');
        }

    }
}
