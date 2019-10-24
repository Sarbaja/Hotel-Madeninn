@extends('layouts.app')

@section('title', 'Hotel Maden Inn | Booking')

@section('content')

    <section>
        <div class="container">

            <div class="floater-book non-floater mt120">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                         
                            @if(Session::has('message_error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>	
                                        <strong>{!! session('message_error') !!}</strong>
                                </div>
                            @endif
                            @if(Session::has('message_success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>	
                                        <strong>{!! session('message_success') !!}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>

                    <div class="row">                        
                            <div class="col-md-12 text-center">
                                    <h3>Thank you for your booking.</h3>
                                    <h4><a href="{{url('/')}}">Return to home page!!!</a></h4>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection