<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    protected $table = 'imagenes_productos'; // <-- o el nombre real que tengas
    protected $fillable = ['producto_id', 'url', 'principal'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
