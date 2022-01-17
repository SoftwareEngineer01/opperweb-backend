<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseApiController;

class CategoriaController extends ResponseApiController
{
  
    public function index()
    {
        $message = null;

        $categorias = Categoria::orderByDesc('created_at')->get();
        $message = $this->sendResponse($categorias, 'Categorias listadas correctamente');

        return $message;
    }

   
    public function store(Request $request)
    {
        $message = null;

        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria = Categoria::create($request->all());
        $message = $this->sendResponse($categoria, 'Categoria creada correctamente');

        return $message;
    }


    public function show($id)
    {
        $message = null;

        $categoria = Categoria::find($id);
        if(!$categoria) {
            $message = $this->sendError('Categoria no encontrada');
        } else {
            $message = $this->sendResponse($categoria, 'Categoria encontrada');
        }

        return $message;
    }

    
    public function update(Request $request, $id)
    {
        $message = null;

        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria = Categoria::find($id);
        if(!$categoria) {
            $message = $this->sendError('Categoria no encontrada');
        } else {
            $categoria->update($request->all());
            $message = $this->sendResponse($categoria, 'Categoria actualizada correctamente');
        }

        return $message;
    }

  
    public function destroy($id)
    {
        $message = null;

        $categoria = Categoria::find($id);
        if(!$categoria) {
            $message = $this->sendError('Categoria no encontrada');
        } else {
            $categoria->delete();
            $message = $this->sendResponse($categoria, 'Categoria eliminada correctamente');
        }

        return $message;
    }
}
