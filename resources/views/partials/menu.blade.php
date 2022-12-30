<nav class="navbar navbar-dark bg-dark p-2">
	<div class="container-fluid d-flex justify-content-center">
	  <div class="row">
		<div class="col animate__animated animate__heartBeat animate__infinite">
			<div class="text-light">
			  <i class="ti-shopping-cart"></i>
			  {{__('Free shipping from $45.00!')}}
			</div>
		</div>
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
			<div class="d-none d-sm-none d-md-none navbar-collapse offset" id="navbarSupportedContent">
				<ul class="nav navbar-nav menu_nav ml-auto mr-auto">
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
				<ul class="nav-shop">
					<li class="nav-item">
						<button>
							<form action="{{route('search.index')}}" method="POST" class="form-inline my-2 my-lg-0">
								@csrf
								<input name="search" style="border-radius: 30px;
								height: 30px;
								border-color: #EEEEEE;
								padding-left: 20px;
								font-size: 14px;" class="form-control mr-sm-2" type="search" placeholder="{{ __('Search') }}" aria-label="Search">
							<i class="ti-search"></i>
						</button>
					</li>
					</form>
					@auth
					<li class="nav-item"><a href="{{url('dashboard')}}"><i class="ti-user"></i></a></li>
					<li class="nav-item"><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ti-close"></i></a></li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
					@endauth
					@guest
					<li class="nav-item"><a href="{{route('login')}}"><i class="ti-user"></i></a></li>
					@endguest
					<li class="nav-item"><a href="{{route('carrito.detail')}}"><i class="ti-shopping-cart"></i></a></li>
					<li class="nav-item">
					@foreach (Config::get('languages') as $lang => $language)
						@if ($lang != App::getLocale())
						<a href="{{ route('lang.switch', $lang) }}">
							<img src="{{asset('img')}}/{{$language['flag']}}" style="width: 65%;">
						</a>
						@endif
					@endforeach
					</li>
				</ul>
			</div>
		</div>
	  </nav>
  </div>
