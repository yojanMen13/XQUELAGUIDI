<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ImagenProducto;
use App\Models\VarianteProducto;
use App\Models\Categoria;
class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'precio',
        'activo',
        'categoria_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class);
    }

    public function variantes()
    {
        return $this->hasMany(VarianteProducto::class);
    }
}

