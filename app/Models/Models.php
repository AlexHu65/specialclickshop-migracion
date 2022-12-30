<?php

namespace App\Models;

use App\Models\Articles as Product;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
   protected $table = 'models';

   public function products(){
      return $this->belongsToMany(Product::class ,'articulo_modelo');
   }

   public function categories(){
      return $this->belongsTo(Categories::class, 'category_model');
   }

}
