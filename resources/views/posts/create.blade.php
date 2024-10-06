@extends('layouts.app')

@section('titulo')
    Crea una nueva publicacion
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagen.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        <div class="md:w-1/2 p-10 bg-white  rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Tu Titulo de la publicacion"
                        class="border p-3 w-full rounded-lg @error('titulo')
                        border-red-500
                    @enderror"
                        value="{{ old('titulo') }}">
                    @error('titulo')
                        <p class="text-red-600 text-center p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descipcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripcion</label>
                    <textarea id="descipcion" name="descipcion" placeholder="Descripcion de la publicacion"
                        class="border p-3 w-full rounded-lg @error('descipcion')
                        border-red-500
                    @enderror"
                        value="">{{ old('descipcion') }}</textarea>
                    @error('descipcion')
                        <p class="text-red-600 text-center p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input name="imagen" type="hidden" value="{{ old('imagen') }}">
                    @error('imagen')
                        <p class="text-red-600 text-center p-2">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit"
                    class="bg-sky-600 hover:bg-sky-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                    value="Crear Publicacion">
            </form>
        </div>
    </div>
@endsection
