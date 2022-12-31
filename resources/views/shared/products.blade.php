<section class="mt-3 mb-5">
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
                            <li class="filter-list"><label for="men"><a class="text-dark" href="{{route('categories.detail' , ['slug' => $item->slug])}}">{{$item->name}}</a><span> ({{count($item->products)}})</span></label></li>
                        @endforeach
                    </ul>                   
                </form>
              </li>
            </ul>
          </div>
          <hr>
          
          <div class="sidebar-categories">
            <div class="head roboto d-flex justify-content-between">
              {{ __('Browse Models') }}
            </div>

            <ul class="common-filter list-unstyled">
              @isset($media)
              <li class="main-categories media d-flex justify-items-between align-items-center">
                <img style="width: 30%;" class="mr-3" src="{{asset('storage')}}/{{$media}}" alt="Generic placeholder image">
                <div class="media-body">
                  <h6 class="mt-0 mb-1"><b>{{$textMedia}}</b></h6>
                </div>
              </li>
              @endisset
              <a id="more-details" class="text-dark pointer mt-2 mb-2" onclick="click_detail()">
                {{__('Show More')}} <i class="ti-angle-right"></i> 
              </a>
              <div id="contentModels" style="height: 0px; overflow:hidden;">
                <ul class="list-group">
                  @foreach ($categories as $category)
                    @foreach ($category->models as $item)
                      <li class="list-group-item">
                        <a class="text-dark" href="{{route('model.shop' , ['id' => $item->id])}}"><img style="width: 20%" class="img-thumbnail b-0" src="{{asset('storage')}}/{{$item->thumbnail}}" alt=""> {{$item->name}}</a>  
                      </li>                
                    @endforeach    
                  @endforeach
                </ul>
              </div>
            </ul>
          </div>
         
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
          <!-- Start Filter Bar -->
          @isset($search)
          <div class="filter-bar d-flex flex-wrap align-items-center">
            <div class="input-group filter-bar-search">
                <p class="pt-3">
                  <small>{{__('Search results')}}: <b>{{count($products)}}</b> {{__('for')}} <b>{{$search}}</b> </small>
                </p>      
            </div>
          </div>
          @endisset
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

            @isset($search)
              {{ $products->links('shared.pagination', ['search' => $search])}}
            @else
              {{ $products->links('shared.pagination')}}
            @endisset            

          </section>
          <!-- End Best Seller -->
        </div>
      </div>
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
