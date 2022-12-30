<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory;
class Blog extends Model
{
    protected $table = "blog";

    public function category(){
        return belongsTo(BlogCategory::class, 'category_id');
    }
    
}
