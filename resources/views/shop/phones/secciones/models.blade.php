<section class="pt-5 pb-5">
    <div class="container">
        <div class="section-intro pb-60px"><h2 class="animate__animated animate__pulse animate__repeat-3">AVAILABLE <span class="section-intro__style">Models</span></h2></div>
        <div class="row">
            @foreach ($category->models as $product)
    
            <div class="col-sm-3 animate__backInLeft">
                <img style="min-height: 250px; min-width:250px;" class="card-img" src="{{asset('storage')}}/{{$product->thumb}}">
                <div class="text-center">
                    <a href="{{route('modelShop' , ['id' => $product->id])}}" class="btn btn-light">{{$product->name}}</a>
                </div>
            </div>
                
            @endforeach
        </div>
    </div>
  </section>