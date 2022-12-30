<div class="container">
  <div class="row">
    {{$carrito}}
    @if ($carrito)
      @foreach ($carrito as $cart)
        <dashboard-component url={{url('/')}} cart={{$cart->id}} total={{number_format(floatval($cart->total), 2)}}></dashboard-component>
        <div class="col">
          @foreach ($cart->detalle as $item)
            <product-component url={{url('/')}} cantidad={{$item->cantidad}} producto={{$item->articulo_id}} modelo={{$item->modelo}}></product-component>          
          @endforeach
        </div> 
      @endforeach           
    @endif
  </div>    
</div>

