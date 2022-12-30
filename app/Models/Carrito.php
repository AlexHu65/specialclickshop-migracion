<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Carrito;
use App\Models\Articles;
use App\Models\DetalleCarrito;

class Carrito extends Model
{
    protected $table = 'cart';

    public function detalle()
    {
        return $this->hasMany(DetalleCarrito::class);
    }
}
