<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Articles as Product;
use App\Models\Models;
class Categories extends Model
{
    protected $table = 'categories';

    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }

    public function models(){
        return $this->belongsToMany(Models::class, 'category_model');
    }
}
