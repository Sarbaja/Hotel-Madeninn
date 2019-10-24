@extends('layouts.frontApp')

@section('title', 'Hotel Maden Inn | Location')

@section('content')

    <!-- Welcome Section -->
	<section class="bg-second">
		<div class="container">
			<div class="contents">
				<h1 class="uppercase text-center font-weight-bold sm-hd wow fadeInUp" data-wow-duration="1.2s">Maden Inn <span>Retail</span></h1>
				<h6 class="text-center mt32 mt-xs-16 wow fadeInUp" data-wow-duration="1.2s">
					Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid eveniet voluptates expedita ipsam amet voluptatibus tenetur laboriosam voluptatum quaerat! Atque alias repellendus a placeat, veritatis inventore officiis exercitationem voluptatum totam?
				</h6>
				<h6 class="text-center mt32 mt-xs-16 wow fadeInUp" data-wow-duration="1.2s">
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime libero officia suscipit reprehenderit in iste velit fugit totam cum, inventore dolorum fuga ipsam exercitationem quo quam dolore sunt ab maiores.
				</h6>
			</div>
		</div>
	</section>
	<!-- Welcome Section -->

    <section>
        <div class="container">
            <div class="row">
                @foreach($retail as $i=>$row)

                    @if($i % 2 ==0)
                        <div class="col-md-6 mb32">
                            <img src="{{asset('uploads/retails/thumbs/thumb_' . $row->image)}}" alt="" class="img-fluid">
                        </div>
                    @endif
                    <div class="col-md-6 mb32">
                        <h3 class="merriweather uppercase">{{$row->title}}</h3>
                        {!! $row->description !!}
                    </div>
                    @if($i % 2 !=0)
                        <div class="col-md-6 mb32">
                            <img src="{{asset('uploads/retails/thumbs/thumb_' . $row->image)}}" alt="" class="img-fluid">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

@endsection