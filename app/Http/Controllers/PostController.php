<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }
    public function index(User $user)
    {
        // dd(auth()->user());
        //elpaginate funciona como una funcion de paginar y en lavista colocar la paginacion
        $posts = Post::where('user_id', $user->id)->latest()->paginate(10);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    //redirige a la vista
    public function create()
    {
        return view('posts.create');
    }

    //guardar los dtos
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descipcion' => 'required',
            'imagen' => 'required'
        ]);

        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descipcion' => $request->descipcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        //otra forma de crea registros
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descipcion = $request->descipcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //almacenando post con una relacion esta es un mas estilo de laravel
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descipcion' => $request->descipcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        //eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
            //File::delete();
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
