<?php
/**
 * Created by PhpStorm.
 * Author Name: Subas Nyaupane
 * Author Email: subas.nyaupane143@gmail.com
 * Author Url : https://subasnyaupane.github.io/
 * Date: 14/Jan/2019
 */
?>
    <!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="#">
    <link rel="icon" type="image/png" href="#">
    <!-- Favicon -->
    <link rel="icon" href="{{asset('images/logo/logo.png')}}" type="image/png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Admin Panel | @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="#"/>
    <!--  Social tags      -->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="#">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="">
    <meta name="twitter:site" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:creator" content="">
    <meta name="twitter:image" content="#">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="">
    <meta property="og:title" content=""/>
    <meta property="og:type" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:description" content=""/>
    <meta property="og:site_name" content=""/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="{{ asset('admin/css/font-awesome/latest/css/font-awesome.min.css') }}">
    <!-- CSS Files -->
    <link href="{{ asset('admin/css/material-dashboard.minf066.css?v=2.1.0') }}" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('admin/demo/demo.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/nestable.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/custom.css')}}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/nestable/nestable.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/lightbox/lightbox.min.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="{{ asset('admin/assets/js/core/jquery.min.js')}}"></script>

</head>

<body class="">
<!-- Extra details for Live View on GitHub Pages -->
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="black">
        <div class="logo">
            <!-- <a href="{{ url('admin/index') }}" class="simple-text logo-mini">
                NA
            </a> -->
            <a href="{{ url('admin/index') }}" class="simple-text logo-normal text-center">
                <img src="{{ asset('storage/setting/'.$setting->logo) }}" class="img-fluid" style="width: 30%"/>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="{{ asset('admin/img/default-avatar.png') }}"/>
                </div>
                <div class="user-info">
                    <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                {{ Auth::user()->name }}
                  <b class="caret"></b>
              </span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="modal" data-target="#viewProfile{{ Auth::user()->id }}" href="#">
                                    <span class="sidebar-mini"> MP </span>
                                    <span class="sidebar-normal"> My Profile </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="updateuser/{{ Auth::user()->id }}">
                                    <span class="sidebar-mini"> EP </span>
                                    <span class="sidebar-normal"> Edit Profile </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item  {{ Request::segment(2) === 'index' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.index') }}">
                        <i class="material-icons">dashboard</i>
                        <p> Dashboard </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'adduser' || Request::segment(2) === 'users' ? 'active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
                        <i class="material-icons">person</i>
                        <p> Users
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ Request::segment(2) === 'adduser' || Request::segment(2) === 'users' ? 'show' : '' }}" id="pagesExamples">
                        <ul class="nav">
                            <li class="nav-item {{ Request::segment(2) === 'adduser' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.adduser') }}">
                                    <span class="sidebar-mini"><i class="material-icons">add person</i></span>
                                    <span class="sidebar-normal"> Add Users </span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::segment(2) === 'users' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.users') }}">
                                    <span class="sidebar-mini"><i class="material-icons">list person</i></span>
                                    <span class="sidebar-normal"> List Users </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'setting' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.setting') }}">
                        <i class="material-icons">settings</i>
                        <p> Site Setting </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'slider' ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/slider')}}">
                        <i class="material-icons">slideshow</i>
                        <p> Sliders </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'policy' ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/policy')}}">
                        <i class="fa fa-file-o"></i>
                        <p> About </p>
                    </a>
                </li>


                <li class="nav-item {{ Request::segment(2) === 'rooms' ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/rooms')}}">
                        <i class="material-icons">hotel</i>
                        <p> Rooms </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'meetings' ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/meetings')}}">
                        <i class="material-icons">meeting_room</i>
                        <p> Meeting & Groups </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'events' ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/events')}}">
                        <i class="material-icons">event</i>
                        <p> Events </p>
                    </a>
                </li>

                <li class="nav-item {{ Request::segment(2) === 'locations' ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/locations')}}">
                        <i class="material-icons">location_on</i>
                        <p> Amneties </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'retails/2/edit' ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/retails/2/edit')}}">
                        <i class="material-icons">assignment</i>
                        <p> Offers </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'albums' ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/gallery/2')}}">
                        <i class="material-icons">photo_gallery</i>
                        <p> Gallery </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(2) === 'bookmails' ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/bookmails')}}">
                        <i class="fa fa-table"></i>
                        <p> Booked Rooms </p>
                    </a>
                </li>

                <li class="nav-item {{ Request::segment(2) === 'pages' ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/pages')}}">
                        <i class="fa fa-file"></i>
                        <p>Home pages </p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top "
             style="background-color: #191919!important; color: #fff!important;">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                            <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    {{--<a class="navbar-brand" href="#pablo">Dashboard</a>--}}
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}" target="_blank"><i class="fa fa-window-restore" aria-hidden="true"></i> Visit Site</a>
                        </li>

                        <li class="nav-item dropdown ">
                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>&nbsp;{{ Auth::user()->name }}
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <!--<a class="dropdown-item" href="#">Change Password</a>-->
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            @yield('content')
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright">
                    &copy;
                    <?= date('Y'); ?>
                    , made with <i class="material-icons">favorite</i> by
                    <a href="http://ktmrush.com" target="_blank">KaaiKaas Innovations PVT.LTD</a> for a better web.
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- view modal -->
<div class="modal fade" id="viewProfile{{ Auth::user()->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profile Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                <div class="instruction">
                    <p><strong>Name : </strong><span>{{ Auth::user()->name }}</span></p>
                    <p><strong>Email : </strong><span>{{ Auth::user()->email }}</span></p>
                    <p><strong>Status : </strong><span>@if(Auth::user()->role == '1')Active @endif @if(Auth::user()->role == '0')Inactive @endif </span></p>
                    <p><strong>Role : </strong><span>@if(Auth::user()->role == '1')Admin User @endif @if(Auth::user()->role == '0')Normal User @endif </span></p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end view modal -->


<!--   Core JS Files   -->
<!-- <script src="{{ asset('admin/js/core/jquery.min.js') }}"></script> -->

<script src="{{ asset('admin/plugins/nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('admin/plugins/lightbox/lightbox-plus-jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('admin/plugins/sweetalert/sweetalert-dev.js') }}"></script>
<script src="{{ asset('admin/plugins/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/core/bootstrap-material-design.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
<!-- Plugin for the momentJs  -->
<script src="{{ asset('admin/js/plugins/moment.min.js') }}"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{ asset('admin/js/plugins/sweetalert2.js') }}"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('admin/js/plugins/jquery.validate.min.js') }}"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ asset('admin/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('admin/js/plugins/bootstrap-selectpicker.js') }}"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{ asset('admin/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="{{ asset('admin/js/plugins/jquery.dataTables.min.js') }}"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ asset('admin/js/plugins/bootstrap-tagsinput.js') }}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('admin/js/plugins/jasny-bootstrap.min.js') }}"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{ asset('admin/js/plugins/fullcalendar.min.js') }}"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{ asset('admin/js/plugins/jquery-jvectormap.js') }}"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('admin/js/plugins/nouislider.min.js') }}"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="{{ asset('admin/js/core.js') }}"></script>
<!-- Library for adding dinamically elements -->
<script src="{{ asset('admin/js/plugins/arrive.min.js') }}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="{{ asset('admin/js/buttons.js') }}"></script>
<!-- Chartist JS -->
<script src="{{ asset('admin/js/plugins/chartist.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('admin/js/plugins/bootstrap-notify.js') }}"></script>
{{--Nestable--}}
<script src="https://cdn.rawgit.com/dbushell/Nestable/master/jquery.nestable.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('admin/js/material-dashboard.minf066.js?v=2.1.0') }}" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('admin/demo/demo.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        $().ready(function () {
            $sidebar = $('.sidebar');

            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                    $('.fixed-plugin .dropdown').addClass('open');
                }

            }

            $('.fixed-plugin a').click(function (event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .active-color span').click(function () {
                $full_page_background = $('.full-page-background');

                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });

            $('.fixed-plugin .background-color .badge').click(function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('background-color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-background-color', new_color);
                }
            });

            $('.fixed-plugin .img-holder').click(function () {
                $full_page_background = $('.full-page-background');

                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');


                var new_image = $(this).find("img").attr('src');

                if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function () {
                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }

                if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $full_page_background.fadeOut('fast', function () {
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }

                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });

            $('.switch-sidebar-image input').change(function () {
                $full_page_background = $('.full-page-background');

                $input = $(this);

                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                }
            });

            $('.switch-sidebar-mini input').change(function () {
                $body = $('body');

                $input = $(this);

                if (md.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    md.misc.sidebar_mini_active = false;

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                } else {

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                    setTimeout(function () {
                        $('body').addClass('sidebar-mini');

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function () {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function () {
                    clearInterval(simulateWindowResize);
                }, 1000);

            });
        });
    });
</script>
<!-- Sharrre libray -->
<script src="{{ asset('admin/demo/jquery.sharrre.js') }}"></script>
<script>
    $(document).ready(function () {


        $('#facebook').sharrre({
            share: {
                facebook: true
            },
            enableHover: false,
            enableTracking: false,
            enableCounter: false,
            click: function (api, options) {
                api.simulateClick();
                api.openPopup('facebook');
            },
            template: '<i class="fab fa-facebook-f"></i> Facebook',
            url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
        });

        $('#google').sharrre({
            share: {
                googlePlus: true
            },
            enableCounter: false,
            enableHover: false,
            enableTracking: true,
            click: function (api, options) {
                api.simulateClick();
                api.openPopup('googlePlus');
            },
            template: '<i class="fab fa-google-plus"></i> Google',
            url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
        });

        $('#twitter').sharrre({
            share: {
                twitter: true
            },
            enableHover: false,
            enableTracking: false,
            enableCounter: false,
            buttons: {
                twitter: {
                    via: 'CreativeTim'
                }
            },
            click: function (api, options) {
                api.simulateClick();
                api.openPopup('twitter');
            },
            template: '<i class="fab fa-twitter"></i> Twitter',
            url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
        });


        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-46172202-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();

        // Facebook Pixel Code Don't Delete
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
            document, 'script', '../assets/js/fbevents.js');

        try {
            fbq('init', '111649226022273');
            fbq('track', "PageView");

        } catch (err) {
            console.log('Facebook Track Error:', err);
        }

    });
</script>
<noscript>
    <img height="1" width="1" style="display:none"
         src="https://www.facebook.com/tr?id=111649226022273&amp;ev=PageView&amp;noscript=1"/>
</noscript>
<script>
    $(document).ready(function () {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

        md.initVectorMap();

    });
</script>
<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });

        var table = $('#datatable').DataTable();
    });
</script>
</body>


</html>


