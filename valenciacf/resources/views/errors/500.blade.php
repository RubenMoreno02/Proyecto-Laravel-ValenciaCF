@extends('plantilla')

@section('titulo', 'Error del servidor')

@section('contenido')
<div class="container text-center mt-5">
    <h1 class="display-4 text-warning">500</h1>
    <p class="lead">Ha ocurrido un error interno.</p>
    <p>Inténtalo más tarde.</p>
    <a href="{{ route('inicio') }}" class="btn btn-dark mt-3">Volver al inicio</a>
</div>
@endsection