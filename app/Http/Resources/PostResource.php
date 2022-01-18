<?php

namespace App\Http\Resources;

use App\Http\Resources\ComentarioResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'categoria_id' => $this->categoria->id,
            'categoria' => $this->categoria->nombre,
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'comentarios' => ComentarioResource::collection($this->comentarios),
            'created_at' => $this->created_at,
        ];
    }
}
