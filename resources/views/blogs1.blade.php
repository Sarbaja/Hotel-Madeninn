@extends('layouts.app')

@section('content')
	<section id="page-title" class="top-space">
		<div class="container clearfix">
			<h1>Nepalagora Blogs</h1>
			<!-- <span>Start Buying your Favourite Theme</span> -->
			<!-- <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Shop</li>
			</ol> -->
		</div>
	</section>

	<section id="content">
		<div class="content-wrap">
			<div class="container clearfix">
				<div id="posts" class="post-grid grid-container clearfix" data-layout="fitRows">
					@foreach($blogs as $blog)
						<div class="entry clearfix">
							<div class="entry-image">
								<a href="{{asset('uploads/blogs') . '/' . $blog->image}}" data-lightbox="image"><img class="image_fade" src="{{asset('uploads/blogs/thumbs/thumb_') . $blog->image}}" alt="Standard Post with Image"></a>
							</div>
							<div class="entry-title">
								<h2><a href="{{url('blog-single/'. $blog->id)}}">{{$blog->title}}</a></h2>
							</div>
							<div class="entry-content">
								{!! substr($blog->description, 0, 160) !!}
                                <br>
								<a href="{{url('blog-single/'. $blog->id)}}" class="more-link">Read More</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>

@endsection

       