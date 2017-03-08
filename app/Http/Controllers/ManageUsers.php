<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\DB;

class ManageUsers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = DB::table('users')->simplePaginate(5);
        return view('panel.manageusers')->with('users', $users);
    }
}
