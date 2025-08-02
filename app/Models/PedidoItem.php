<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    public function producto()
{
    return $this->belongsTo(Producto::class);
}
}
