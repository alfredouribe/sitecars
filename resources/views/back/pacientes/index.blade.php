@extends('back.app')

@section("content")
    <h1 class="mt-4">Pacientes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/index">Inicio</a></li>
        <li class="breadcrumb-item active">Pacientes</li>
    </ol>

    <div class="row">
        <pacientes-component id="{{$cliente_usuario[0]->cliente_id}}" idusuario="{{Auth::user()->id}}"></pacientes-component>
    </div>
@endsection