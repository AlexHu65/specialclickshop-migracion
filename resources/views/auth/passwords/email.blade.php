@extends('master')
@section('content')
<section class="login_box_area section-margin pb-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>{{ __('Reset Password') }}</h3>
                        <div class="col">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        </div>
                    
                    <form class="row login_form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email') }}">
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="button button-login w-100">{{ __('Send Password Reset Link') }}</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
</section>
@endsection
