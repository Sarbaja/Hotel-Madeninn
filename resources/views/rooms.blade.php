@extends('layouts.frontApp')

@section('title', 'Hotel Maden Inn | Rooms')

@section('content')
    
    <section style="margin-top:150px;">
        <div class="container">

            <h3 class="text-center">{{ $room->title }}</h3>
            <div class="row">
                <div class="col-sm-9">
                    <div class="big-slider">
                        @foreach($gallery as $galleries )
                            <div><img src="{{ asset('uploads/roomImages') }}/{{ $galleries->image_name }}"
                                      class="img-fluid"  alt=""></div>
                        @endforeach
                    </div>
                    <div class="small-slider">
                        @foreach($gallery as $galleries )
                            <div><img src="{{ asset('uploads/roomImages/thumbs') }}/thumb_{{ $galleries->image_name }}"
                                      class="img-fluid" alt=""></div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-3 room-side-bar">
                    <h4>Room Facilities</h4>
                    {!! $room->RoomFacilities  !!}
                </div>
            </div>
            <!-- <div class="row room-price"> -->
            <!--<small>Please click on the type of room to book .</small>-->
            <form action="{{url('/infobook')}}" method="post" class="room-price form-inline">
                @csrf
                <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-users"></i></div>
                        </div>
                        <select class="form-control" name="price" required="">
                            <option value="">Select Bed Type</option>
                            <option value="{{$room->priceSingle}}">Single Bed</option>
                            <option value="{{$room->priceDouble}}">Double Bed</option>
                        </select>
                </div>
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
                        <select class="form-control" name="numberOfAdults" required="">
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
                        <select class="form-control" name="numberOfChildren" required="">
                            <option value="0">Children</option>
                            @for($i=1; $i<5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <input type="hidden" name="roomId" value="{{$room->id}}">
                <div class="input-group mb-2 mr-sm-2">
                        <input type="submit" class="btn btn-filled mb0" value="Book">
                </div>
            </form>

            <div class="row">
                {!! $room->description !!}
            </div>
            <hr>
        </div>
    </section>

@endsection
