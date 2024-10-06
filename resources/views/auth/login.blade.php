@extends('layouts.app')


@section('titulo')
    Inicia sesion en DevsTagram
@endsection


@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen de login usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <!--novalidate desahbailida la validacion de html y activa la validacion del servidor-->
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">email</label>
                    <input type="email" id="email" name="email" placeholder="Tu Email de Registro"
                        class="border p-3 w-full rounded-lg 
                    @error('email')
                        border-red-500
                    @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-600 text-center p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">password</label>
                    <input type="password" id="password" name="password" placeholder="Password de Registro"
                        class="border p-3 w-full rounded-lg 
                    @error('password')
                        border-red-500
                    @enderror">

                    @error('password')
                        <p class="text-red-600 text-center p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                        <input type="checkbox" name="remenber"> <label for="" class="text-gray-500 text-sm">Mantener mi sesion abierta</label>
                </div>

                @if (@session('mensaje'))
                    <p class="text-red-600 text-center p-2">
                        {{ session('mensaje') }}
                    </p>
                @endif
                <input type="submit"
                    class="bg-sky-600 hover:bg-sky-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                    value="Inicia Sesion">
            </form>
        </div>
    </div>
@endsection
