<?php
/**
 * Created by PhpStorm.
 * Project Title: nepalagora
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
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/img/apple-icon.png') }}">
    <link rel="icon" href="{{asset('images/logo/logo.png')}}" type="image/png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Hotel Maden Inn | Login
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="{{ asset('admin/css/font-awesome/latest/css/font-awesome.min.css') }}">
    <!-- CSS Files -->
    <link href="{{ asset('admin/css/material-dashboard.minf066.css?v=2.1.0') }}" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('admin/demo/demo.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet"/>
</head>

<body class="off-canvas-sidebar">
<!-- Extra details for Live View on GitHub Pages -->
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo">{{$setting->sitetitle}}</a>
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
                    <a href="../" class="nav-link">
                        <i class="material-icons">dashboard</i> Visit Site
                    </a>
                </li>
                <!-- @if (Route::has('password.request'))
                <li class="nav-item ">
                    <a href="{{ route('password.request') }}" class="nav-link">
                        <i class="material-icons">lock_outline</i>Forget Password
                    </a>
                </li>
                @endif -->
            </ul>
        </div>
    </div>
</nav>

<div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black"
         style="background-image: url('{{ asset('storage/login.jpg') }}'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card card-login">
                            <div class="card-header card-header-gray text-center card-style" style="background-color: #fff!important;">
                                <h4 style="color: #000;" class="card-title">Admin Panel</h4>
                                <div class="social-line">
                                    <a><img src="{{ asset('storage/setting') }}/{{ $setting->logo }}" style="width:30%"></a>

                                </div>
                            </div>
                            <div class="card-body ">

                                @if ($errors->has('email'))
                                    <p class="card-description text-center">Email Wrong!!!</p>
                                @endif
                                    <p class="card-description text-center">Please Login!!!</p>


                                <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">email</i>
                        </span>
                      </div>
                      <input type="email" name="email" value="{{ old('email') }}"
                             class="form-control {{ $errors->has('email') ? 'has-danger' : '' }}"
                             placeholder="Email...">
                    </div>
                  </span>
                                <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>
                      <input type="password" name="password"
                             class="form-control {{ $errors->has('password') ? 'has-danger' : '' }}"
                             placeholder="Password...">
                    </div>
                  </span>


                            </div>
                            <div class="card-footer ">
                                <div class="form-check mr-auto">
                                    <label class="form-check-label">
                                        <!-- <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Password
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span> -->
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-rose btn-round">Log in<span
                                        class="btn-label btn-label-right">
                        <i class="material-icons">keyboard_arrow_right</i>
                      </span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="copyright text-center">
                    &copy;
                    <?= date('Y'); ?>
                    Made with <i class="material-icons">favorite</i> by
                    <a href="http://www.kaaikaas.com" target="_blank">Kaaikaas</a>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- <div data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon animated fadeInDown" role="alert"
     data-notify-position="top-center"
     style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; left: 0px; right: 0px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="material-icons">close</i>
    </button>
    <i data-notify="icon" class="material-icons">add_alert</i><span data-notify="title"></span>
    <span data-notify="message">Something Went Wrong <br> Please Login!!!</span>
    <a href="#" target="_blank" data-notify="url"></a>
</div> -->


<!--   Core JS Files   -->
<script src="{{ asset('admin/js/core/jquery.min.js') }}"></script>
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
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('admin/js/material-dashboard.minf066.js?v=2.1.0') }}" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('admin/demo/demo.js') }}"></script>
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
</body>


</html>
