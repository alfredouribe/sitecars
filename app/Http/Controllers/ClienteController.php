<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\cliente_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente_usuario = cliente_usuario::select('*')->where("cliente_user_id", "=", Auth::user()->id)->get();

        if(isset($cliente_usuario[0]->cliente_id) && count($cliente_usuario)){
            return redirect('/home');
        }else{ 
            return view('back.clientes.index');
        }
        
    }

    public function cliente(Request $request){
        $cliente_usuario = cliente_usuario::select('*')->where("cliente_user_id", "=", Auth::user()->id)->get();
        $id = $request->id;

        if(isset($cliente_usuario[0]->cliente_id) && $cliente_usuario[0]->cliente_id>0){
            return redirect('/home');
        }else{
            return view('back.clientes.detail', compact('id'));
        }
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
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
