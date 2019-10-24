@extends('layouts.frontApp')

@section('title', 'Hotel Maden Inn | Blogs')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-sm-4 abt-left mb32 mb-xs-16">
                    <a href="{{url('blog/'.$blog->slug)}}"><img src="{{asset('uploads/blogs/thumbs/thumb_'.$blog->image)}}" alt=""></a>
                    <h3><a href="{{url('blog/'.$blog->slug)}}">{{$blog->title}}</a></h3>
                    <p>{!!  substr($blog->description, 3, 225) !!}...</p>
                    <label>{{date('F, j, Y', strtotime("$blog->created_at"))}}</label>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
@endsection