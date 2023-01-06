<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta name="google-site-verification" content="{{setting('site.google-site-verification')}}" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="Description" content="{{(isset($resume) ? $resume: setting('site.description'))}}">
	<meta name="keywords" content="{{(isset($product) ? $product->keywords : setting('site.keywords'))}}">
	<meta name="geo.region" content="MX-GUA">
	<meta name="geo.placename" content="México">
	<meta name="DC.title" content="{{setting('site.title')}}">
	<meta property="og:image:alt" content="{{setting('site.title')}}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- facebook -->
	<meta property="og:url" content="https://specialclickshop.com/" />
	<meta property="og:type" content="products"/>
	<meta property="og:title" content="{{isset($product) ? $product->name : setting('site.title')}}" />
	<meta property="og:description" content="{{isset($product) ? $product->resume : setting('site.description')}}" />
	<meta property="og:image" content="{{isset($product) ? $product->thumbnail : asset('/storage/' . setting('site.logo'))}}"/>
	@include('partials.assets')
	<script src="https://kit.fontawesome.com/8a0ae86e3a.js" crossorigin="anonymous"></script>
	<title>@yield('title')</title>
</head>
<body>

	<header class="header_area">
		<div class="shadow-sm" id="menu">
			@include('partials.menu')
		</div>
		
	</header>
	<!--Aqui vamos a poner los compoenentes de vue-->
	<main>
		<div id="banner">
			@include('partials.banner')
		</div>
		<div id="app">
			@include('shared.banner')
			@include('shared.breadcrumb')
			@yield('content')
		</div>
	</main>
	<footer class="footer mb-4">
		<div class="container-fluid bottom-bar">
			<div class="d-flex justify-content-between align-items-center p-1">
				<div class="d-flex justify-content-start align-items-center button-top">
					<div class="p-1 m-1 rounded-circle bg-dark d-flex justify-content-center align-items-center footer-button">
						<a style="color: white;" target="_blank" href="{{setting('site.facebook')}}"><i class="fab fa-facebook-f"></i></a>
					</div>
					<div class="p-1 m-1 rounded-circle bg-dark d-flex justify-content-center align-items-center footer-button">
						<a style="color: white;" target="_blank" href="{{setting('site.instagram')}}"><i class="fab fa-instagram"></i></a>
					</div>
				</div>
				<div class="d-flex justify-content-start align-items-center  social-media">
					<div class="p-1 m-1 rounded-circle bg-dark d-flex justify-content-center align-items-center footer-button">
						<a class="scrolltop" href=""><i style="color: white;"  class="fas fa-angle-up"></i></a>
					</div>
				</div>
			</div>
		</div>
		@include('partials.footer')
	</footer>
	@include('partials.scripts')
</body>
</html>