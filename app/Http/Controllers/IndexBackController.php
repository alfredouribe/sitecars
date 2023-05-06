<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente_usuario;
use Illuminate\Support\Facades\Auth;
class IndexBackController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cliente_usuario = cliente_usuario::select('*')->where("cliente_user_id", "=", Auth::user()->id)->get();
        return view('back.index', compact('cliente_usuario'));
    }

    public function citas(){
        $cliente_usuario = cliente_usuario::select('*')->where("cliente_user_id", "=", Auth::user()->id)->get();
        return view('back.pacientes.citas', compact('cliente_usuario'));
    }
}
