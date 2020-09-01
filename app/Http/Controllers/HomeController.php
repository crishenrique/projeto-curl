<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Artigo;


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

    public function index()
    {

        $artigos = Artigo::where('id_usuario', '=', Auth::user()->id)->paginate(10);



        return view('home', ['artigos' => $artigos]);
    }
}
