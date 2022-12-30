<section id="mainBanner" class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- iphone cases -->
                <div data-aos="fade-up" class="text-center ">
                    <a href="{{route('categoriesModels.detail' , ['slug' => 'iphone-cases'])}}">
                        <img src="{{asset('images/iphone.png')}}" alt="iPhone Cases">
                    </a>
                </div>
                <div class="text-center buttons">
                    <a href="{{route('categoriesModels.detail' , ['slug' => 'iphone-cases'])}}" class="btn-hover color-10">{{ __('iPhone Cases') }}</a>
                </div>
            </div>
            <div class="col">
                <!-- samsung cases -->
                <div class="text-center">
                    <a href="{{route('categoriesModels.detail' , ['slug' => 'samsung-galaxy-cases'])}}">
                        <img src="{{asset('images/samsung.png')}}" alt="Samsung Cases">
                    </a>
                </div>
                <div class="text-center buttons">
                    <a href="{{route('categoriesModels.detail' , ['slug' => 'samsung-galaxy-cases'])}}" class="btn-hover color-3">{{ __('Samsung Cases') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section  class="pt-2 banner2-section" style="background: url({{asset('img/banners/banner2.jpg')}})">

</section>