<section class="pb-4">
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <gallery-component url="{{url('/')}}" product="{{$product->id}}"></gallery-component>
                </div>
                <div class="col-sm-5 offset-lg-1 card shadow-sm p-3 mb-5 bg-body rounded">
                    <div class="row card-body">
                        @if ($product->offer > 0)
                              <div class="d-none d-sm-none d-md-block d-lg-bloc ribbon">
                                <span>{{__('Offer')}}</span>
                              </div>
                            @endif
                        <div class="col-sm-12 s_product_text">
                            <h3>{{( App::getLocale() == 'en' ? $product->name : $product->name_esp)}}</h3>
                            <div class="addthis_inline_share_toolbox pt-3 pb-3"></div>
                            <a class="active" href="{{route('categories.detail', ['slug' => $product->category->slug])}}">
                                <strong>{{$product->category->name}}</strong>
                            </a>
                            @if ($product->offer > 0)
                                <h2 class="{{($product->offer > 0 ? 'text-success' : '')}}">${{number_format(floatval($product->offer),2)}}</h2>
                                <h4 class="{{($product->offer > 0 ? 'text-danger tachado' : '')}}">${{number_format(floatval($product->price),2)}}</h4>
                            @endif
                            @if($product->offer == 0)
                                <h2 class="{{($product->offer > 0 ? '' : '')}}">${{number_format(floatval($product->price),2)}}</h2>
                            @endif
                            @php
                                $newKeyword =  explode(',',$product->keywords);
                            @endphp
                            @if ($newKeyword)
                                @foreach ($newKeyword as $keyword)
                                    <span class="badge badge-secondary m-1">
                                        <small>
                                            {{$keyword}}
                                        </small>
                                    </span>
                                @endforeach
                            @endif
                            <hr>
                        </div>
                        <cart-component
                            locale="{{Config::get('app.locale')}}"
                            url="{{url('/')}}"
                            colorprimario="{{$product->colorPrincipal}}"
                            colorsecundario="{{$product->colorSecundario}}"
                            product="{{$product->id}}">
                        </cart-component>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
