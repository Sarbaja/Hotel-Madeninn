@extends ('layouts.frontApp')

@section('title', 'Hotel Maden Inn | Breakfast')

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

	<!-- BreakFast Content -->
	<section>
		<div class="container">
			<h2 class="text-center font-weight-bold sm-hd uppercase">Enjoy Your Complementary Breakfast At <span>Maden Inn</span></h2>
			{!! $breakfast->description !!}
			<div class="row">
                @foreach($breakfastImages as $image)
                    <div class="col-sm-4" style="margin-top:30px;">
                        <img src="{{asset('uploads/breakfastImages/' . $image->image_name)}}" alt="" class="img-fluid">
                    </div>
                @endforeach
			</div>
		</div>
	</section>
	<!-- BreakFast Content -->

@endsection
