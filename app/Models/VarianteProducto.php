<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\Color;
use App\Models\Talla;

class VarianteProducto extends Model
{
    protected $table = 'variantes_productos'; // 👈 importante

    protected $fillable = [
        'producto_id',
        'color_id',
        'talla_id',
        'stock',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function talla()
    {
        return $this->belongsTo(Talla::class);
    }
}
