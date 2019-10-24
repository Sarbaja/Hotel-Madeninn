@extends('layouts.app')

@section('content')
    <section id="page-title" class="top-space">
        <div class="container clearfix">
            <h1>Profile | {{ Auth::user()->name }}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </div>
    </section>
<div class="container">
    <div class="row justify-content-center" style="padding-top: 20px;">

        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                {{--<div class="card-header">Dashboard</div>--}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="alert alert-success text-center" role="alert">
                            hello, {{ Auth::user()->name }} <br>
                    You are logged in!
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
