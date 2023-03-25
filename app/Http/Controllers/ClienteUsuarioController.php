<?php

namespace App\Http\Controllers;

use App\Models\cliente_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente_usuario = cliente_usuario::select('*')->where("cliente_user_id", "=", Auth::user()->id)->get();
        return view("back.usuariocliente.index", compact('cliente_usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cliente_usuario  $cliente_usuario
     * @return \Illuminate\Http\Response
     */
    public function show(cliente_usuario $cliente_usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cliente_usuario  $cliente_usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(cliente_usuario $cliente_usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cliente_usuario  $cliente_usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cliente_usuario $cliente_usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cliente_usuario  $cliente_usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(cliente_usuario $cliente_usuario)
    {
        //
    }
}
