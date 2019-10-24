@extends('layouts.app')

@section('title', 'Hotel Maden Inn Home Page')

@section('content')

    <!-- Slider Section -->
    {{--<section class="fullscreen pt0 pb0 slider">--}}
    <div>

        <section class="fullscreen main-slider margin-slider pt0 pb0 slider">
            @if(!$setting->youtubevideourl == '')
                <div class="item youtube">
                    <iframe class="embed-player slide-media" width="980" height="520"
                            src="https://www.youtube.com/embed/{{ $setting->youtubevideourl }}?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&loop=1&playlist=QV5EXOFcdrQ&start=1"
                            frameborder="0" allowfullscreen></iframe>
                </div>
            @endif
            @foreach($otherSlides as $row)
                <div class="item image">
                    <figure>
                        <div class="slide-image slide-media"
                             style="background-image:url('{{asset('storage/slider/thumbs/slide_' . $row->image)}}');">
                            <img data-lazy="{{asset('storage/slider/thumbs/slide_' . $row->image)}}"/> <!--If this is removed then the slider will not appear in mobile view -->
                        </div>
                    </figure>
                </div>
            @endforeach

        </section>
        
        
        <div class="floater-book">
            <div class="container-fluid">
                    <div class="row">
                            <div class="col-md-12">
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
                    </div>
                <div class="row">
                    <div class="col-sm-2">
                        <h5>Book A Room</h5>
                    </div>
                    <div class="col-sm-10">
                        <form action="{{url('/book')}}" method="post" class="form-inline">
                            @csrf
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="far fa-calendar-plus"></i></div>
                                </div>
                                <input  onchange="setStartDate(this.value)" class="form-control" name="checkInDate"
                                       id="startDate" placeholder="Check In Date" required="">
                            </div>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="far fa-calendar-minus"></i></div>
                                </div>
                                <input  class="form-control" name="checkOutDate"
                                       id="endDate" placeholder="Check Out Date" required="">
                            </div>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-users"></i></div>
                                </div>
                                <select class="form-control" name="adults" required="">
                                    <option value="0" >Adults</option>
                                    @for($i=1; $i<5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-users"></i></div>
                                </div>
                                <select class="form-control" name="children" required="">
                                    <option value="0">Children</option>
                                    @for($i=1; $i<5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="submit" class="btn btn-filled mb0" value="Book">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Section -->

    <!-- Welcome Section -->
    <section class="bg-second">
        <div class="container">
            <div class="contents">
                <h1 class="uppercase text-center font-weight-bold wow fadeInUp" style="text-transform:capitalize;" data-wow-duration="1.2s">Welcome To
                    Hotel Maden Inn </h1>
                <h6 class="text-center mt32 mt-xs-16 wow fadeInUp" data-wow-duration="1.2s">
                   {{ $setting->sitekeyword }}
                </h6>
            </div>
        </div>
    </section>
    <!-- Welcome Section -->
    <!-- Breaker Section -->
    <!--<section class="main-slider pt0 pb0">
        @foreach( $DiningGallery as $Dgallery)
        <div class="item image">
            <figure>
                <div class="slide-image slide-media" style="background-image:url('{{asset('uploads/gallery/' . $Dgallery->image_name)}}');">
                    <img alt="hotels in ithari" data-lazy="{{asset('uploads/gallery/' . $Dgallery->image_name)}}" class="image-entity" />
                </div>
            </figure>
        </div>
        @endforeach
    </section>-->
    <!-- Breaker Section -->
    <!-- Breakfaset Section -->
    <section class="fullscreen">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        @foreach($breakfastImages as $i=>$image)
                            <div class="col-6 mb32">
                                <img src="{{asset('uploads/breakfastImages/thumbs/thumb_' . $image->image_name)}}"
                                     alt="" class="img-fluid d-block ml-auto mr-auto wow fadeIn"
                                     data-wow-duration="0.8s" @if($i!=0) data-wow-delay="{{$i*0.2}}s" @endif>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 pt64 sm-hd">
                    @php
                $dining = DB::table('pages')
                           ->where([
                               ['status', '=', '1'],
                               ['id', '=', '7']
                           ])->first();
            @endphp
                    <h3 class="text-center font-weight-bold sm-hd wow fadeInRight"
                        data-wow-duration="1.2s">{{ $dining->title }}</h3>
                    <div class="text-center wow fadeInRight" data-wow-duration="1.2s">
                        
            {!! $dining->subtitle !!}<br>{!! $dining->description !!}
                        </div>
                    <div class="text-center wow fadeInRight" data-wow-duration="1s">
                        <a href="{{url('breakfast')}}" class="btn">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breakfast Section -->

    <!-- Breaker Section -->
    <!--<section class="main-slider pt0 pb0">
        @foreach($RoomGallery as $Rgallery)
        <div class="item image">
            <figure>
                <div class="slide-image slide-media" style="background-image:url('{{asset('uploads/gallery/' . $Rgallery->image_name)}}');">
                    <img data-lazy="{{asset('uploads/gallery/' . $Rgallery->image_name)}}" class="image-entity" />
                </div>
            </figure>
        </div>
        @endforeach
    </section>-->
    <!-- Breaker Section -->

    <!-- Room Section -->
    <section class="fullscreen">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <div class="row">
                        @foreach($roomImages as $i=>$rImg)
                            <div class="col-6 mb32">
                                <img src="{{asset('uploads/roomImages/thumbs/thumb_' . $rImg->image_name)}}" alt=""
                                     class="img-fluid d-block ml-auto mr-auto wow fadeIn" data-wow-duration="0.8s"
                                     @if($i!=0) data-wow-delay="{{$i*0.2}}s" @endif>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 pt64 sm-hd order-md-1">
                    <h3 class="text-center font-weight-bold sm-hd wow fadeInLeft" data-wow-duration="1.2s">Maden Inn
                        <span>Rooms</span></h3>
                    <p class="text-center wow fadeInLeft" data-wow-duration="1.2s">
                        @php
                            $rooms = DB::table('pages')
                                       ->where([
                                           ['status', '=', '1'],
                                           ['id', '=', '2']
                                       ])->first();
                        @endphp
                        {!! $rooms->subtitle !!}<br>{!! $rooms->description !!}
                    </p>

                </div>
            </div>
        </div>
    </section>
    <!-- Room Section -->
    <!-- Breaker Section -->
    <!--<section class="main-slider pt0 pb0">
        @foreach($CateringGallery as $Cgallery)
        <div class="item image">
            <figure>
                <div class="slide-image slide-media" style="background-image:url('{{asset('uploads/gallery/' . $Cgallery->image_name)}}');">
                    <img data-lazy="{{asset('uploads/gallery/' . $Cgallery->image_name)}}" class="image-entity" />
                </div>
            </figure>
        </div>
        @endforeach
    </section>-->
    <!-- Breaker Section -->

    <!-- Other Attractions -->

    <section class="bg-second">
        <div class="container">
            @php
                $meeting = DB::table('pages')
                           ->where([
                               ['status', '=', '1'],
                               ['id', '=', '3']
                           ])->first();
            @endphp
            <div class="row">
                <div class="col-md-4 order-md-2 wow fadeInRight">
                    <img src="{{ asset('storage/pages/'.$meeting->image ) }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-8 order-md-1 pt32 wow fadeInLeft">
                    <h4 class="text-center sm-hd"><span>WEDDING AND </span> CATERING</h4>
                    <p class="text-center">
                        {!! $meeting->subtitle !!}<br>{!! $meeting->description !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Other Attractions -->

    <!-- Breaker Section -->
    <!--<section class="main-slider pt0 pb0">
        @foreach($BarGallery as $Bgallery)
        <div class="item image">
            <figure>
                <div class="slide-image slide-media" style="background-image:url('{{ asset('uploads/gallery/' . $Bgallery->image_name)}}');">
                    <img data-lazy="{{asset('uploads/gallery/' . $Bgallery->image_name)}}" class="image-entity" />
                </div>
            </figure>
        </div>
        @endforeach
    </section>-->
    <!-- Breaker Section -->

    <!-- Other Attractions -->

    <section class="bg-second">
        <div class="container">
            @php
                $meeting = DB::table('pages')
                           ->where([
                               ['status', '=', '1'],
                               ['id', '=', '4']
                           ])->first();
            @endphp
            <div class="row">
                <div class="col-md-4 order-md-2 wow fadeInRight">
                    <img src="{{ asset('storage/pages/'.$meeting->image ) }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-8 order-md-1 pt32 wow fadeInLeft">
                    <h4 class="text-center sm-hd"><span>Maden Inn </span> Bar</h4>
                    <p class="text-center">
                        {!! $meeting->subtitle !!}<br>{!! $meeting->description !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Other Attractions -->

    <div class="container" style="margin-top:30px;margin-bottom:30px;">
        <h2 class="text-center" style="padding:20px;">Image Gallery</h2>
        <div class="row main-mas">

            @foreach($gallery as $row)
                <div class="col-sm-4 col-6 mb32 mas-gal wow fadeInUp" data-wow-duration="1.2s">
                    <a data-fancybox="gallery" href="{{asset('uploads/gallery/' . $row->image_name)}}"><img src="{{asset('uploads/gallery/thumbs/thumb_' . $row->image_name)}}" alt="" class="img-fluid"></a>
                </div>
            @endforeach
            
        </div>
        <div class="text-center btn btn-filled mb0"><a class="text-center" href="{{url('/gallery')}}">View More</a></div>
    </div>

    <!-- Breaker Section -->
    <section class="bg-image fullscreen dark-bg fixed-bg" style="background-image: url('{{ asset('images/slider/s2.jpg') }}')">
    </section>
    <!-- Breaker Section -->




@endsection
