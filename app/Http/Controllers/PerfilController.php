<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //ir a la vista de edit perfil
    public function index()
    {
        return view('Perfil.index');
    }

    //validation para vista perfil
    public function store(Request $request)
    {
        //modificar el request aca seria si en la base datos el campo debe ser unico mostrar un error pero con esto 
        $request->request->add(['username' => Str::slug($request->username)/*str::slug funciona para quitar los agregando (-) y lo convierte en minuscula*/]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twiter,editar-perfil'],
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }
        //gaurdar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();
        //redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
