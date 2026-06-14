@extends('plantilla')

@section('titulo', 'Página no encontrada')

@section('contenido')
<div class="container text-center mt-5">
    <h1 class="display-4 text-danger">404</h1>
    <p class="lead">La página que buscas no existe.</p>
    <a href="{{ route('inicio') }}" class="btn btn-dark mt-3">Volver al inicio</a>
</div>
@endsection