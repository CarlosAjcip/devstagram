<!-- directivas -->
@extends('layouts.app')

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
    {{--  --}}
    <!--componente normal sin usar $slost-->
     <x-listar-post :posts="$posts" />

    <!--componente ya usando  $slost-->
    {{-- <x-listar-post>
        <h1>test de los slost</h1>
    </x-listar-post> --}}
@endsection
