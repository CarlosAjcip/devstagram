<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    ////seguir de la forma uno
    // public function store(Request $request, User $user)
    // {
    //     // Verificar si el usuario actual ya sigue al usuario objetivo
    //     if (!$user->followers()->where('follower_id', auth()->user()->id)->exists()) {
    //         // Si no lo sigue, agregar la relación
    //         $user->followers()->attach(auth()->user()->id);
    //     }

    //     return back();
    // }

    //seguir de la forma 2

    public function store(User $user)
    {
        $user->followers()->attach(auth()->user()->id);
        return back();
    }
    //dejar de seguir de la forma 1
    public function destroy(User $user)
    {
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
    ////dejar seguir 2
    ////dejar seguir
    // public function destroy(User $user)
    // {
    //     // Verificar si el usuario sigue al objetivo antes de eliminar
    //     if ($user->followers()->where('user_id', $user->id)->exists()) 
    //     {
    //         $user->followers()->detach(auth()->user()->id);
    //     }
    //     return back();
    // }
}
