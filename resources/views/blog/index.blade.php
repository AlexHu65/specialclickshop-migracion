@extends('master')
@section('title', $app . ' | ' . $title)
@section('content')
@include('blog.secciones.entries')
@endsection
