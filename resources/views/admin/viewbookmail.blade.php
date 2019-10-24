<?php
/**
 * Created by PhpStorm.
 * Project Title: hotelmadeninn
 * Author Name: Subas Nyaupane
 * Author Email: subas.nyaupane143@gmail.com
 * Author Url : https://subasnyaupane.github.io/
 * Date: 03/Apr/2019
 */
?>
@extends('admin.layouts.headerfooter')
@section ('title', $book->customer_name)
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">Customer Name : {{ $book->customer_name }}</h4>
                        <form method="post" action="{{ url('admin/changestatus') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $book->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1></h1>
                                </div>

                                <div class="col-md-4">
                                    <select class="selectpicker" name="status" data-size="7" data-style="btn
                                @if($book->status == 0)
                                        btn-primary
@elseif($book->status == 1)
                                        btn-success
@else
                                        btn-danger
@endif
                                        btn-round" title="Order Status">
                                        <option @if($book->status == 0) selected disabled @endif value="0">
                                            Pending
                                        </option>
                                        <option @if($book->status == 1) selected disabled @endif  value="1">
                                            Delivered
                                        </option>
                                        <option @if($book->status == 2) selected disabled @endif  value="2">
                                            Cancelled
                                        </option>

                                    </select>

                                </div>
                                <div class="col-md-2 ">
                                    <span style="float: left"><button class="btn btn-primary btn-round "
                                                                      type="submit"><i class="fa fa-refresh"
                                                                                       aria-hidden="true"></i></button> </span>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                        </div>
                        <div class="col-md-12">
                            <p>Check In Date : {{ $book->check_in_date }}</p>
                            <p>Check Out Date : {{ $book->check_out_date }}</p>
                            @php
                                $rooms = DB::table('tbl_rooms')->where('id', $book->room_id)->first();
                            @endphp
                            @if($rooms)
                                <p>Room Title : {{ $rooms->title }}</p>
                            @else
                                <div class="alert alert-danger" role="alert">
                                    Sorry This Room has deleted.
                                </div>
                            @endif
                            <p>Total Price : ${{ $book->total_price }}</p>
                            <p>Customer Name : {{ $book->customer_name }}</p>
                            <p>Email : {{ $book->email }}</p>
                            <p>Contact : {{ $book->contact }}</p>
                            <p>City : {{ $book->city }}</p>
                            <p>Country : {{ $book->country }}</p>
                            <p>Card Name : {{ $book->card_name }}</p>
                            <p>Card Number : {{ $book->card_number }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
