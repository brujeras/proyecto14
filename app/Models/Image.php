<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'imageable_id', 'imageable_type'];
    public function imageable()
    {
        return $this->morphTo(); // relacion que puede tener varios modelos relacionados en una sola tabla, gracias a la relacion y los campos imageable_type guarda el modelo que usa esa imagen y imageable_id almacena el id del producto en cuestion
    }
}
