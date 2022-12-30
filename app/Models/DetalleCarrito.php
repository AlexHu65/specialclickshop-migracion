<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Carrito;

class DetalleCarrito extends Model
{
    protected $table = 'cart_detail';

      
    public function detalle(){
        return $this->belongsTo(Carrito::class , 'carrito_id');
    }

    
}
