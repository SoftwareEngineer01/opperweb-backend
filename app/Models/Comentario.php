<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'contenido',
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
