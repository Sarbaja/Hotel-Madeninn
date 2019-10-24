<?php
/**
 * Created by PhpStorm.
 * Author Name: Subas Nyaupane
 * Author Email: subas.nyaupane143@gmail.com
 * Author Url : https://subasnyaupane.github.io/
 * Date: 14/Jan/2019
 */
?>
@extends('admin.layouts.headerfooter')
@section ('title', 'Dashboard')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
<style>
    .card-icon a i{
        color: #fff;
    }
</style>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <a href="{{ route('admin.setting') }}"><i class="material-icons">settings</i></a>
                            </div>
                            <br>
                            {{--<a href="{{ route('admin.setting') }}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">Site Setting</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <a href="{{ route('admin.users') }}"><i class="material-icons">person</i></a>
                            </div>
                            <br>
                            {{--<a href="{{ route('admin.users') }}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">Users</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <a href="{{url('admin/slider')}}"><i class="material-icons">slideshow</i></a>
                            </div>
                            <br>
                            {{--<a href="{{url('admin/slider')}}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">Sliders</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <a href="{{url('admin/policy')}}"><i class="fa fa-file-o"></i></a>
                            </div>
                            <br>
                            {{--<a href="{{url('admin/policy')}}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">About</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <a href="{{url('admin/rooms')}}"><i class="material-icons">hotel</i></a>
                            </div>
                            <br>
                            {{--<a href="{{url('admin/rooms')}}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">Rooms</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <a href="{{url('admin/meetings')}}"><i class="material-icons">meeting_room</i></a>
                            </div>
                            <br>
                            {{--<a href="{{url('admin/meetings')}}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">Meeting & Groups</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <a href="{{url('admin/events')}}"><i class="material-icons">event</i></a>
                            </div>
                            <br>
                            {{--<a href="{{url('admin/events')}}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">Events</h3>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <a href="{{url('admin/locations')}}"><i class="material-icons">location_on</i></a>
                            </div>
                            <br>
                            {{--<a href="{{url('admin/locations')}}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">Amneties</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <a href="{{url('admin/retails/2/edit')}}"><i class="material-icons">assignment</i></a>
                            </div>
                            <br>
                            {{--<a href="{{url('admin/retails')}}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">Offers</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <a href="{{url('admin/gallery/2')}}"><i class="material-icons">photo_camera</i></a>
                            </div>
                            <br>
{{--                            <a href="{{url('admin/albums')}}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">Gallery</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <a href="{{url('admin/bookmails')}}"><i class="fa fa-table"></i> </a>
                            </div>
                            <br>
                            {{--<a href="{{url('admin/bookmails')}}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">Booked Rooms</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <a href="{{url('admin/pages')}}"><i class="fa fa-file"></i> </a>
                            </div>
                            <br>
                            {{--<a href="{{url('admin/bookmails')}}" class="card-category">Go To Page >></a>--}}
                        </div>
                        <div class="card-footer ">
                            <div class="stats" style="font-size: 18px; text-align: center;">
                                <h3 class="card-title">Home pages</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div data-notify="container" class="col-11 col-md-4 alert alert-rose alert-with-icon animated fadeInDown" role="alert" data-notify-position="bottom-right" style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; bottom: 20px; right: 20px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
        </button>
        <i data-notify="icon" class="material-icons">add_alert</i><span data-notify="title"></span> <span data-notify="message">
            Welcome to  Dashboard <br> Mantain your site as your desire.
        </span><a href="#" target="_blank" data-notify="url"></a>
    </div>


@endsection
