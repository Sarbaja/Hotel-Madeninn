@extends('layouts.app')

@section('title', 'Hotel Maden Inn | Booking')

@section('content')

    <!-- Booking Forms -->
    <section>
        <div class="container">
            <div class="floater-book non-floater mt120">
                <div class="container">
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
                            <h5></h5>
                        </div>
                        <div class="col-sm-10">
                            <form action="" method="post" class="form-inline">
                                @csrf
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"> <i class="far fa-calendar-plus"></i> </div>
                                    </div>
                                    <input class="form-control" name="checkInDate" onchange="setStartDate(this.value)" value="{{@$checkInDate}}" id="startDate" placeholder="Check In Date" required="">
                                </div>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="far fa-calendar-minus"></i></div>
                                    </div>
                                    <input class="form-control" name="checkOutDate" value="{{@$checkOutDate}}" id="endDate" placeholder="Check Out Date" required="">
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
        </div>
        <div class="container">
            <h2 class="merriweather uppercase font-weight-bold mb32">Guests Accomodations</h2>
            
                <div class="row" style="margin-bottom:100px;">
                        @foreach($rooms as $room)
                            <div class="col-md-6 mb32">
                                <img src="{{asset('uploads/rooms/thumbs/medium_' . $room->featured_image)}}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-6 mb32">
                                <h3 class="text-center font-weight-bold sm-hd"><span>{{$room->title}}</span></h3>
                                <h5><strong>Rs. {{$room->priceSingle}} per night</strong></h5>
                                <div style="margin-left:15px;margin-bottom:0px !important;">
                                    {!! $room->description !!}
                                </div>
                                <div style="margin-top:0px !important;">
                                        <form action="{{url('/infobook')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="roomId" value="{{@$room->id}}">
                                                <input type="hidden" name="checkInDate" class="inDate" value="@if(isset($checkInDate)) {{$checkInDate}} @else {{''}} @endif">
                                                <input type="hidden" name="checkOutDate" class="outDate" value="@if(isset($checkOutDate)) {{$checkOutDate}} @else {{''}} @endif">
                                                <input type="hidden" name="numberOfAdults" value="@if(isset($numberOfAdults)) {{ $numberOfAdults }} @else {{''}} @endif">
                                                <input type="hidden" name="numberOfChildren" value="@if(isset($numberOfChildren)) {{ $numberOfChildren }} @else {{''}} @endif">
                                                <input type="hidden" name="price" value="{{$room->priceSingle}}"/>
                                                <!-- No of room portion -->
                                                <!--<h5><strong>Select No. of rooms</strong></h5>
                                                <div class="qty">
                                                        <span class="minus bg-dark">-</span>
                                                        <input type="number" class="count" name="roomNumber" value="1">
                                                        <span class="plus bg-dark">+</span>
                                                </div>-->
                                                <button type="submit" id="btn" class="btn">Book</button>
                                        </form>

                                </div>
                            </div>
                        @endforeach
                </div>
        </div>
    </section>
    <!-- Booking Forms -->

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
                if($("#endDate").val().length == 0){
                    //alert('Add checkout date please!!');
                    //return false;
                    if(confirm('CheckOut Date is empty. Add Checkout date please!!')){
						return false;
					}else{
						return false;
					}
                } 
                if($("#startDate").val().length == 0){
                    //alert('Add checkout date please!!');
                    //return false;
                    if(confirm('CheckIn Date is empty. Add Checkin please!!')){
						return false;
					}else{
						return false;
					}
                }
            });
    </script>
    
   @endsection
