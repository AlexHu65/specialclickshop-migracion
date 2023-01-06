<section class="mt-3 mb-5">
    <div class="container">
		<h2 class="pb-4">{{__('Related products')}} ({{count($products)}})</h2>
          <section class="lattest-product-area pb-40 category-list mt-4">
			<div class="row">
                @foreach ($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="card text-center card-product">
                      <div class="card-product__img">       
                        @if ($product->offer > 0)
                          <div class="d-none d-sm-none d-md-block d-lg-bloc ribbon">
                            <span>{{__('Offer')}}</span>
                          </div>
                        @endif     
                        <div style="min-width: 250px; height:250px; background-image: url({{Voyager::image($product->thumbnail('medium', 'thumb'))}});background-size: contain;background-position: center center;background-repeat: no-repeat;border-radius:10px;">
                        </div>  
                        <ul class="card-product__imgOverlay">
                          <li><button><a href="{{route('product.detail' ,['slug' => $product->slug])}}"><i class="ti-search"></i></a></button></li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <h4 class="card-product__title">
                          <small>
                            <a href="{{route('product.detail' ,['slug' => $product->slug])}}">{{( App::getLocale() == 'en' ? $product->name : $product->name_esp)}}</a>
                          </small>
                        </h4>
                            
                        @if ($product->offer > 0)
                          <p class="card-product__price {{($product->offer > 0 ? 'text-success' : '')}}">${{number_format(floatval($product->offer),2)}}</p>
                        @endif
                          <p class="card-product__price {{($product->offer > 0 ? 'tachado text-danger' : '')}}">${{number_format(floatval($product->price),2)}}</p>
                      </div>
                    </div>
                  </div>
                    
                @endforeach
            </div>         

          </section>
          <!-- End Best Seller -->
        </div>
    <script>
      function click_detail(){
    
        const elem = document.getElementById('contentModels');

        if(elem.style.height == 'auto'){
    
          elem.style.height = '0px';

        }else{
          elem.style.height = 'auto';
        }
      }

    </script>
  </section>
