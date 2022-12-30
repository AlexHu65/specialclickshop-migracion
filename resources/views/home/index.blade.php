@extends('master')
@section('title', $app . ' | ' . $title)
@section('content')	

@include('home.secciones.banners')
@include('home.secciones.main')
@include('home.secciones.products')
@include('home.secciones.bannermain')
@include('home.secciones.special')

@endsection