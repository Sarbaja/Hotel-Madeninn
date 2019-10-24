<?php
/**
 * Created by PhpStorm.
 * Project Title: nepalagora
 * Author Name: Subas Nyaupane
 * Author Email: subas.nyaupane143@gmail.com
 * Author Url : https://subasnyaupane.github.io/
 * Date: 25/Jan/2019
 */
?>
@extends('admin.layouts.headerfooter')
@section ('title', 'Update User')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <h4 class="card-title">Edit User</h4>
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


                    <form method="POST" action="{{ route('admin.updateuser') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="card-body ">
                            <div class="form-group bmd-form-group">
                                <label for="exampleName" class="bmd-label-floating"> Full Name *</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="exampleName" required="true"
                                       aria-required="true">
                            </div>
                            <div class="form-group bmd-form-group">
                                <label for="exampleEmail" class="bmd-label-floating"> Email Address *</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleEmail" required="true"
                                       aria-required="true">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group bmd-form-group">
                                        <div class="dropdown bootstrap-select show-tick"><select name="role" value="{{ $user->role }}"
                                                                                                 class="selectpicker"
                                                                                                 data-style="select-with-transition"
                                                                                                 title="Choose Role">
                                                <option value="1" @if($user->role == '1') selected @endif >Admin User</option>
                                                <option value="0" @if($user->role == '0') selected @endif>Normal User</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" style="padding-top: 20px;">
                                    <div class="togglebutton">
                                        <label for="exampleStatus" class="bmd-label-floating"><b>User Status</b></label>
                                        <label>
                                            <input name="status" value="1" @if($user->status == '1') checked @endif type="checkbox">
                                            <span class="toggle" ></span>
                                            <i class="text-warning">( Turn On If you want to active This User )</i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="category form-category text-right ">* Required fields</div>
                        </div>
                        <div class="card-footer text-right">
                            <div class="form-check mr-auto">
                            </div>
                            <button type="submit" class="btn btn-rose">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

