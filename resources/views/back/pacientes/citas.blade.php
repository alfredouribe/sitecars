@extends('back.app')

@section("content")
    <h1 class="mt-4">Calendario de Citas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/index">Inicio</a></li>
        <li class="breadcrumb-item active">Calendario de Citas</li>
    </ol>

    <div class="row">
        <calendario-general-component id="{{$cliente_usuario[0]->cliente_id}}" idusuario="{{Auth::user()->id}}"></calendario-general-component>
    </div>
@endsection