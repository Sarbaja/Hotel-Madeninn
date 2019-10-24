@extends('layouts.frontApp')

@section('title', 'Hotel Maden Inn | Attractions')

@section('content')

    @foreach($attractions as $row)
    <!-- Welcome Section -->
	<section class="bg-second">
		<div class="container">
			<div class="contents">
				<h1 class="uppercase text-center font-weight-bold sm-hd wow fadeInUp" data-wow-duration="1.2s">{{$row->title}}</h1>
				<h6 class="text-center mt32 mt-xs-16 wow fadeInUp" data-wow-duration="1.2s">
					{!! $row->description !!}
				</h6>
			</div>
		</div>
	</section>
	<!-- Welcome Section -->

	<!-- Breaker Section -->
	<section class="bg-image fullscreen dark-bg fixed-bg breaker" style="background-image: url('{{asset('uploads/attractions/thumbs/large_' . $row->image)}}')">
	</section>
	<!-- Breaker Section -->
    @endforeach

@endsection