<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Modelos
use App;
use App\Models\Categories;
use App\Models\Banner;
use App\Models\Suscription;
use App\Models\Blog;
use App\Models\Articles as Products;
use App\Models\Carrito;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{

    public $title;
    public $posts;
    public $categories;
    public $products;
    public $offers;
    public $app;

    public function __construct(){
        $this->title = 'Home';
        $this->app = config('app.name');
        $this->posts = Blog::where(['active' => 1])->orderBy('created_at')->get()->take(3);
        $this->categories = Categories::where(['active' => 1])->get();
        $this->products =  Products::where(['status' => 1])->inRandomOrder()->get();
        $this->offers =  Products::where('offer','>', 0)->get();
    }

    public function index(){

        $parameters = [
            'categories' => $this->categories,
            'title' => $this->title,
            'app' => $this->app,
            'posts' => $this->posts,
            'products' => $this->products,
            'offers' => $this->offers,
            'showMainBanner' => true
          ];

          return view('home.index', $parameters);

    }

    public function traducciones(Request $request){

        //Switch a que traduccione bucamos
        switch ($request->traduccion) {
            case 'menu':
                return $this->menuTraduccion($request->locale);
            case 'review':
                return $this->ratingTraduccion($request->locale);
            case 'cart':
                return $this->cartTraduccion($request->locale);
                break;
        }

        return [];

    }

    public function menuTraduccion($locale){

        App::setLocale($locale);

        return [
            'shop' => __('SHOP'),
            'categories' => __('CATEGORIES'),
            'blog' => __('BLOG'),
            'todo' => __('VIEW ALL'),
            'account' => __('MY ACCOUNT'),
            'cart' => __('SHOPIING CART'),
            'special' => __('OFFERS'),
            'search' => __('SEARCH'),
            'idioma' => $locale
        ];
    }

    public function cartTraduccion($locale){

        App::setLocale($locale);

        return [
            'model' => __('Model:'),
            'model2' => __('Available Models'),
            'price' => __('Price'),
            'product' => __('Product'),
            'quantity' => __('Quantity'),
            'total' => __('Total'),
            'add' => __('Add to Cart'),
            'please' => __('*Please select a color.'),
            'please2' => __('*Please select an option.'),
            'please3' => __('*Please select a model.'),
            'stock' => __('There\'s not enough stock'),
            'stock2' => __('We don\'t have enough stock of this product'),
            'crt1' => __('Item added to cart'),
            'crt2' => __('Wanna go to the shopping kart?'),
            'color' => __('Color'),
            'cancel' => __('Continuing shopping'),
            'go' => __('Go to shopping cart'),
            'myShopping' => __('My shopping cart'),
            'read1' => __('I\'ve read and accept the'),
            'read2' => __('terms & conditions'),
            'read3' => __('Please accept the terms & conditions'),
            'read4' => __('& refunds conditions.'),
            'checkout' => __('Proceed to checkout'),
            'pleaseLogin' => __('Please login to continue'),
            'goLogin' => __('Login'),
            'home' => __('Home'),
            'shop' => __('Shop')
        ];

    }

    public function ratingTraduccion($locale){

        App::setLocale($locale);

        return [
            'overall' => __('Overall'),
            'review' => __('Add a Review'),
            'rating' => __('Your Rating'),
            'estrella' => __('Star'),
            'basado' => __('Based on'),
            'name' => __('Your Full name'),
            'email' => __('Email Address'),
            'subject' => __('Enter Subject'),
            'mensaje' => __('Message'),
            'submit' => __('Submit Now')
        ];
    }

    public function categories(Request $request){
        App::setLocale($request->locale);
        return $this->categories;
    }

    public function languages($locale){

        App::setLocale($locale);

        $langs = Config::get('languages');

        foreach ($langs as $lang => $language) {
            if($lang != App::getLocale()){

                return $language;
            }
        }
    }

    public function banners(Request $request){
        return Banner::where(['active' => 1])->orderBy('position')->get();
    }

    public function privacy(Request $request){

        $parameters = [
            'categories' => $this->categories,
            'title' => $this->title,
            'posts' => $this->posts,
            'products' => $this->products,
            'privacy' => setting('site.privacy')
          ];

        return view('privacy.index', $parameters);

    }

    public function refund(Request $request){

        $parameters = [
            'categories' => $this->categories,
            'title' => $this->title,
            'posts' => $this->posts,
            'products' => $this->products,
            'privacy' => setting('site.refund')
          ];

        return view('privacy.index', $parameters);

    }

}
