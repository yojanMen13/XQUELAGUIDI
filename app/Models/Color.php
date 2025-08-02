<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VarianteProducto;

class Color extends Model
{
    protected $table = 'colores'; // <-- ESTA LÍNEA ES CLAVE

    protected $fillable = ['nombre', 'codigo_hex'];

    public function variantes()
    {
        return $this->hasMany(VarianteProducto::class);
    }
}

