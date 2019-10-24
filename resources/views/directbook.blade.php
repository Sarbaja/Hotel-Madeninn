@extends('layouts.app')

@section('title', 'Hotel Maden Inn | Booking')

@section('content')

    <!-- Page Title Section -->
	 <section style="padding-bottom:0px !important;">
        <div class="container">
            <div class="floater-book non-floater mt120">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>Book A Room</h2>
                        </div>
                    </div>
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
                                <div class="col-md-1">
                                </div>
                                <div class="col-sm-10">
                                    <form action="{{url('/confirmBooking')}}" method="post" class="frm form-inline">
                                        @csrf
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"> <i class="far fa-calendar-plus"></i> </div>
                                            </div>
                                            <input class="form-control" name="checkInDate" onchange="setStartDate(this.value)" id="startDate" placeholder="Check In Date" required="">
                                        </div>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-calendar-minus"></i></div>
                                            </div>
                                            <input class="form-control" name="checkOutDate" id="endDate" placeholder="Check Out Date" required="">
                                        </div>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-users"></i></div>
                                            </div>
                                            <select class="form-control" name ="numberOfAdults" required="">
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
                                            <select class="form-control" name="numberOfChildren" required="">
                                                <option value="0">Children</option>
                                                @for($i=1; $i<5; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Title Section -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-sm-8">
					<h3 class="cursive text-center">Booking Information</h3>    
						<div class="form-row">
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="firstName" required placeholder="First Name">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="lastName" required placeholder="Last Name">
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<input type="email" class="form-control mb16" name="email" required placeholder="Email Address">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="contact" required placeholder="Contact Number">
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="city" required placeholder="City">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control mb16" name="country" required placeholder="Country">
							</div>
                        </div>
                        <div class="form-row" style="padding-bottom:15px;">
                            <div class="col-md-12">
                                <select class="form-control" name="roomId" required="">
                                    <option value="">Select Room</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" value="{{$room->priceSingle}}" name="price">
						<div class="form-row">
							<textarea name="" id="" cols="" rows="4" class="form-control" name="additionalMessage" placeholder="Additional Message"></textarea>
						</div>
						<h5 class="cursive mt64">
								Flight Details
							</h5>
							<div class="form-row">
								<div class="col-md-12">
									<input type="date" class="form-control mb16" name="dateOfFlight" placeholder="Date of the Flight">
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-12">
									<input type="text" class="form-control mb16" name="flightNumber" placeholder="Flight Number">
								</div>
							</div>
						<div class="text-center">
							<input type="submit" class="btn mt16 mb16 btn-filled" name="submit" value="Submit">
						</div>
					</form>
                </div>
                <div class="col-md-2">
                </div>
				<div class="col-sm-4 pt112 pt-xs-16">
					
				</div>
            </div>
        </div>
    </section>

@endsection
