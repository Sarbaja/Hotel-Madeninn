@extends('layouts.frontApp');

@section('title', 'Hotel Maden Inn | Features')

@section('content')

    <div>
        <!-- Page Title Section -->
        <section class="main-slider pt0 pb0">
            <!-- <div class="item youtube">
                <iframe class="embed-player slide-media" width="980" height="520" src="https://www.youtube.com/embed/QV5EXOFcdrQ?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&loop=1&playlist=QV5EXOFcdrQ&start=1" frameborder="0" allowfullscreen></iframe>
            </div> -->
            <div class="item image">
                <figure>
                    <div class="slide-image slide-media" style="background-image:url('{{ asset('images/slider/s1.jpg') }}');">
                        <img data-lazy="{{ asset('images/slider/s1.jpg') }}" class="image-entity" />
                    </div>
                </figure>
            </div>
            <div class="item image">
                <figure>
                    <div class="slide-image slide-media" style="background-image:url('{{ asset('images/slider/s2.jpg') }}');">
                        <img data-lazy="{{ asset('images/slider/s2.jpg') }}" class="image-entity" />
                    </div>
                </figure>
            </div>

            <div class="item image">
                <figure>
                    <div class="slide-image slide-media" style="background-image:url('{{ asset('images/slider/s3.jpg') }}');">
                        <img data-lazy="{{ asset('images/slider/s3.jpg') }}" class="image-entity" />
                    </div>
                </figure>
            </div>
            <div class="item image">
                <figure>
                    <div class="slide-image slide-media" style="background-image:url('{{ asset('images/slider/s4.jpg') }}');">
                        <img data-lazy="{{ asset('images/slider/s4.jpg') }}" class="image-entity" />
                    </div>
                </figure>
            </div>
            <div class="item image">
                <figure>
                    <div class="slide-image slide-media" style="background-image:url('{{ asset('images/slider/s5.jpg') }}');">
                        <img data-lazy="{{ asset('images/slider/s5.jpg') }}" class="image-entity" />
                    </div>
                </figure>
            </div>

            <div class="item image">
                <figure>
                    <div class="slide-image slide-media" style="background-image:url('{{ asset('images/slider/s6.jpg') }}');">
                        <img data-lazy="{{ asset('images/slider/s6.jpg') }}" class="image-entity" />
                    </div>
                </figure>
            </div>
            <!-- <div class="item video">
                <video class="slide-video slide-media" loop muted preload="metadata" poster="https://drive.google.com/uc?export=view&id=0B_koKn2rKOkLSXZCakVGZWhOV00">
                    <source src="https://player.vimeo.com/external/138504815.sd.mp4?s=8a71ff38f08ec81efe50d35915afd426765a7526&profile_id=112" type="video/mp4" />
                </video>
            </div> -->
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
                                <input data-toggle="date-pick" class="form-control" name="checkInDate"
                                       id="inlineFormInputName2" placeholder="Check In Date">
                            </div>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="far fa-calendar-minus"></i></div>
                                </div>
                                <input data-toggle="date-pick" class="form-control" name="checkOutDate"
                                       id="inlineFormInputName2" placeholder="Check Out Date">
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

    <!-- Welcome Section -->
	<section class="bg-second">
		<div class="container">
			<div class="contents">
				<h1 class="uppercase text-center font-weight-bold wow fadeInUp" data-wow-duration="1.2s">Amenities</h1>
				<h6 class="text-center mt32 mt-xs-16 wow fadeInUp" data-wow-duration="1.2s">
					At Maden Inn, we are all about creating a personal experience for our guests; we love to go the extra mile! Just like our guest rooms, our common spaces are peaceful, intimate, and feature thoughtfully chosen top-quality amenities, just for you. When it comes to searching for hotels with free parking, flexible meeting space, and hotels with free breakfast - the Maden Inn has it covered.
				</h6>
				<h6 class="text-center mt32 mt-xs-16 wow fadeInUp" data-wow-duration="1.2s">
					Book your room online using our quick, easy and secure online reservation system, or give us a call anytime for personal assistance. We’ll see you soon at Maden Inn!
				</h6>
			</div>
		</div>
	</section>

    <!-- Breaker Section -->
	<section class="bg-image fullscreen dark-bg fixed-bg breaker" style="background-image: url('./images/b3.jpg')">
	</section>
	<!-- Breaker Section -->
	<!-- Breakfaset Section -->
	<section class="fullscreen">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						@foreach($breakfastImages as $i=>$image)
						<div class="col-6 mb32">
							<img src="{{asset('uploads/breakfastImages/thumbs/thumb_' . $image->image_name)}}" alt="" class="img-fluid d-block ml-auto mr-auto wow fadeIn" data-wow-duration="0.8s" @if($i!=0) data-wow-delay="{{$i*0.2}}s" @endif>
						</div>
						@endforeach
					</div>
				</div>
				<div class="col-md-6 pt64 sm-hd">
					<h3 class="text-center font-weight-bold sm-hd wow fadeInRight" data-wow-duration="1.2s">{{$breakfast->title}}</h3>
					<div class="text-center wow fadeInRight" data-wow-duration="1.2s">
						{!! substr($breakfast->description, 0, 520) !!}
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
	<section class="bg-image fullscreen dark-bg fixed-bg breaker" style="background-image: url('./images/r2.jpg')">
	</section>
	<!-- Breaker Section -->

	<!-- Room Section -->
	<section class="fullscreen">
		<div class="container">
			<div class="row">
				<div class="col-md-6 order-md-2">
					<div class="row">
						@foreach($roomImages as $i=>$rImg)
							<div class="col-6 mb32">
								<img src="{{asset('uploads/roomImages/thumbs/thumb_' . $rImg->image_name)}}" alt="" class="img-fluid d-block ml-auto mr-auto wow fadeIn" data-wow-duration="0.8s" @if($i!=0) data-wow-delay="{{$i*0.2}}s" @endif>
							</div>
						@endforeach
					</div>
				</div>
				<div class="col-md-6 pt64 sm-hd order-md-1">
					<h3 class="text-center font-weight-bold sm-hd wow fadeInLeft" data-wow-duration="1.2s">Madden Inn <span>Rooms</span></h3>
					<p class="text-center wow fadeInLeft" data-wow-duration="1.2s">
						We make each guest feel at home, with welcoming rooms offering all the small comforts that really count. Relax and escape in cotton bathrobes, high-quality bed linens, soothing piano music for the in-room CD player, gorgeous complimentary bath and body products from Duck Island, free high-speed Wi-Fi, and more.
					</p>
					<div class="text-center wow fadeInLeft" data-wow-duration="0.9s">
						<a href="{{url('rooms')}}" class="btn">Read More</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Room Section -->
	<!-- Breaker Section -->
	<section class="bg-image fullscreen dark-bg fixed-bg breaker" style="background-image: url('./images/bicycles.jpg')">
	</section>
	<!-- Breaker Section -->

	<!-- Other Attractions -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-4 wow fadeInLeft">
					<img src="images/bike.jpg" alt="" class="img-fluid">
				</div>
				<div class="col-md-8 pt32 wow fadeinRight">
					<h4 class="text-center sm-hd"><span>Cruiser Bikes</span> Rental</h4>
					<p class="text-center">There is no better way to explore the valley than on two wheels! Bringing your own bike isn’t always feasible, but not to worry - we have an amazing bike-lending program, so you can cruise town at no extra cost. Reserve your cruiser at the front desk and happy cycling!</p>
				</div>
			</div>
		</div>
	</section>
	<section class="bg-second">
		<div class="container">
			<div class="row">
				<div class="col-md-4 order-md-2 wow fadeInRight">
					<img src="images/meet.jpg" alt="" class="img-fluid">
				</div>
				<div class="col-md-8 order-md-1 pt32 wow fadeInLeft">
					<h4 class="text-center sm-hd"><span>Meeting & Retreat</span> Space</h4>
					<p class="text-center">Maden Inn is the ideal meeting place for all kinds of social and professional gatherings, with options for onsite catering (small snacks and a hearty breakfast) as well as equipment rental. When not in use for meetings or booked programs, our gathering space is a beautiful spot for a quiet personal yoga session or peaceful stretch.</p>
				</div>
			</div>
		</div>
	</section>
	<!-- Other Attractions -->

	<!-- Breaker Section -->
	<section class="bg-image fullscreen dark-bg fixed-bg breaker" style="background-image: url('./images/bath.jpeg')">
	</section>
	<!-- Breaker Section -->

	<!-- Other Attractions -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-4 wow fadeInLeft">
					<img src="images/shampoo.jpg" alt="" class="img-fluid">
				</div>
				<div class="col-md-8 pt32 wow fadeInRight">
					<h4 class="text-center sm-hd"><span>Bath and Beauty</span> Products</h4>
					<p class="text-center">Our guests can purchase a range of deluxe brands items right here at the inn. This socially responsible company aligns with our own principles and standards, offering high-quality, environmentally-friendly bath and body products to enjoy during your stay or back at home.</p>
				</div>
			</div>
		</div>
	</section>
	<section class="bg-second">
		<div class="container">
			<div class="row">
				<div class="col-md-4 order-md-2 wow fadeInRight">
					<img src="images/meet.jpg" alt="" class="img-fluid">
				</div>
				<div class="col-md-8 order-md-1 pt32 wow fadeinLeft">
					<h4 class="text-center sm-hd"><span>Parking, WI-FI</span> & MORE</h4>
					<p class="text-center">Our attention to detail means your Maden Inn experience will be memorable. From our amazing Maden Cookies, welcoming you upon arrival to our tea service area, available at any time to free parking, complimentary high-speed Wi-Fi and free DVDs available at the front desk, our friendly staff is here to make sure you have everything you need for a relaxing getaway.</p>
				</div>
			</div>
		</div>
	</section>
	<!-- Other Attractions -->

	<!-- Breaker Section -->
	<section class="bg-image fullscreen dark-bg fixed-bg" style="background-image: url('./images/2.jpg')">
	</section>
	<!-- Breaker Section -->

@endsection
