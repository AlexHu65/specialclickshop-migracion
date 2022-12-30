<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Article as Product;

class Comments extends Model
{
    protected $table = 'comments';
}
