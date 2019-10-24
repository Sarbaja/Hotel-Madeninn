@extends('layouts.frontApp1')

@section('title', 'Hotel Maden Inn | Blogs')

@section('content')

    <section>
        <?php
            $slug = $blogSlug;
            $blog = DB::table('tbl_blogs')->where('slug', $slug)->first();
        ?>
        <div class="container">
            <img src="{{asset('uploads/blogs/'.$blog->image)}}" alt="" class="img-fluid">
            <h3 class="text-left font-weight-bold sm-hd mt32">{{$blog->title}}</h3>
            <p>{{date('F, j, Y', strtotime("$blog->created_at"))}}</p>
            <hr>
            {!!  $blog->description !!}
            <hr>
        </div>
    </section>

    <section class="contact pt16 pb16">
            <div class="container">
                <h3 class="text-center sm-hd">Leave a <span>Comment</span></h3>
                <div class="fb-comments" data-href="http://localhost:88/madeninn/public/blog/test-test" data-numposts="5"></div>
            </div>
    </section>

@endsection