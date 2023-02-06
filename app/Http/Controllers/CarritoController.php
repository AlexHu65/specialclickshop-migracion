<?php

namespace App\Http\Controllers;

use App;

// Modelos
use App\Models\Categories;
use App\Models\Banner;
use App\Models\Suscription;
use App\Models\Blog;
use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\ArticuloInventario;
use App\Models\Articles as Products;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    public $title;
    public $posts;
    public $categories;
    public $products;
    public $app;


    public function __construct(){

        $this->title = __('Shopping cart');
        $this->app = config('app.name');
        $this->posts = Blog::where(['active' => 1])->orderBy('created_at')->get()->take(3);
        $this->categories = Categories::where(['active' => 1])->get();
        $this->products =  Products::where(['status' => 1])->inRandomOrder()->get();

    }

    public function index(){

        $parameters = [
            'categories' => $this->categories,
            'title' => $this->title,
            'app' => $this->app,
            'posts' => $this->posts,
            'products' => $this->products
        ];

        return view('carrito.index', $parameters);

    }

    public function saveCart(Request $request){

        DB::beginTransaction();

        $carrito = new Carrito;

        $carrito->user_id = $request->user_id;

        $carrito->total = $request->total;

        $id = null;

        if($carrito->save()){

            $id = $carrito->id;

            foreach($request->cart as $articulo){

                $carritoDetalle =  new DetalleCarrito;
                $carritoDetalle->carrito_id = $id;
                $carritoDetalle->articulo_id = $articulo['inventarioSelected']['articulo_id'];
                $carritoDetalle->modelo = $articulo['inventarioSelected']['modelo_id'];
                $carritoDetalle->color = $articulo['inventarioSelected']['color_id'];
                $carritoDetalle->cantidad = $articulo['quantity'];
                $carritoDetalle->save();

                //tenemos que bloquear el inventario
                $inventario = ArticuloInventario::find($articulo['inventarioSelected']['id']);
                $inventario->increment('bloqueado', $articulo['quantity']);
                $inventario->save();
            }

            //Guardo carrito, inventario, detalle
            if($id){
                DB::commit();
                return response(['msg' => __('Information saved'), 'status' => true , 'id' => $id]);
            }

            return response(['msg' => __('Error'), 'status' => false, 'cart' => $request->cart]);
            DB::rollBack();

        }

        return response(['msg' => __('Error'), 'status' => false, 'cart' => $request->cart]);
        DB::rollBack();
    }
}
