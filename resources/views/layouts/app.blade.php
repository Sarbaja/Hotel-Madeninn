<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="author" content="ktmrush/ Anish Maharjan"/>
    <!--SEO/FB Metas-->
    @if(!empty($meta_description))
    <meta name="description" content="{{$meta_description}}">
    @else
    <meta name="description" content="In the hustle and bustle of Itahari, Sunsari, Eastern Part of Nepal we successfully provide the most sophisticated space. The features are thoughtfully chosen top-quality arrangement, just for you. Hotel maden inn is one of the best and one of the cheapest hotels in Itahari, Susari, Eastern Part of Nepal.">
    @endif
    @if(!empty($meta_keywords))
    <meta name="keywords" content="{{$meta_keywords}}">
    @else
    <meta name="keywords" content="hotels in sunsari, ithari">
    @endif
    <meta name="author" content="KTMRush/ Anish Maharjan">
    <meta name="robots" content="index,follow"/>
    <meta property="og:title" content=""/>
    <!--<meta property="og:image" content="#"/>-->
    <meta property="og:description" content=""/>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('images/logo/logo.png')}}" type="image/png"/>

    <!-- Font-Awesome  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css"
          integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

    <!-- CSS FILES -->
    <link href=" {{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all"/>
    <link rel="stylesheet" href=" {{ asset('css/animate.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/jquery.mb.YTPlayer.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/datepicker.css') }}">

    <!-- Added script css-->
    <link rel="stylesheet" href="{{asset('css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/slick.min.css') }}">
    <!-- Added script css-->

{{--	<link href=" {{ asset('css/slider.css') }}" rel="stylesheet" type="text/css" media="all" />--}}
<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700|Open+Sans:400,700|Raleway:400,700"
          rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Pacifico" rel="stylesheet">
    <link rel='stylesheet' href='http://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css'>
    <link href=" {{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>


    <style type="text/css">
        	.qty .count {
    color: #000;
    display: inline-block;
    vertical-align: top;
    font-size: 15px;
    font-weight: 700;
    line-height: 30px;
    min-width: 35px;
    text-align: center;
    width:2%;
}
.qty .plus {
    cursor: pointer;
    display: inline-block;
    vertical-align: top;
    color: white;
    width: 30px;
    height: 30px;
    font: 30px/1 Arial,sans-serif;
    text-align: center;
    border-radius: 50%;
    }
.qty .minus {
    cursor: pointer;
    display: inline-block;
    vertical-align: top;
    color: white;
    width: 30px;
    height: 30px;
    font: 30px/1 Arial,sans-serif;
    text-align: center;
    border-radius: 50%;
    background-clip: padding-box;
}
.minus:hover{
    background-color: #b7832e !important;
}
.plus:hover{
    background-color: #b7832e !important;
}
/*Prevent text selection*/
span{
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input:disabled{
    background-color:white;
}
       
    </style>


</head>
<body>
    
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v3.3'
        });
      };
    
      (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div class="loader">
    <div class="inner-loader">
        <div class="a" style="--n: 5;">
            <div class="dot" style="--i: 0;"></div>
            <div class="dot" style="--i: 1;"></div>
            <div class="dot" style="--i: 2;"></div>
            <div class="dot" style="--i: 3;"></div>
            <div class="dot" style="--i: 4;"></div>
        </div>
    </div>
</div>

<div class="topbar d-none d-md-block d-lg-block .d-xl-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
					<span class="top-nav">
						<a href="tel:{{ $setting->phone }}">
							<i class="fa fa-phone"></i> {{ $setting->phone }}
						</a>
					</span>
                <span class="top-nav">
						<a href="mailto:{{ $setting->siteemail }}">
							<i class="fa fa-envelope"></i> {{ $setting->siteemail }}
						</a>
					</span>
            </div>
            <div class="col-sm-6 text-right">
					<span class="top-nav">
						<a href="{{ $setting->facebookurl }}" target="_blank" style="font-size:18px;">
							<i class="fab fa-facebook"></i>
						</a>
                    </span>
                <span class="top-nav">
							<a href="{{ $setting->instagramurl }}" target="_blank" style="font-size:18px;">
								<i class="fab fa-instagram"></i>
							</a>
                        </span>
            </div>
        </div>
    </div>
</div>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark main-nav" style="position: absolute">
    <div class="container-fluid" id="nv-second">
        <div class="navbar-collapse collapse nav-content order-2">
            <ul class="nav navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link lh-fix" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle lh-fix" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @php
                            $pages = DB:: table('tbl_policy')
                                    ->where([
                                        ['display', '=', 1]
                                    ])
                                    ->orderBy('order_item', 'asc')
                                    ->get();
                        @endphp
                        @foreach( $pages as $about)
                            <a class="dropdown-item"
                               href="{{ url('/about') }}/{{ $about->slug }}">{{ $about->title }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle lh-fix" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rooms</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @php
                            $rooms = DB:: table('tbl_rooms')
                                    ->where([
                                        ['display', '=', 1]
                                    ])
                                    ->orderBy('order_item', 'asc')
                                    ->get();
                        @endphp
                        @foreach($rooms as $room)
                            <a class="dropdown-item" href="{{ url('rooms') }}/{{ $room->slug }}"> {{ $room->title }}</a>
                        @endforeach
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle lh-fix" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Amneties</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @php
                            $amneties = DB:: table('tbl_locations')
                                    ->where([
                                        ['display', '=', 1]
                                    ])
                                    ->orderBy('order_item', 'asc')
                                    ->get();
                        @endphp
                        @foreach($amneties as $amnetie)
                            <a class="dropdown-item"
                               href="{{ asset('amneties') }}/{{ $amnetie->slug }}">{{ $amnetie->title }}</a>
                        @endforeach

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Meetings <br
                            class="d-none d-sm-block">& Groups</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @php
                            $meetings = DB:: table('tbl_meetings')
                                    ->where([
                                        ['display', '=', 1]
                                    ])
                                    ->orderBy('order_item', 'asc')
                                    ->get();
                        @endphp
                        @foreach( $meetings as $meeting)
                            <a class="dropdown-item"
                               href="{{ url('meeting') }}/{{ $meeting->slug }}">{{ $meeting->title }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav text-nowrap flex-row mx-md-auto order-1 order-md-2">
            <li class="nav-item"><a href="tel:{{ $setting->phone }}" class="nav-link d-block d-sm-none">
                    <i class="fa fa-phone" style="font-size:18px;"></i>
                </a></li>
            <li class="nav-item logo-holder"><a class="nav-link" href="{{ url('/') }}"><img
                        src="{{ asset('images/logo/logo.png') }}" class="logos logo d-none d-sm-none d-md-block" alt=""><img
                        src="{{ asset('images/logo/logo-sq.png') }}" class="logo-sq d-md-none" alt=""></a></li>
            <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target=".nav-content"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </ul>
        <div class="ml-auto navbar-collapse collapse nav-content order-3 order-md-3">
            <ul class="ml-auto nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('offers') }}">Offers</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @php
                            $events = DB:: table('tbl_events')
                                    ->where([
                                        ['display', '=', 1]
                                    ])
                                    ->orderBy('order_item', 'asc')
                                    ->get();
                        @endphp
                        @foreach( $events as $event)
                            <a class="dropdown-item"
                               href="{{ url('event') }}/{{ $event->slug }}">{{ $event->title }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('gallery') }}">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                </li>
                <li class="nav-item nav-book">
                    <a class="nav-link nav-book" href="{{url('/booking')}}">Book</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar End -->

@yield('content')

<!-- Contact Form -->
<section class="contact bg-second pb32">
    <div class="container" data-wow-duration="0.7s">
        <h3 class="text-center sm-hd">Get in <span>Touch</span></h3>
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <form action="{{url('message')}}" method="post" class="frm">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <input type="text" class="form-control mb16" name="name" required placeholder="Name">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control mb16" name="email" required placeholder="Email">
                        </div>
                    </div>
                    <div class="form-row">
                        <textarea id="" cols="" rows="4" class="form-control" name="message" required
                                  placeholder="Message"></textarea>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn mt16 mb16 btn-filled" name="submit" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Contact Form -->

@include('sweet::alert')

<!-- footer -->
<footer>
    <div class="container">
        <ul class="quicklinks">
            <li><a href="{{ url('/') }}" class="gold">Home</a></li>
            <li><a href="{{ url('about/policies') }}" class="gold">Policies</a></li>
            <li><a href="{{ url('about/about-us') }}" class="gold">About Us</a></li>
             <li><a href="{{ url('about/careers') }}" class="gold">Careers</a></li>
             
                       @php
                            $rooms = DB:: table('tbl_rooms')
                                    ->where([
                                        ['display', '=', 1]
                                    ])
                                    ->orderBy('order_item', 'asc')
                                    ->get();
                        @endphp
                        @foreach($rooms as $room)
            <li><a href="{{ url('rooms') }}/{{ $room->slug }}" class="gold">{{ $room->title }}</a></li>
                        @endforeach
            <li><a href="{{ url('meeting/meeting-space') }}" class="gold">Meeting Space</a></li>
            <li><a href="{{ url('offers') }}" class="gold">Offers</a></li>
            <li><a href="{{ url('gallery') }}" class="gold">photo gallery</a></li>
          
            <li><a href="{{ url('contact') }}" class="gold">contact</a></li>
        </ul>
        <hr>
        <div class="row">
            <div class="col-sm-4">
                <img src="{{ asset('./images/logo/logo.png') }}" class="img-fluid" alt="footer logo">
            </div>
            <div class="col-sm-4 pt32 pt-xs-8 fot-text">
                <h2 class="gold  font-weight-bold mb16">Hotel Maden Inn</h2>
                <h5 class="cursive-font gold">{{$setting->address}}</h5>
                <ul class="foot-list">
                    <li><a href="tel:{{$setting->phone}}" class="gold cursive-font pt8 pb8"><i
                                class="fa fa-phone gold"></i> {{$setting->phone}}</a></li>
                    <li><a href="tel:{{$setting->mobile}}" class="gold cursive-font pt8 pb8"><i
                                class="fa fa-mobile gold"></i> {{$setting->mobile}}</a></li>
                    <li><a href="mailto:{{$setting->siteemail}}" class="gold cursive-font pt8 pb8"><i
                                class="fa fa-envelope gold"></i> {{$setting->siteemail}}</a></li>
                </ul>
            </div>
            <div class="col-sm-4 pt32 pt-xs-8 text-center">
                <h2 class="gold font-weight-bold cursive-font">Get Social</h2>
                <ul class="mt8 social-link">
                    <li><a href="https://www.facebook.com/hotelmadeninn"><i class="fab fa-facebook gold"></i></a></li>
                    <li><a href="https://www.instagram.com/madeninn/"><i class="fab fa-instagram gold"></i></a></li>
                </ul>
                <div class="row">
                    <div class="col-4 offset-2 rela">
                        <a href="https://www.booking.com/index.en-gb.html?label=gen173nr-1BCAEoggI46AdIM1gEaKsBiAEBmAEJuAEYyAEM2AEB6AEBiAIBqAIEuAL7rILsBcACAQ;sid=096534acebd238fbe1945b5782a67f64;keep_landing=1&sb_price_type=total&;"><img src="{{ asset('./images/logo/bookingcom.png') }}" class="img-fluid" alt="bookimg.com"></a>
                    </div>
                    <div class="col-4 rela">
                        <img src="{{ asset('./images/logo/tripadvisor.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- end of row -->
    </div>
</footer>
<!-- footer -->
<section class="footnote pt16 pb8">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 text-sm-center">
                <h6>&copy; Copyrights by Hotel Maden Inn {{ date('Y') }}</h6>
            </div>
            <div class="col-sm-6">
                <h6 class="text-md-right text-sm-center">Coded with <i class="fa fa-heart" style="color:#8a0505;"></i> by <a href="https://www.kaaikaas.com/"
                                                                                                           target="_blank">KaaiKaas</a>
                </h6>
            </div>
        </div>
    </div>
</section>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="1669720773128948">
</div>

<!-- added script -->
<script type="text/javascript" src="{{asset('js/jquery.fancybox.min.js')}}"></script>
<!-- added script -->

<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/wow.min.js') }}"></script>
<!-- <script src="{{ asset('js/jquery.mb.YTPlayer.min.js') }}"></script> -->
<script src="{{ asset('js/datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

<script src='{{ asset('js/slick.min.js') }}'></script>
<script src="{{ asset('js/slider.js') }}" type="text/javascript"></script>



<script>

    $("#startDate").datepicker({
        startDate:"today",
        autoclose:true,
        format:"yyyy/mm/dd"
    });
    function setStartDate(startDate){
        $("#endDate").val('');
        $("#endDate").datepicker('destroy').datepicker({
            startDate: startDate,
            autoclose:true,
            format:"yyyy/mm/dd"
        });
    }


    // WOW SCRIPT added script
    wow = new WOW(
        {
            boxClass:     'wow',      // default
            animateClass: 'animated', // default
            offset:       0,          // default
            mobile:       false,       // default
            live:         true        // default
        }
    )
    wow.init();

    $(window).on('load', function(){
        $('.main-mas').masonry({
            itemSelector: '.mas-gal',
            columnWidth: '.mas-gal'
        });
    });

    $('[data-fancybox="gallery"]').fancybox({
        // Options will go here
    });
    //added script end


    //No of room portion
    /*$(document).ready(function(){
		   
   			$(document).on('click','.plus',function(){
				$('.count').val(parseInt($('.count').val()) + 1 );
    		});
        	$(document).on('click','.minus',function(){
    			$('.count').val(parseInt($('.count').val()) - 1 );
    				if ($('.count').val() == 0) {
						$('.count').val(1);
					}
    	    	});
 	});*/

</script>


</body>
</html>
