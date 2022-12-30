<section class="section-margin--small mb-5">
    <div class="container">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
          <div class="sidebar-categories">
            <div class="head roboto">{{ __('Browse Categories') }}</div>
            <ul class="main-categories">
              <li class="common-filter">
                <form action="#">
                    <ul>
                        @foreach ($categories as $item)
                            <li class="filter-list"><label for="men"><a href="{{route('categories.detail' , ['slug' => $item->slug])}}">{{$item->name}}</a><span> ({{count($item->products)}})</span></label></li>
                        @endforeach
                    </ul>
                </form>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
          <!-- Start Filter Bar -->
          <div class="filter-bar d-flex flex-wrap align-items-center">
            <div>
              <div class="input-group filter-bar-search">
                <form action="/search" method="POST">
                  @csrf
                  <input type="text" id="search" name="search" placeholder="{{ __('Search') }}">
                  <button class="btn btn-default" type="button"><i class="ti-search"></i></button>
                </form>                
              </div>
            </div>
          </div>
          <!-- Start Best Seller -->
          <section class="lattest-product-area pb-40 category-list">
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
                        <h4 class="card-product__title"><a href="{{route('product.detail' ,['slug' => $product->slug])}}">{{$product->name}}</a></h4>
                            @php
                                $newKeyword =  explode(',',$product->keywords);
                            @endphp                            
                            @foreach ($newKeyword as $keyword)
                                <span class="badge badge badge-info m-1">{{$keyword}}</span>                                
                            @endforeach 
                        @if ($product->offer > 0)
                          <p class="card-product__price {{($product->offer > 0 ? 'text-success' : '')}}">${{number_format(floatval($product->offer),2)}}</p>
                        @endif
                        <p class="card-product__price {{($product->offer > 0 ? 'tachado text-danger' : '')}}">${{number_format(floatval($product->price),2)}}</p>
                      </div>
                    </div>
                  </div>
              @endforeach
            </div>
            {{ $products->links('pagination::bootstrap-5') }}
          </section>
        </div>
      </div>
    </div>
  </section>
