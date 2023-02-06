@extends('master')
@section('title', $title)
@section('content')

<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                {!! $privacy !!}
            </div>
        </div>
    </div>
</section>


@endsection
