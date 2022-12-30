<?php

namespace App\Http\Controllers;

// Modelos
use App\Models\Categories;
use App\Models\Banner;
use App\Models\Suscription;
use App\Models\Blog;
use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\Articles as Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

  public $title;
  public $posts;
  public $categories;
  public $products;
  protected $user;

  public function __construct(){
    
    $this->title = 'Dashboard';
    $this->posts = Blog::where(['active' => 1])->orderBy('created_at')->get()->take(3);
    $this->categories = Categories::where(['active' => 1])->get();
    $this->products =  Products::where(['status' => 1])->inRandomOrder()->get();
  }

  public function index(){

    $this->user = Auth::user();

    $carrito = Carrito::where(['user_id' => $this->user->id , 'pagado' => 0])->get();
    $detalle = [];

    $parameters = [
      'categories' => $this->categories,
      'title' => $this->title,
      'posts' => $this->posts,
      'products' => $this->products,
      'carrito' => $carrito,
      'orders' => Carrito::where(['user_id' => $this->user->id , 'pagado' => 1])->get(),
      'dashboard' => true
    ];

    return view('dashboard.index', $parameters);
    
  }

}
