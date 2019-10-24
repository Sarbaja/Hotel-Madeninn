@extends('layouts.frontApp')

@section('title', 'Maden Inn Hotel |'.  $policy->title )



@section('content')
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

    <section>
		<div class="container">
			<h2 class="merriweather sm-hd uppercase font-weight-bold"><span>Hotel Maden inn</span>  {{ $policy->title }}</h2>
			{!! $policy->description !!}
		</div>
	</section>

@endsection

