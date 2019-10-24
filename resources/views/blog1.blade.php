@extends('layouts.app')

@section('content')
    <section id="page-title" class="top-space">
            <div class="container clearfix">
                <h1>Blog</h1>
            </div>
	</section>

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="single-post nobottommargin">
                        
                    <div class="entry clearfix">
                            
                        <div class="entry-title">
                            <h2>{{$blog->title}}</h2>
                        </div>
                        
                        <div class="entry-image bottommargin">
                            <a href="#"><img src="{{asset('uploads/blogs/thumbs/large_'.$blog->image)}}" alt="Blog Single"></a>
                        </div>
                            
                        <div class="entry-content notopmargin">
                            {!! $blog->description !!}
                        
                            <div class="clear"></div>
                        
                        <div class="si-share noborder clearfix">
                    </div>
                </div>
            </div>

            <div class="line"></div>
            <h4>Related Posts:</h4>
            <div class="related-posts clearfix">
                <div class="row">
                    @foreach($otherBlog as $oBlog)
                        <div class="col-md-6" style="margin-bottom:20px;">
                            <div class="mpost clearfix">
                                <div class="entry-image">
                                    <a href="{{url('NepalAgora/blog-single/'. $oBlog->id )}}"><img src="{{asset('uploads/blogs/thumbs/thumb_'). $oBlog->image}}" alt="Blog Single"></a>
                                </div>
                                <div class="entry-c">
                                    <div class="entry-title" style="height: 30px;">
                                        <h4><a href="{{url('NepalAgora/blog-single/'. $oBlog->id )}}">{{$oBlog->title}}</a></h4>
                                    </div>
                                    <div class="entry-content">{!! substr($oBlog->description, 0, 100) !!}</div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
                
                
            <div class="fb-comments" data-href="http://localhost:8080/NepalAgora/blog-single/2" data-numposts="5"></div>
            
                <!-- </div>
            </div> -->
        </div>
    </section>

@endsection