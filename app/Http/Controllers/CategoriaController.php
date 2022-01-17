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
