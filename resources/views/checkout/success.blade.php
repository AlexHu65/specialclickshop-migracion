@extends('master')
@section('title', $title)
@section('content')

    <div class="container pb-5 pt-5">
        <div class="row">
            <div class="col">
                <h1>Thanks for your order!</h1>
                <p>
                    We appreciate your business!
                    If you have any questions, please email
                    <a href="mailto:{{setting('site.email')}}">{{setting('site.email')}}</a>.
                </p>
            </div>
        </div>
    </div>  
    <script>
         localStorage.removeItem('cart');
    </script>


@endsection