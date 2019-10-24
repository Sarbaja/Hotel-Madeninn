@php
@endphp
@extends('layouts.app')

@section('title', 'Hotel Maden Inn | Booking Information')

@section('content')

    <!-- Page Title Section -->
	 <section class="fullscreen pt0 pb0 bg-image" style="background-image:url('./images/b3.jpg');">
        <div class="floater-book">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<h5>Book A Room</h5>
					</div>
					<div class="col-sm-10">
						<form action="" class="form-inline">
							<div class="input-group mb-2 mr-sm-2">
								<div class="input-group-prepend">
									<div class="input-group-text"> <i class="far fa-calendar-plus"></i> </div>
								</div>
								<input class="form-control" onchange="setStartDate(this.value)" id="startDate" name="checkInDate" value="@if(isset($checkInDate)){{ $checkInDate }} @endif" id="startDate" placeholder="Check In Date">
							</div>
							<div class="input-group mb-2 mr-sm-2">
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="far fa-calendar-minus"></i></div>
								</div>
								<input  class="form-control" name="checkOutDate" value="@if(isset($checkOutDate)) {{ $checkOutDate }} @endif" id="endDate" placeholder="Check Out Date">
							</div>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-users"></i></div>
                                </div>
                                <select class="form-control" name="numberOfAdults">
                                    <option value="0">Adults</option>
                                    @for($i=1; $i<5; $i++)
                                        <option value="{{ $i }}" @if($numberOfAdults == $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-users"></i></div>
                                </div>
                                <select class="form-control" name="numberOfChildren">
                                    <option value="0">Children</option>
                                    @for($i=1; $i<5; $i++)
                                        <option value="{{ $i }}" @if($numberOfChildren == $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </section>
    <!-- Page Title Section -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
					<h3 class="cursive text-center">Please Review Your Booking Information</h3>
					<form action="{{url('/confirmBooking')}}" method="post" class="frm">
						@csrf
						<input type="hidden" name="roomId" value="{{$room->id}}">
						<input type="hidden" name="checkInDate" class="inDate" value="@if(isset($checkInDate)) {{$checkInDate}} @else {{''}} @endif">
						<input type="hidden" name="checkOutDate" class="outDate" value="@if(isset($checkOutDate)) {{$checkOutDate}} @else {{''}} @endif">
                        <input type="hidden" name="numberOfAdults" value="@if(isset($numberOfAdults)) {{ $numberOfAdults }} @else {{''}} @endif">
                        <input type="hidden" name="numberOfChildren" value="@if(isset($numberOfChildren)) {{ $numberOfChildren }} @else {{''}} @endif">
						<input type="hidden" name="price" value="{{$price}}">

                        <h5 class="cursive">
							Purchaser Information
						</h5>
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
							<input type="submit" class="btn mt16 mb16 btn-filled" name="submit" id="btn" value="Submit">
						</div>
					</form>
				</div>
				<div class="col-sm-4 pt112 pt-xs-16">
					<div class="price">
						<h5 class="cursive">Reservation Details</h5>
						<h6 class="cursive"><strong>{{$room->title}}</strong> <strong class="float-right">Rs. {{$price}} Per Night</strong></h6>
						@if(@$checkInDate)<h6><small>
                                @php
                                    $startDate = strtotime($checkInDate);
                                    $endDate = strtotime($checkOutDate);
                                    $datediff = $endDate - $startDate;
                                    $numOfDays = round($datediff / (60 * 60 * 24));
                                @endphp
                                Total Night <span style="float: right;">{{ $numOfDays }}</span>
                            </small></h6>@endif
						<!--@if(@$numberOfRoom)<h6><small>{{@$numberOfRoom}} No Of Room</small></h6>@endif-->
						<hr>
                        <?php
                        $subTotal = $price * $numOfDays;
                        $tax = $subTotal * 0.13;
                        $total = $subTotal + $tax;
                        ?>
						<h6 class="cursive"><strong>Sub-Total: </strong> <strong class="float-right">Rs. {{ $subTotal }}</strong> </h6>
						<h6 class="cursive"><strong>Tax: </strong> <strong class="float-right">Rs. {{ $tax }}</strong> </h6>
						<hr>
						<h6 class="cursive"><strong>Total: </strong> <strong class="float-right">Rs. {{ $total }}</strong> </h6>
					</div>
				</div>
            </div>
        </div>
    </section>

	<script>
        $( "#startDate" ).change(function() {
            var inDate = $( "#startDate" ).val();
            $('.inDate').val(inDate);
        });
        $( "#endDate" ).change(function() {
            var outDate = $( "#endDate" ).val();
            $('.outDate').val(outDate);
        });

		$("#btn").click(function() { 
                if($("#startDate").val().length == 0){
                    //alert('Add checkout date please!!');
                    //return false;
                    if(confirm('CheckIn Date is empty. Add Checkin date please!!')){
						return false;
					}else{
						return false;
					}
                } 
                if($("#endDate").val().length == 0){
                    //alert('Add checkout date please!!');
                    //return false;
                    if(confirm('CheckOut Date is empty. Add Checkout please!!')){
						return false;
					}else{
						return false;
					}
                }
        });

    </script>

@endsection
