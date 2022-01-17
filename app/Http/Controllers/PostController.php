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
        //
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
