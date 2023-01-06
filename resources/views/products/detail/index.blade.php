@extends('master')
@section('title', $app . ' | ' . $title)
@section('content')

@include('products.detail.secciones.product')
@include('products.detail.secciones.descriptions')

@endsection