<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comments;
use App\Models\Review;
use App\Models\Categories;
use App\Models\Models;
use App\Models\Color;
use TCG\Voyager\Traits\Resizable;


class Articles extends Model
{
    use Resizable;
    
    protected $table = 'articles';

    public function category(){
        return $this->belongsTo(Categories::class, 'category_id');
    }
    
    public function colorPrincipal(){
        return $this->belongsTo(Color::class, 'id_colorprincipal');
    }

    public function colorSecundario(){
        return $this->belongsTo(Color::class, 'id_segundocolor');
    }

    public function models(){
        return $this->belongsToMany(Models::class, 'articulo_modelo');
    }

    public function colorsArticle(){
        return $this->belongsToMany(Color::class, 'colors_article');
    }

    public function comments(){
        return $this->hasMany(Comments::class, 'article_id')->where(['status' => 1]);
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'article_id')->where(['status' => 1]);
    }
}
