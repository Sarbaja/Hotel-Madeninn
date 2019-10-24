
@extends('layouts.frontApp')

@section('title', 'Hotel Maden Inn | Contact')

@section('content')

    <div>

        <section class="fullscreen main-slider pt0 pb0 slider">
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
                            <img data-lazy="{{asset('storage/slider/thumbs/slide_' . $row->image)}}"/>
                        </div>
                    </figure>
                </div>
            @endforeach

        </section>
        <div class="floater-book">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2">
                        <h5>Book A Room</h5>
                    </div>
                    <div class="col-sm-10">
                        <form action="{{url('book')}}" method="post" class="form-inline">
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
                                <input  class="form-control" name="checkOutDate" id="endDate" placeholder="Check Out Date" required="">
                            </div>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-users"></i></div>
                                </div>
                                <select class="form-control" name="adults">
                                    <option value="0">Adults</option>
                                    @for($i=1; $i<5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-users"></i></div>
                                </div>
                                <select class="form-control" name="children">
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
				<h1 class="uppercase text-center font-weight-bold sm-hd wow fadeInUp" data-wow-duration="1.2s">Contact <span>Us</span></h1>
				<h6 class="text-center mt32 mt-xs-16 wow fadeInUp" data-wow-duration="1.2s">
					At Maden Inn, we are all about creating a personal experience for our guests; we love to go the extra mile! Just like our guest rooms, our common spaces are peaceful, intimate, and feature thoughtfully chosen top-quality amenities, just for you. When it comes to searching for hotels with free parking, flexible meeting space, and hotels with free breakfast - the Maden Inn has it covered.
				</h6>
				<h6 class="text-center mt32 mt-xs-16 wow fadeInUp" data-wow-duration="1.2s">
					Book your room online using our quick, easy and secure online reservation system, or give us a call anytime for personal assistance. We’ll see you soon at Maden Inn!
				</h6>
			</div>
		</div>
	</section>
	<!-- Welcome Section -->

	<section>
		<div class="container text-center">
			<h2 class="sm-hd werriweather uppercase">Hotel <span>Maden inn</span></h2>
			<ul class="c-ul">
				<li><a href="#"> <h4>{{$setting->address}}</h4></a></li>
				<!-- <li><a href="#"> <h4>Address Line 2</a></h4></li> -->
				<!-- <li><a href="#"> <h4>Nepal</a></h4></li> <br> -->
				<li><a href="#"> <h4><i class="fa fa-mobile-alt"></i> <strong>{{$setting->phone}}, {{$setting->mobile}}</strong></h4></a></li>
				<li><a href="#"> <h4><i class="fa fa-envelope"></i> <strong>{{$setting->siteemail}}</strong></h4></a></li>
			</ul>
		</div>
	</section>
	<section class=" bg-second pt0 pb0">
		<h2 class="merriweather uppercase mb32 font-weight-bold text-center">Directions</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14262.155947475045!2d87.2786824!3d26.6632393!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x57dc9aa4e4647bcf!2sHotel+Maden+Inn!5e0!3m2!1sen!2snp!4v1554457456760!5m2!1sen!2snp" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
	</section>
@endsection
