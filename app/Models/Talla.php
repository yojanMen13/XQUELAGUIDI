<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VarianteProducto;

class Talla extends Model
{
    protected $table = 'tallas'; // <- importante

    protected $fillable = ['etiqueta'];

    public function variantes()
    {
        return $this->hasMany(VarianteProducto::class);
    }
}
