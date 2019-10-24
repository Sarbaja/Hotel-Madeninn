@extends('layouts.app')

@section('title', 'Hotel Maden Inn | Confirm Booking')

@section('content')

    <!-- Page Title Section -->
    <section class="fullscreen pt0 pb0 bg-image" style="background-image:url('{{ asset('images/b3.jpg') }}');">
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
                                    <div class="input-group-text"><i class="far fa-calendar-plus"></i></div>
                                </div>
                                <input class="form-control" value="{{$checkInDate}}" placeholder="Check In Date">
                            </div>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="far fa-calendar-minus"></i></div>
                                </div>
                                <input  class="form-control" value="{{$checkOutDate}}" placeholder="Check Out Date">
                            </div>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-users"></i></div>
                                </div>
                                <select class="form-control" name ="numberOfAdults" required="">
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
                                <select class="form-control" name="numberOfChildren" required="">
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
                <div class="col-sm-4 mb32">
                    <div class="price">
                        <h5 class="cursive">Reservation Details</h5>
                        <h6 class="cursive"><strong>{{$room->title}}</strong> <strong
                                class="float-right">Rs. {{$price}}</strong></h6>
                        <h6>
                                @php
                                    $startDate = strtotime($checkInDate);
                                    $endDate = strtotime($checkOutDate);
                                    $datediff = $endDate - $startDate;
                                    $numOfDays = round($datediff / (60 * 60 * 24));
                                @endphp
                            <small>No of Days {{$numOfDays}}</small>
                        </h6>
                        <h6>
                            <small> Number Of Adults  <span style="float: right">{{ $numberOfAdults }} </span></small><br>
                            <small> Number Of Children  <span style="float: right"> {{ $numberOfChildren }}</span></small>
                        </h6>
                        <hr>
                        <?php
                        $subTotal = $price * $numOfDays;
                        $tax = $subTotal * 0.13;
                        $total = $subTotal + $tax;
                        ?>
                        <h6 class="cursive"><strong>Sub-Total: </strong> <strong
                                class="float-right">Rs. {{ $subTotal }}</strong></h6>
                        <h6 class="cursive"><strong>Tax: </strong> <strong
                                class="float-right">Rs. {{ $tax }}</strong></h6>
                        <hr>

                        <h6 class="cursive"><strong>Total: </strong> <strong class="float-right">Rs. {{ $total }}</strong>
                        </h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="price">
                        <h5 class="cursive">Personal Information</h5>
                        <h6 class="cursive"><strong>Name: </strong> <strong class="float-right">{{$name}}</strong></h6>
                        <h6 class="cursive"><strong>Email Address: </strong> <strong
                                class="float-right">{{$email}}</strong></h6>
                        <h6 class="cursive"><strong>Contact Number: </strong> <strong
                                class="float-right">{{$contact}}</strong></h6>
                        <h6 class="cursive"><strong>City: </strong> <strong class="float-right">{{$city}}</strong></h6>
                        <h6 class="cursive"><strong>Country: </strong> <strong class="float-right">{{$country}}</strong>
                        </h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="price">
                        @if(!$dateOfFlight == '')
                            <h5 class="cursive">Flight Details</h5>
                            <h6 class="cursive"><strong>Date Of Flight</strong> <strong
                                    class="float-right">{{$dateOfFlight}}</strong></h6>
                            <h6 class="cursive"><strong>Flight Number </strong> <strong
                                    class="float-right">{{$flightNumber}}</strong></h6>
                        @endif
                    </div>
                </div>
                <div class="col-12 text-center">
                    <h6>
                        <small>I have agreed to all the terms and conditions provided by the company.</small>
                    </h6>
                    <form action="{{url('finalizeBooking')}}" method="post">
                        @csrf
                        <input type="hidden" name="roomId" value="{{$room->id}}">
                        <input type="hidden" name="checkInDate" value="{{$checkInDate}}">
                        <input type="hidden" name="checkOutDate" value="{{$checkOutDate}}">
                        <input type="hidden" name="numberOfAdults" value="{{$numberOfAdults}}">
                        <input type="hidden" name="numberOfChildren" value="{{$numberOfChildren}}">
                        <input type="hidden" name="totalPrice" value="{{$total}}">
                        <input type="hidden" name="customerName" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="hidden" name="contact" value="{{$contact}}">
                        <input type="hidden" name="city" value="{{$city}}">
                        <input type="hidden" name="country" value="{{$country}}">
                        <input type="hidden" name="dateOfFlight" value="{{$dateOfFlight}}">
                        <input type="hidden" name="flightNumber" value="{{$flightNumber}}">

                        <input type="submit" class="btn btn-filled" name="submit" value="Finalize Booking">
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
