<?php
/**
 * Created by PhpStorm.
 * Project Title: nepalagora
 * Author Name: Subas Nyaupane
 * Author Email: subas.nyaupane143@gmail.com
 * Author Url : https://subasnyaupane.github.io/
 * Date: 21/Jan/2019
 */
?>
@extends('admin.layouts.headerfooter')
@section ('title', 'Users')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">persons</i>
                        </div>
                        <h4 class="card-title"><b>User Team</b></h4>
                    </div>
                    <div class="card-body ">

                        <div class="cf nestable-lists">
                            <div class="dd">
                                <ol class="dd-list" id="sortable">
                                    @foreach($users as $users)

                                        <li class="dd-item" id="{{ $users->id }}">

                                            <div class="pull-right item_actions action-section ">

                                                <a href="#viewUsers"
                                                   data-toggle="modal"
                                                   data-id="{{ $users->id }}"
                                                   data-name="{{ $users->name }}"
                                                   data-email="{{ $users->email }}"
                                                   data-status="{{ $users->status }}"
                                                   data-role="{{ $users->role }}"
                                                   id="view{{ $users->id }}"
                                                   onClick="view_users('{{ $users->id }}')"
                                                   rel="tooltip" title=""
                                                   class="btn btn-success btn-link btn-sm"
                                                   data-original-title="View User">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a href="updateuser/{{ $users->id }}" rel="tooltip" title=""
                                                        class="btn btn-primary btn-link btn-sm"
                                                        data-original-title="Edit User">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                @if(Auth::user()->id != $users->id )
                                                    <a href="#delete"
                                                       data-toggle="modal"
                                                       data-id="{{ $users->id }}"
                                                       id="delete{{ $users->id }}"
                                                       onClick="delete_menu({{ $users->id }})"
                                                       rel="tooltip" title=""
                                                       class="btn btn-danger btn-link btn-sm"
                                                       data-original-title="Delete User">
                                                        <i class="material-icons">close</i>

                                                    </a>
                                                @endif
                                            </div>
                                            <span class="dd-handle">@if(Auth::user()->id == $users->id ) <i
                                                    rel="tooltip" title="" data-original-title="Online"
                                                    style="color: #5bb35f;" class="fa fa-circle"
                                                    aria-hidden="true"></i> @endif {{ $users->name }}</span>
                                        </li>
                                    @endforeach

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function view_users(id) {
            var name = $('#view' + id).attr('data-name');
            var email = $('#view' + id).attr('data-email');
            var status = $('#view' + id).attr('data-status');
            var role = $('#view' + id).attr('data-role');
            if (status == 1) {
                $('#Status').html("Active");
            } else {
                $('#Status').html("Inactive");
            }
            if (role == 1) {
                $('#Role').html("Admin User");
            } else {
                $('#Role').html("Normal User");
            }
            $('#viewId').val(id);
            $('#viewName').html(name);
            $('#viewEmail').html(email);

        }

        function delete_menu(id) {
            var conn = './users/delete/' + id;
            $('#delete a').attr("href", conn);
        }
    </script>
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
    <div class="modal fade" id="viewUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-notice">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="instruction">
                        <p><strong>Name : </strong><span id="viewName"></span></p>
                        <p><strong>Email : </strong><span id="viewEmail"></span></p>
                        <p><strong>Status : </strong><span id="Status"></span></p>
                        <p><strong>Role : </strong><span id="Role"></span></p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end view modal -->
    @if (session('status'))
        <div data-notify="container"
             class="col-11 col-md-4 alert alert-success alert-with-icon animated fadeInDown"
             role="alert" data-notify-position="bottom-right"
             style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; bottom: 20px; right: 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
            </button>
            <i data-notify="icon" class="material-icons">add_alert</i><span data-notify="title"></span>
            <span data-notify="message">
           {{ session('status') }}
        </span><a href="#" target="_blank" data-notify="url"></a>
        </div>
    @endif
@endsection
