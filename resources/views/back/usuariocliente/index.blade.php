@extends('back.app')

@section("content")
    <h1 class="mt-4">Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>

    <div class="row">
        <usuarios-cliente-component id="{{$cliente_usuario[0]->cliente_id}}" idusuario="{{Auth::user()->id}}"></usuarios-cliente-component>
    </div>
@endsection