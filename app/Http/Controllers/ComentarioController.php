<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use App\Http\Resources\ComentarioResource;
use App\Http\Controllers\ResponseApiController;

class ComentarioController extends ResponseApiController
{
   
    public function index()
    {
        $message = null;

        $comentarios = Comentario::orderByDesc('created_at')->get();
        $data = ComentarioResource::collection($comentarios);
        $message = $this->sendResponse($data, 'Comentarios listados correctamente');

        return $message;
    }

  
    public function store(Request $request)
    {
        $message = null;

        $request->validate([
            '*.post_id' => 'required|integer',
            '*.contenido' => 'required|string|max:500',
        ]);

        try {
            $comentarios = [];

            foreach ($request->all() as $comentario) {
                $post = new Comentario();
                $post->post_id = $comentario['post_id'];
                $post->contenido = $comentario['contenido'];
                $post->save();

                $comentarios[] = $post;
            }
            $message = $this->sendResponse($comentarios, 'Comentarios creado correctamente');
        } catch (\Throwable $th) {
            $message = $this->sendError('Error al crear los comentarios', $th->getMessage());
        }

        return $message;
    }

    
    public function show($id)
    {
        $message = null;

        $comentario = Comentario::find($id);

        if (!$comentario) {
            $message = $this->sendError('Comentario no encontrado');
        } else {
            $message = $this->sendResponse($comentario, 'Comentario encontrado');
        }

        return $message;
    }


    public function update(Request $request, $id)
    {
        $message = null;

        $request->validate([
            'post_id' => 'required|integer',
            'contenido' => 'required|string|max:500',
        ]);

        try {
            $comentario = Comentario::find($id);

            if (!$comentario) {
                $message = $this->sendError('Comentario no encontrado');
            } else {
                $comentario->update($request->all());
                $message = $this->sendResponse($comentario, 'Comentario actualizado');
            }
        } catch (\Throwable $th) {
            $message = $this->sendError('Error al actualizar el comentario', $th->getMessage());
        }

        return $message;
    }

    
    public function destroy($id)
    {
        $message = null;

        try {
            $comentario = Comentario::find($id);

            if (!$comentario) {
                $message = $this->sendError('Comentario no encontrado');
            } else {
                $comentario->delete();
                $message = $this->sendResponse($comentario, 'Comentario eliminado');
            }
        } catch (\Throwable $th) {
            $message = $this->sendError('Error al eliminar el comentario', $th->getMessage());
        }

        return $message;
    }
}
