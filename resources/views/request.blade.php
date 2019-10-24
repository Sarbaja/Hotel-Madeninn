@extends('layouts.frontApp')

@section('title', 'Hotel Maden Inn | Request Information')

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
<section>
		<div class="container">
			<div class="contents">
				<h1 class="uppercase text-center font-weight-bold sm-hd wow fadeInUp" data-wow-duration="1.2s">Request for <span>Information</span></h1>
				<h6 class="text-center mt32 mt-xs-16 wow fadeInUp" data-wow-duration="1.2s">
					Thanks for your interest in holding your upcoming event or retreat at Maden Inn. You can find information about our event space, corporate discount offers, audio-visual equipment, catering services (light snacks and beverages), and more here.
				</h6>
				<h6 class="text-center mt32 mt-xs-16 wow fadeInUp" data-wow-duration="1.2s">
					If you’d like more information on our meeting spaces and services, please give us a call or fill out the RFP (Request for Proposal) form below and we will get back to you as soon as possible.
				</h6>
			</div>
		</div>
	</section>
	<!-- Welcome Section -->

	<section class="bg-second">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2 class="text-center uppercase merriweather">General Information</h2>
					<form action="{{url('generalInfoReq')}}" method="post" class="frm">
						@csrf
						<div class="form-row">
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="name" required placeholder="Full Name">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="companyName" required placeholder="Company Name">
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<input type="email" class="form-control mb16" name="email" required placeholder="Email">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="contact" required placeholder="Contact Number">
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="address" required placeholder="Address">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="city" required placeholder="City">
							</div>
						</div>
						<div class="form-row">
							<textarea id="" cols="" rows="4" class="form-control" name="message" required placeholder="Message"></textarea>
						</div>
						<div class="text-center">
							<input type="submit" class="btn mt16 mb16 btn-filled" name="submit" value="Submit">
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<h2 class="text-center uppercase merriweather">Meeting Room Request</h2>
					<form action="{{url('meetingRoomReq')}}"  method="post" class="frm">
						@csrf
						<div class="form-row">
							<div class="col-md-6">
								<select name="event" id="event" class="form-control mb16" required>
									<option value="1" disabled="disabled" selected="selected">Select Type of Event</option>
									<option value="Retreat">Retreat</option>
									<option value="Conference">Conference</option>
									<option value="Meeting">Meeting</option>
									<option value="Seminar">Seminar</option>
								</select>
							</div>
							<div class="col-md-6">
								<input data-toggle="date-pick" class="form-control mb16" name="startDate" required placeholder="Event Start Date">
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<input data-toggle="date-pick" class="form-control mb16" name="endDate" required placeholder="Event End Date">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="guestExpected" required placeholder="Expected No. of Guests">
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="numberOfRoom" required placeholder="No. of Rooms Required">
							</div>
							<div class="col-md-6">
								<select name="cater" id="cater" class="form-control mb16" required>
									<option value="1" disabled="disabled" selected="selected">Catering Required</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="form-row mb16">
							<div class="col-sm-12">
								Audio/Visual Needs:
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="audioVisuals[]" value="Screen">
									<label class="form-check-label" for="inlineCheckbox1">Screen</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="audioVisuals[]" value="LCD Projector">
									<label class="form-check-label" for="inlineCheckbox2">LCD Projector</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="audioVisuals[]" value="Easel">
									<label class="form-check-label" for="inlineCheckbox3">Easel</label>
								</div>
							</div>
						</div>
						<div class="form-row">
							<textarea id="" cols="" rows="4" class="form-control" name="message" required placeholder="Message"></textarea>
						</div>
						<div class="text-center">
							<input type="submit" class="btn mt16 mb16 btn-filled" name="submit" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

@endsection
