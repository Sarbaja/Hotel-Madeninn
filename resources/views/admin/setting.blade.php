<?php
/**
 * Created by PhpStorm.
 * Project Title: nepalagora
 * Author Name: Subas Nyaupane
 * Author Email: subas.nyaupane143@gmail.com
 * Author Url : https://subasnyaupane.github.io/
 * Date: 17/Jan/2019
 */
?>
@extends('admin.layouts.headerfooter')
@section ('title', 'Setting')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong>There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="RegisterValidation" action="{{ route('admin.setting') }}" enctype="multipart/form-data"
                      method="POST" novalidate="novalidate">
                    {{ csrf_field() }}
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                Site Setting
                            </div>
                        </div>
                        <div class="card-body " style="padding-top: 30px;">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="siteTitle" class="bmd-label-floating"> Site Title *</label>
                                        <input type="text" name="sitetitle" value="{{ $setting->sitetitle }}"
                                               class="form-control" id="exampleTitle" required="true"
                                               aria-required="true">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="fileinput-new thumbnail ">
                                                    <img src="{{ asset('storage/setting') }}/{{ $setting->logo }}"
                                                         alt="Logo">
                                                </div>
                                                <div
                                                    class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                            </div>

                                            <div class="col-6">
                          <span class="btn btn-round btn-rose btn-file">
                            <span class="fileinput-new">Add Logo</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="logo">
                          </span>
                                                <br>
                                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                   data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="exampleEmail" class="bmd-label-floating">Site Email *</label>
                                        <input type="email" name="siteemail" value="{{ $setting->siteemail }}"
                                               class="form-control" id="exampleEmail" required="true"
                                               aria-required="true">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="exampleAddress" class="bmd-label-floating">Address *</label>
                                        <input type="text" name="address" value="{{ $setting->address }}"
                                               class="form-control" id="exampleAddress" required="true"
                                               aria-required="true">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="examplePhone" class="bmd-label-floating">Phone *</label>
                                        <input type="text" name="phone" value="{{ $setting->phone }}"
                                               class="form-control" id="examplephone" required="true"
                                               aria-required="true">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="exampleMobile" class="bmd-label-floating">Mobile *</label>
                                        <input type="text" name="mobile" value="{{ $setting->mobile }}"
                                               class="form-control" id="exampleMobile" required="true"
                                               aria-required="true">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="exampleFax" class="bmd-label-floating">FAX *</label>
                                        <input type="text" name="fax" value="{{ $setting->fax }}"
                                               class="form-control" id="exampleFax" required="true"
                                               aria-required="true">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="exampleFacebookurl" class="bmd-label-floating">Facebook Url
                                            *</label>
                                        <input type="text" name="facebookurl" value="{{ $setting->facebookurl }}"
                                               class="form-control" id="exampleFacebookurl" required="true"
                                               aria-required="true">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="exampleTwitterurl" class="bmd-label-floating">Twitter Url *</label>
                                        <input type="text" name="twitterurl" value="{{ $setting->twitterurl }}"
                                               class="form-control" id="exampleTwitterurl" required="true"
                                               aria-required="true">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="exampleGoogleplusurl" class="bmd-label-floating">Google Plus Url
                                            *</label>
                                        <input type="text" name="googleplusurl" value="{{ $setting->googleplusurl }}"
                                               class="form-control" id="exampleGoogleplusurl" required="true"
                                               aria-required="true">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="exampleLinkedinurl" class="bmd-label-floating">Linkedin Url
                                            *</label>
                                        <input type="text" name="linkedinurl" value="{{ $setting->linkedinurl }}"
                                               class="form-control" id="exampleLinkedinurl" required="true"
                                               aria-required="true">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="exampleInstagramurl" class="bmd-label-floating">Instagram Url
                                            *</label>
                                        <input type="text" name="instagramurl" value="{{ $setting->instagramurl }}"
                                               class="form-control" id="exampleInstagramurl" required="true"
                                               aria-required="true">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="exampleSitekeyword" class="bmd-label-floating">Welcome Message
                                            *</label>
                                        <textarea name="sitekeyword" class="form-control"
                                                  rows="4">{{ $setting->sitekeyword }}</textarea>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="exampleInstagramurl" class="bmd-label-floating">Slider Video Url
                                            *</label>
                                        <div class="row">
                                            <div class="col-md-6" style="padding-right: 0;max-width: 45%;">
                                                <input type="text" value="https://www.youtube.com/embed/"
                                                       disabled="true" class="form-control">
                                            </div>
                                            <div class="col-md-6" style="padding-left: 0;">
                                                <input type="text" name="youtubevideourl"
                                                       value="{{ $setting->youtubevideourl }}"
                                                       class="form-control" id="exampleyoutubevideourl"
                                                       aria-required="true">
                                            </div>
                                        </div>
                                        <p class="text-warning"><i>Copy youtube video link After v= and paste </i></p>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <div class="form-check mr-auto">
                                <label class="form-check-label warning">
                                    <i style="color: #a5dc86;"></i>
                                </label>
                            </div>
                            <button type="submit" value="submit" class="btn btn-rose">Update</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @if (session('status'))
        <div data-notify="container" class="col-11 col-md-4 alert alert-success alert-with-icon animated fadeInDown"
             role="alert" data-notify-position="bottom-right"
             style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; bottom: 20px; right: 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
            </button>
            <i data-notify="icon" class="material-icons">add_alert</i><span data-notify="title"></span> <span
                data-notify="message">
           Success!! <br> {{ session('status') }}
        </span><a href="#" target="_blank" data-notify="url"></a>
        </div>
    @endif
@endsection
