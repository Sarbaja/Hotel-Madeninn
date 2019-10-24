<?php
/**
 * Created by PhpStorm.
 * Project Title: hotelmadeninn
 * Author Name: Subas Nyaupane
 * Author Email: subas.nyaupane143@gmail.com
 * Author Url : https://subasnyaupane.github.io/
 * Date: 19/Apr/2019
 */
?>
@extends('admin.layouts.headerfooter')
@section ('title', 'Gallery')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">

                        @if(Request::segment(3) === $slug)

                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-image fa-2x"></i>
                                    Gallery
                                </div>
                                <h4 class="card-title">
                                    <!-- <a href="#addModal" data-toggle="modal" class="fa fa-trash" title="Delete Image"></a> -->
                                    <a style="float: right" href="#" class="btn btn-default btn-round">
                                        <i class="fa fa-arrow-circle-left"></i> Go Back
                                    </a>
                                </h4>
                            </div>
                            <hr>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card card-product" style="padding-top: 10px;">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="{{ asset('admin/assets/img/image_placeholder.jpg') }}"
                                                         alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Add Images</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="..."/>
                          </span>
                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                       data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @elseif($slug == 'commongallery')

                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-image fa-2x"></i>
                                    Gallery
                                </div>
                                <h4 class="card-title">
                                    <!-- <a href="#addModal" data-toggle="modal" class="fa fa-trash" title="Delete Image"></a> -->
                                    <a style="float: right" href="#" class="btn btn-default btn-round">
                                        <i class="fa fa-arrow-circle-left"></i> Go Back
                                    </a>
                                </h4>
                            </div>
                            <hr>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card card-product" style="padding-top: 10px;">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="{{ asset('admin/assets/img/image_placeholder.jpg') }}"
                                                         alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Add Images</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="..."/>
                          </span>
                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                       data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
