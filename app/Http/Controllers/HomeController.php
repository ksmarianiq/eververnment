<?php

namespace App\Http\Controllers;

use App\Models\Organisateur;
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

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userHome()
    {
        return view('home',["msg"=>"I am user role"]);
    }

    public function editorHome()
    {
        return view('home',["msg"=>"I am Editor role"]);
    }

    public function adminHome()
    {
        return view('Admin.index');
    }
}
