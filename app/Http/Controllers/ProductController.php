<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Articles as Products;
use App\Models\Comments;
use App\Models\Review;
use App\Models\Models;
use App\Models\Color;
use App\Models\Blog;
use App\Models\ArticuloInventario as Inventario;
use App\Http\Requests\CommentRequest;

class ProductController extends Controller
{
    public $title;
    public $posts;
    public $categories;
    public $products;
    public $offers;
    public $app;

    public function __construct(){
        $this->title = 'Shop';
        $this->app = config('app.name');
        $this->posts = Blog::where(['active' => 1])->orderBy('created_at')->get()->take(3);
        $this->categories = Categories::where(['active' => 1])->get();
        $this->products =  Products::where(['status' => 1])->inRandomOrder()->get();
        $this->offers =  Products::where('offer','>', 0)->get();
    }

    public function inventario(Request $request){

        $inventario = Inventario::where(['modelo_id' => $request->model , 'articulo_id' => $request->id , 'color_id' => $request->color])->first();

        if($inventario){
            if($inventario->cantidad >= $request->quantity ){
                return response(['inventario' => true, 'quantity' => $inventario->cantidad]); 
            }
            return response(['inventario' => false, 'quantity' => $inventario->cantidad]); 
        }
        
       return response(['inventario' => false, 'quantity' => 0]); 

    }

    public function validateStock(Request $request){      

        $inventario = Inventario::where(
            ['modelo_id' => $request->modelo_id ,
            'articulo_id' => $request->articulo_id , 
            'color_id' => $request->color_id])->first(['cantidad']);

        return response($inventario);
    }


    public function validateStockTest(Request $request){      

        $inventario = Inventario::with(['color', 'colorSecundario', 'article' , 'modelo'])->where(['articulo_id' => $request->product, 'modelo_id' => $request->modelo ])->get();

        return response($inventario);
    }

    public function index(Request $request){
        
        $category = Categories::where(['active' => 1, 'slug'=> $request->slug])->first();

        if($category){            
            //solo si encuentra category
            $parameters = [
                'title' => $category->name,
                'app' => $this->app,
                'products' => $category->products()->paginate(12),
                'categories' => Categories::where(['active' => 1])->get(),
                'banner' => $category->banner
            ];   
            
            return view('products.index', $parameters);
        }else{
            return redirect('products');
        }

    }

    public function shop(Request $request){

        $parameters = [
            'title' => 'Shop',
            'app' => $this->app,
            'categories' => Categories::where(['active' => 1])->get(),
            'products' => Products::where(['status' => 1])->paginate(12)
        ];

        $model = Models::find($request->id);

        if($model){
            $parameters['products'] = $model->products()->paginate(12);
            $parameters['media'] = $model->thumbnail;
            $parameters['textMedia'] = $model->name;
        }

        return view('shop.index', $parameters);
    }

    public function search(Request $request){
        
        if(isset($request->search)){

            $parameters = [
                'search' => $request->search,
                'title' => 'Shop | Result of search ' . $request->search ,
                'categories' => Categories::where(['active' => 1])->get(),
                'products' => Products::where('name','like','%'.$request->search.'%')->paginate(12)
            ];

            return view('products.index', $parameters);
        }

        return redirect('products');
    }

    public function detail(Request $request){

        $product = Products::where(['status' => 1, 'slug' => $request->slug])->with(['colorPrincipal', 'colorSecundario'])->first();

        if($product){

            $category = Categories::find($product->category->id);

            $parameters = [
                'app' => $this->app,
                'title' => $product->name,
                'product' => $product,
                'categories' => Categories::where(['active' => 1])->get(),
                'related' =>  $category->products
            ]; 

            return view('products.detail.index' , $parameters);
        }

        return redirect('products');
    }

    public function comment(Request $request){

        $validatedData = $request->validate([
            'article_id' => ['required'],
            'name' => ['required', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/', 'max:255'],
            'email' => ['required', 'email'],
            'number' => ['required' , 'integer'],
            'message' => ['max:120' , 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/']
        ]);

        $comment = new Comments;
        $comment->name = $request->name;
        $comment->article_id =  $request->article_id;
        $comment->email = $request->email;
        $comment->number =  $request->number;
        $comment->message = $request->message;

        if($comment->save()){

            $parameters = [
                'status' => true,
                'msg' => 'Thank you for sending your comment.',
                'categories' => Categories::where(['active' => 1])->get(),
                'title' => 'Contact'
            ];

            return view('contact.index',$parameters);
        }

    }

    public function reviews(Request $request){
        //solo se pasan las que se aprueban por el admin
        return Review::where(['status' => 1 , 'article_id' => $request->product])->get();
    }

    public function products(Request $request){
        echo $request->id;
        //solo se pasan las que se aprueban por el admin
       /* $product = Products::find($request->id);
        $price = ($product->offer > 0 ? $product->offer  :  $product->price);
        $product->subtotal =  number_format(floatval($price * $request->quantity),2);
        $product->quantity =  $request->quantity;
        $product->price = number_format(floatval($product->price),2);
        $product->offer = number_format(floatval($product->offer),2);
        $product->models = Models::where(['id' => $request->model])->first();
        $product->color = Color::where(['id' => $request->color])->first();
        $product->idCart = $product->id . $product->models->id . $product->category_id;
        return $product;*/
    }

    public function images(Request $request){
        return Products::where(['status' => 1 , 'id' => $request->product])->first(['gallery']);
    }

    public function total(Request $request){

        $subtotal = 0;
        $total = 0;
        $free = false;

        foreach($request->carrito as $producto){
            $product = Products::where(['status' => 1 , 'id' => $producto['id']])->first();
            $price = ($product->offer > 0 ? $product->offer  :  $product->price);
            $subtotal +=  number_format(floatval($price * $producto['quantity']),2);           
        }

        if($subtotal > 45){

            $total = number_format(floatval($subtotal),2);
            $free = true;

        }else{

            $total = number_format(floatval($subtotal + setting('site.shipping')),2);

        }


        return response(['total' => $total , 'status' => true , 'free' => $free]); 
    }

    public function reviewsSave(Request $request){

        $validatedData = $request->validate([
            'article_id' => ['required'],
            'rating' => ['required'],
            'subject' => ['required'],
            'name' => ['required', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/', 'max:255'],
            'email' => ['required', 'email'],
        ]);

        $review = new Review;
        $review->article_id = $request->article_id;
        $review->value = ($request->rating == 0 ? 1 : $request->rating);
        $review->message = $request->message;
        $review->name = $request->name;
        $review->subject = $request->subject;
        $review->email = $request->email;

        if($review->save()){
            return response(['msg' => 'Your review was received.', 'status' => true]); 
        }

        return response(['msg' => 'Error on review.', 'status' => false]); 
    }

    public function offers(Request $request){

        $parameters = [
            'title' => __('SPECIAL OFFERS'),
            'app' => $this->app,
            'categories' => Categories::where(['active' => 1])->get(),
            'products' => Products::where('offer', '>' , 0)->paginate(12)
        ];

        if(isset($request->id)){
            $parameters['products'] = Products::where(['status' => 1 , 'category_id' => $request->id])->paginate(12);
        }

        return view('shop.index', $parameters);

    }


    public function models(Request $request){

        $category = Categories::where(['slug' => $request->slug])->first();

        if ($category) {

            $parameters = [
                'title' => __('Models'),
                'categories' => Categories::where(['active' => 1])->get(),
                'models' => $category->models()->orderBy('id')->paginate(12),
                'app' => $this->app = config('app.name')
            ];           
            
    
            return view('phones.index', $parameters);
        }

        $parameters = [
            'title' => __('Models'),
            'categories' => Categories::where(['active' => 1])->get(),
        ];

        return view('shop.index', $parameters);
        

    }

    public function modelsByProduct(Request $request){
        return Products::find($request->product)->models;
    }

    public function colorsByModel(Request $request){
        return Inventario::with('color')->where(['articulo_id' => $request->product , 'modelo_id' => $request->model])->get();
    }
}
