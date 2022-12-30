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
		<div id="menu">
			@include('partials.menu')
		</div>
	</header>
	<!--Aqui vamos a poner los compoenentes de vue-->
		<div id="app">
			@yield('content')
		</div>
	<footer class="footer">
			@include('partials.footer')
	</footer>
	@include('partials.scripts')
</body>
</html>