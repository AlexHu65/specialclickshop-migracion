<style>
    .order_box{
        width: 100% !important;
    }
</style>
<section class="checkout_area section-margin--small">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Billing Details</h3>
                    <form class="row contact_form" action="{{route('checkoutSession')}}" method="post">
                        @csrf  
                        <div class="order_box">
                            <h2>Your Order</h2>
                            
                            <ul class="list">
                                <li><a href="#"><h4>Product <span>Total</span></h4></a></li>
                                @foreach ($detalle as $item)
                                    @php
                                        $price = ($item['product']->offer > 0 ? $item['product']->offer  :  $item['product']->price);
                                    @endphp
                                    <li>x({{$item['cantidad']}})<a href="#">{{$item['product']->name}} <span class="middle"></span> <span class="last">${{number_format(floatval($price),2)}}</span></a></li>
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Total <span>${{number_format(floatval($carrito->total),2)}}</span></a></li>
                            </ul>
                            
                            <div class="creat_account">
                                <input type="checkbox" id="f-option4" id="selector" name="selector">
                                <label for="f-option4">I’ve read and accept the </label>
                                <a target="_blank" href="{{route('privacy.detail')}}">terms & conditions*</a>
                                
                            </div>
                        </div>                      
                        <div class="col p-2 m-3">
                        </div>
                        <input type="hidden" name="detalle" value="{{json_encode($detalle)}}">
                        <input type="hidden" name="carrito" value="{{$carrito->id}}">
                        <input type="hidden" name="total" value="{number_format(floatval($carrito->total),2)}">
                        <button class="button button-paypal" type="submit">Proceed to Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </section>