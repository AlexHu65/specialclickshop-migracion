<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Color;
use App\Models\Articles;
use App\Models\Models;

class ArticuloInventario extends Model
{
    protected $table = 'articulos_inventarios';

    public function color(){
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function colorSecundario(){
        return $this->belongsTo(Color::class, 'color_secundario_id');
    }

    public function article(){
        return $this->belongsTo(Articles::class, 'articulo_id');
    }

    public function modelo(){
        return $this->belongsTo(Models::class, 'modelo_id');
    }
}
