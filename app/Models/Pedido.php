<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function items()
{
    return $this->hasMany(PedidoItem::class);
}
}
