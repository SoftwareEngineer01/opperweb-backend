<?php

namespace App\Models;

use App\Models\Categoria;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'titulo',
        'contenido',
    ];

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
}
