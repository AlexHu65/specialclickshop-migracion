<nav class="navbar navbar-dark bg-dark p-2">
	<div class="container-fluid d-flex justify-content-around">
		<div>
			
		</div>
		<div class="text-light text-center animate__animated animate__heartBeat animate__infinite">
			<i class="ti-shopping-cart"></i>
			{{__('Free shipping from $45.00!')}}
		</div>
		<div class="text-center d-flex justify-content-center align-items-center">
				
			@auth
				<a class="m-2 text-light" href="{{url('dashboard')}}"><i class="ti-user"></i></a>
				<a class="m-2 text-light" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ti-close"></i></a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			@endauth
			@guest
				<a class="m-2 text-light" href="{{route('login')}}"><i class="ti-user"></i></a>
				@endguest
				<a class="m-2 text-light" href="{{route('carrito.detail')}}"><i class="ti-shopping-cart"></i></a>
				@foreach (Config::get('languages') as $lang => $language)
				@if ($lang != App::getLocale())
				<a href="{{ route('lang.switch', $lang) }}">
					<img src="{{asset('img')}}/{{$language['flag']}}" style="width: 50%;">
				</a>
				@endif
			@endforeach	
		</div>	
	</div>
</nav>


<menu-component locale="{{Config::get('app.locale')}}" url="{{url('/')}}" class="d-xs-block d-sm-block d-md-block d-lg-none d-xl-none"></menu-component>

<div class="main_menu d-none d-xs-none d-sm-none d-md-block">
	<nav class="navbar navbar-expand-lg navbar-light pt-3 pb-3 d-xs-none d-sm-none d-md-block">
		<div class="container">	
			<div class="logo justify-content-center align-items-center">
				<a class="navbar-brand logo_h m-0 p-0" href="/home"><img src="{{asset('img/logo.png')}}" style="width: 100%;"></a>
			</div>       
			<div class="d-none d-sm-none d-md-none navbar-collapse offset d-flex align-content-center justify-content-between" id="navbarSupportedContent">
				<ul class="nav navbar-nav menu_nav">
					<li class="nav-item "><a class="nav-link font-weight-bold" href="{{route('shop')}}">{{ __('SHOP') }}</a></li>
					<li class="nav-item submenu dropdown">
						<a href="{{route('categories.detail')}}" class="nav-link font-weight-bold dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
						aria-expanded="false">{{ __('CATEGORIES') }}</a>
						<ul class="dropdown-menu">
							@foreach ($categories ?? '' as $category)
							<li class="nav-item"><a class="nav-link" href="{{route('categories.detail' , ['slug' => $category->slug])}}">{{$category->name}}</a></li>
							@endforeach
							<li class="nav-item"><a class="nav-link" href="{{route('shop')}}">{{ __('VIEW ALL') }}</a></li>
						</ul>
					</li>
					<li class="nav-item "><a class="nav-link font-weight-bold" href="{{route('blog')}}">BLOG</a></li>            
					<li class="nav-item "><a class="nav-link font-weight-bold" href="{{route('special.offers')}}">{{__('OFFERS')}} </a></li>            
				</ul>
				<div class="text-center">
					<form class="d-flex aling-items-center justify-content-around" action="{{route('search.index')}}" method="GET">
						<input name="search" style="border-radius: 30px;border-color: #EEEEEE;font-size: 14px;" class="form-control m-3" type="search" placeholder="{{ __('Search') }}" aria-label="Search">
						<button id="searchButton" class="b-0" type="submit"><i class="ti-search"></i></button>
					</form>
				</div>
			</div>
			
		</div>
	</div>
	</nav>
</div>
