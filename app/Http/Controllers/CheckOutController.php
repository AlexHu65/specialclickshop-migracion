<?php

namespace App\Http\Controllers;

// Modelos
use App\Models\Categories;
use App\Models\Banner;
use App\Models\Models;
use App\Models\Color;
use App\Models\Suscription;
use App\Models\Blog;
use App\Models\Carrito;
use App\Models\Articles as Products;
use App\Models\ArticuloInventario as Inventario;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;

class CheckOutController extends Controller
{

    public $title;
    public $posts;
    public $categories;
    public $products;
  
    public function __construct(){
  
      $this->title = 'Home';
      $this->posts = Blog::where(['active' => 1])->orderBy('created_at')->get()->take(3);
      $this->categories = Categories::where(['active' => 1])->get();
      $this->products =  Products::where(['status' => 1])->inRandomOrder()->get();
  
    }

    public function payment(Request $request){

      Stripe::setApiKey(config('services.stripe.secret'));
       
      return response($intentent = PaymentIntent::create([
        'amount' => 1099,
        'currency' => 'mxn',
        'metadata' => ['integration_check' => 'accept_a_payment'],
      ]));

    }

    public function success(Request $request){

        $parameters = [
          'title' => 'Success',
          'categories' => $this->categories,
        ];
  
        //restamos inventario
        $carrito = Carrito::where(['id' => $request->carrito])->first();
  
        foreach ($carrito->detalle as $value) {
          $inventario = Inventario::where(['articulo_id' => $value->articulo_id , 'modelo_id' => $value->modelo, 'color_id' => $value->color])->decrement('cantidad' , $value->cantidad);
        }  
        
        $carrito->pagado = 1;
        $carrito->save();
  
        return view('checkout.success', $parameters);
      }


    public function checkout(Request $request){

        //stripe S1st3m2s!12345
        $total = 0;

        $free = false;

        $newLineItems = [];

        $currency = 'usd';
        //se agrega price de shipping de stripe
        $shippingCode = 'shr_1JVJgWLOE1PdUSn8UYOQxzyu';
        //se agrega price de shipping de stripe para gratuito
        $shippingCodeFree = 'shr_1JVJsHLOE1PdUSn8hzq5MEy1';

        foreach($request->cart as $articulo){
            
            $price = $articulo['inventarioSelected']['article']['offer'] > 0 ? $articulo['inventarioSelected']['article']['offer']  :  $articulo['inventarioSelected']['article']['price'];
            
            $total = $request->total;
            
            $newLineItems[] = [
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => $articulo['inventarioSelected']['article']['name'] . __('Model') . ': ' . $articulo['inventarioSelected']['modelo']['name'] . ' Color: ' . $articulo['inventarioSelected']['color']['name'],
                    ],
                    'unit_amount' => ($price * 100)
                ],
                'quantity' => $articulo['quantity']
            ];
        }

        $free = ($total > 45 ? true : false);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'shipping_rates' => [($free ? $shippingCodeFree : $shippingCode)],
            'shipping_address_collection' => [
            'allowed_countries' => ['US'],
            ],
            'line_items' => [$newLineItems],
            'mode' => 'payment',
            'success_url' => url('/success/'. $request->carritoId),
            'cancel_url' => url('/')
        ]);  

        //update payment intent
        $carrito = Carrito::find($request->carritoId);

        if($carrito){
            $carrito->order_id =  $session->payment_intent;
            $carrito->save();
        }

        return response(['msg' => __('Information saved'), 'status' => true , 'urlRedirect' => $session->url]); 

    }

    public function paymentIntent(Request $request){

      $carrito = Carrito::find($request->cart);
      
      $stripe = new \Stripe\StripeClient(
        config('services.stripe.secret')        
      );
      
      //var_dump($stripe->paymentIntents->retrieve($carrito->order_id,[]));
      return response($stripe->paymentIntents->retrieve($carrito->order_id,[]));
      
    }
}
