@extends('layouts.app')

@section('content')
    <section id="page-title" class="top-space">
        <div class="container clearfix">
            <h1>Sign Up For Wholesale Deals</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Register</li>
            </ol>
        </div>
    </section>
    <section class="contacts">
        <div class="container">
            <div class="row pad-here">
                <div class="col-md-8 col-md-offset-3">
                    <div class="postcontent nobottommargin">
                        <h3 class="text-center">Sign Up with Us</h3>
                        <div class="contact-form-result">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div data-notify="container"
                                         class="col-11 col-md-4 alert alert-danger  alert-with-icon animated fadeInDown"
                                         role="alert" data-notify-position="bottom-right"
                                         style="display: inline-block; margin: 15px auto;  position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; bottom: 20px; right: 20px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                        <i class="fas fa-bell"></i><span
                                            data-notify="title"></span> <span data-notify="message">
            Sorry !!! <br> {{ $error }}
        </span><a href="#" target="_blank" data-notify="url"></a>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <form method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="col_full">
                                <label for="email">Email
                                    <small>*</small>
                                </label>
                                <input type="text" name="email" value="{{ old('email') }}"
                                       class="sm-form-control required" aria-required="true" required>
                            </div>

                            <div class="col_full">
                                <label for="template-contactform-subject">Password
                                    <small>*</small>
                                </label>
                                <input type="password" name="password" class="required sm-form-control"
                                       aria-required="true" required>
                            </div>
                            <div class="clear"></div>
                            <div class="col_half">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col_half col_last">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="clear"></div>
                            <div class="col_full text-center">
                                <button class="button button-3d nomargin" type="submit">Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
