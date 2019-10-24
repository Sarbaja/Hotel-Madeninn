<?php
/**
 * Created by PhpStorm.
 * Project Title: nepalagora
 * Author Name: Subas Nyaupane
 * Author Email: subas.nyaupane143@gmail.com
 * Author Url : https://subasnyaupane.github.io/
 * Date: 04/Feb/2019
 */
?>
@extends('admin.layouts.headerfooter')
@section ('title', 'Slider')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    @if(Request::segment(3) === 'addslide')
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">image</i>
                            </div>
                            <h4 class="card-title"><b>Add Slider</b><span><a class="btn btn-rose"
                                                                             href="{{ route('admin.slider') }}"><i
                                            class="fa fa-plus"></i> Go Back</a></span></h4>
                            <form id="RegisterValidation" action="{{ route('admin.createslide') }}"
                                  enctype="multipart/form-data"
                                  method="POST" novalidate="novalidate">
                                {{ csrf_field() }}
                                <div class="card-body " style="padding-top: 30px;">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="siteTitle" class="bmd-label-floating"> Title *</label>
                                                <input type="text" name="title" value="{{ old('email') }}"
                                                       class="form-control"  required="true">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="siteUrl" class="bmd-label-floating"> Url *</label>
                                                <input type="text" name="url" value="{{ old('url') }}"
                                                       class="form-control" id="exampleUrl" required="true"
                                                       aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="{{ asset('admin/img/image_placeholder.jpg') }}" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="image">
                          </span>
                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="exampleSubtitle" class="bmd-label-floating">Slider Description *</label>
                                                <textarea name="subtitle" class="form-control" rows="6">{{ old('subtitle') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="col-6" style="padding-top: 20px;">
                                            <div class="togglebutton">
                                                <label for="exampleStatus" class="bmd-label-floating"><b>Slider Status</b></label>
                                                <label>
                                                    <input name="status" value="1" type="checkbox" checked>
                                                    <span class="toggle"></span>
                                                    <i class="text-warning">( Turn On If you want to active This User )</i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <div class="form-check mr-auto">
                                    </div>
                                    <button type="submit" class="btn btn-rose">Add Slider</button>
                                </div>
                            </form>
                        </div>

                    @elseif(Request::segment(3) === 'editslide')
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">image</i>
                            </div>
                            <h4 class="card-title"><b>Edit Slider</b><span><a class="btn btn-rose"
                                                                              href="{{ route('admin.slider') }}"><i
                                            class="fa fa-plus"></i> Go Back</a></span></h4>

                            <a class="text-center">{{ $slider->title }}</a>
                        </div>
                        <div class="card-header card-header-rose card-header-icon">
                             <form id="RegisterValidation" action="{{ route('admin.updateslide') }}"
                                  enctype="multipart/form-data"
                                  method="POST" novalidate="novalidate">
                                {{ csrf_field() }}
                                <div class="card-body " style="padding-top: 30px;">
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $slider->id }}">
                                        <div class="col-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="siteTitle" class="bmd-label-floating"> Title *</label>
                                                <input type="text" name="title" value="{{ $slider->title }}"
                                                       class="form-control"  required="true">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="siteUrl" class="bmd-label-floating"> Url *</label>
                                                <input type="text" name="url" value="{{ $slider->title }}"
                                                       class="form-control" id="exampleUrl" required="true"
                                                       aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    @if($slider->image == '')
                                                        <img src="{{ asset('admin/img/image_placeholder.jpg') }}" alt="...">
                                                        @else
                                                    <img src="{{ asset('storage/slider') }}/{{ $slider->image }}" alt="...">
                                                        @endif
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="image">
                          </span>
                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group bmd-form-group">
                                                <label for="exampleSubtitle" class="bmd-label-floating">Slider Description *</label>
                                                <textarea name="subtitle" class="form-control" rows="6">{{ $slider->subtitle }}</textarea>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="col-6" style="padding-top: 20px;">
                                            <div class="togglebutton">
                                                <label for="exampleStatus" class="bmd-label-floating"><b>Slider Status</b></label>
                                                <label>
                                                    <input name="status" value="1" type="checkbox" @if($slider->status == '1') checked @endif >
                                                    <span class="toggle"></span>
                                                    <i class="text-warning">( Turn On If you want to active This Slider )</i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <div class="form-check mr-auto">
                                    </div>
                                    <button type="submit" class="btn btn-rose">Save Edit</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">image</i>
                            </div>
                            <h4 class="card-title"><b>Slider</b><span><a class="btn btn-rose"
                                                                         href="{{ route('admin.addslide') }}"><i
                                            class="fa fa-plus"></i> Add Slider</a></span></h4>

                        </div>
                        <div class="card-body " style="padding-top: 30px;">
                            <div class="cf nestable-lists">
                                <div class="dd">
                                    <ol class="dd-list" id="sortable">
                                        @foreach($slider as $slide)

                                            <li class="dd-item" id="{{ $slide->id }}">

                                                <div class="pull-right item_actions action-section ">

                                                    <a href="#viewSlide"
                                                       data-toggle="modal"
                                                       data-id="{{ $slide->id }}"
                                                       data-title="{{ $slide->title }}"
                                                       data-url="{{ $slide->url }}"
                                                       data-subtitle="{{ $slide->subtitle }}"
                                                       data-status="{{ $slide->status }}"
                                                       data-image="{{ $slide->image }}"
                                                       id="view{{ $slide->id }}"
                                                       onClick="view_slide('{{ $slide->id }}')"
                                                       rel="tooltip" title=""
                                                       class="btn btn-success btn-link btn-sm"
                                                       data-original-title="View Slide">
                                                        <i class="material-icons">visibility</i>
                                                    </a>
                                                    <a href="{{ route('admin.editslide',$slide->id) }}" rel="tooltip"
                                                       title=""
                                                       class="btn btn-primary btn-link btn-sm"
                                                       data-original-title="Edit Slide">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <a href="#delete"
                                                       data-toggle="modal"
                                                       data-id="{{ $slide->id }}"
                                                       id="delete{{ $slide->id }}"
                                                       onClick="delete_menu({{ $slide->id }})"
                                                       rel="tooltip" title=""
                                                       class="btn btn-danger btn-link btn-sm"
                                                       data-original-title="Delete Slide">
                                                        <i class="material-icons">close</i>

                                                    </a>
                                                </div>
                                                <span class="dd-handle"><img width="8%" src="{{ asset('storage/slider/thumbs') }}/small_{{ $slide->image }}"> {{ $slide->title }}</span>
                                            </li>
                                        @endforeach

                                    </ol>
                                </div>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div data-notify="container"
                 class="col-11 col-md-4 alert alert-danger  alert-with-icon animated fadeInDown"
                 role="alert" data-notify-position="bottom-right"
                 style="display: inline-block; margin: 15px auto;  position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; bottom: 20px; right: 20px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <i data-notify="icon" class="material-icons">add_alert</i><span
                    data-notify="title"></span> <span data-notify="message">
            Sorry !!! <br> {{ $error }}
        </span><a href="#" target="_blank" data-notify="url"></a>
            </div>
        @endforeach
    @endif
    @if (session('status'))
        <div data-notify="container" class="col-11 col-md-4 alert alert-success alert-with-icon animated fadeInDown" role="alert" data-notify-position="bottom-right" style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; bottom: 20px; right: 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
            </button>
            <i data-notify="icon" class="material-icons">add_alert</i><span data-notify="title"></span> <span data-notify="message">
           Success!! <br> {{ session('status') }}
        </span><a href="#" target="_blank" data-notify="url"></a>
        </div>
    @endif
    <!-- delete modal -->
    <div class="modal fade modal-mini modal-danger" id="delete" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-small">
            <div class="modal-content model-danger">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="material-icons">clear</i></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-link" data-dismiss="modal">No</button>
                    <a href="#" class="btn btn-success btn-link">Yes
                        <div class="ripple-container"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--    end small modal -->
    <!-- view modal -->
    <div class="modal fade" id="viewSlide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-notice">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Slider Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="instruction">
                        <p><img id="viewImage" src="" alt="Slider Image" class="img-thumbnail"></p>
                        <p><strong>Title : </strong><span id="viewTitle"></span></p>
                        <p><strong>Url : </strong><span id="viewUrl"></span></p>
                        <p><strong>Status : </strong><span id="Status"></span></p>
                        <p><strong>Subtitle : </strong><span id="viewSubtitle"></span></p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end view modal -->
    <script>
        function view_slide(id) {
            var title = $('#view' + id).attr('data-title');
            var url = $('#view' + id).attr('data-url');
            var subtitle = $('#view' + id).attr('data-subtitle');
            var image = $('#view' + id).attr('data-image');
            var status = $('#view' + id).attr('data-status');
            if (status == 1) {
                $('#Status').html("Active");
            } else {
                $('#Status').html("Inactive");
            }

            $('#viewId').val(id);
            $('#viewTitle').html(title);
            $('#viewUrl').html(url);
            $('#viewSubtitle').html(subtitle);
            $('#viewImage').attr('src',"{{ asset('storage/slider') }}/"+image);

        }

        function delete_menu(id) {
            var conn = './slider/delete/' + id;
            $('#delete a').attr("href", conn);
        }
    </script>
@endsection
