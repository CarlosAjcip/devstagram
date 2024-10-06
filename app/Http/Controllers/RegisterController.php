<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request);
        //dd($request->get('username')); //acceder los valores

        //modificar el request aca seria si en la base datos el campo debe ser unico mostrar un error pero con esto 
        $request->request->add(['username'=> Str::slug( $request->username)/*str::slug funciona para quitar los agregando (-) y lo convierte en minuscula*/]);
        //validacion
        $this->validate($request,[
            'name' => 'required|max:20',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        //crear un registro
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make( $request->password),// hash el password
        ]);

        //autenticar usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //otra forma de autenticar el usaurio
        auth()->attempt($request->only('email','password'));

        //redireccionar al usuario
        return redirect()->route('posts.index');
    }
}
