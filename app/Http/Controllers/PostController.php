<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Controllers\ResponseApiController;
use App\Models\Comentario;

class PostController extends ResponseApiController
{
   
    public function index()
    {
        $message = null;

        $posts = Post::orderByDesc('created_at')->get();
        $data = PostResource::collection($posts);
        $message = $this->sendResponse($data, 'Posts listados correctamente');

        return $message;
    }

   
    public function store(Request $request)
    {
        $message = null;

        $request->validate([
            'categoria_id' => 'required',
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'comentarios' => 'required|array',
        ]);

        try {
            $post = new Post();
            $post->categoria_id = $request->categoria_id;
            $post->titulo = $request->titulo;
            $post->contenido = $request->contenido;
            $post->save();

            foreach ($request->comentarios as $comentario) {
                $post->comentarios()->save(new Comentario([
                    'contenido' => $comentario['contenido'],
                ]));
            }

            $data = new PostResource($post);
            $message = $this->sendResponse($data, 'Post creado correctamente');
        }catch (\Exception $e) {
            $message = $this->sendError('Error al crear el post', $e->getMessage());
        }

        return $message;
    }

    
    public function show($id)
    {
        $message = null;

        try {
            $post = Post::findOrFail($id);
            $data = new PostResource($post);
            $message = $this->sendResponse($data, 'Post encontrado correctamente');
        }catch (\Exception $e) {
            $message = $this->sendError('Error al encontrar el post', $e->getMessage());
        }

        return $message;
    }


    public function update(Request $request, $id) {
        $message = null;

        $request->validate([
            'categoria_id' => 'required',
            'titulo' => 'required|string|max:150',
            'contenido' => 'required|string',
        ]);

        try {
            $post = Post::findOrFail($id);            
            $post->update($request->all());

            $comentarios = $request->comentarios;

            if($comentarios != null) {

                $post->comentarios()->where('post_id', $id)->delete();

                foreach ($comentarios as $comentario) {
                    $post->comentarios()->save(new Comentario([
                        'contenido' => $comentario['contenido'],
                    ]));
                }
            }            
           
            $data = new PostResource($post);
            $message = $this->sendResponse($data, 'Post actualizado correctamente');
        }catch (\Exception $e) {
            $message = $this->sendError('Error al actualizar el post', $e->getMessage());
        }

        return $message;
    }

   
    public function destroy($id)
    {
        $message = null;

        try {
            $post = Post::findOrFail($id);
            $post->delete();
            
            $message = $this->sendResponse($post, 'Post eliminado correctamente');
        }catch (\Exception $e) {
            $message = $this->sendError('Error al eliminar el post', $e->getMessage());
        }

        return $message;
    }
}
