<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Controllers\ResponseApiController;

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
        ]);

        try {
            $post = Post::create($request->all());
            $data = new PostResource($post);
            $message = $this->sendResponse($data, 'Post creado correctamente');
        }catch (\Exception $e) {
            $message = $this->sendError('Error al crear el post', $e->getMessage());
        }

        return $message;
    }

    
    public function show($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
