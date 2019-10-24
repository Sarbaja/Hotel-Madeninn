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
@section ('title', 'Booked Mails')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">Booked Emails</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                        </div>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                   cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Customer Name</th>
                                    <th>Check In Date</th>
                                    <th>Check Out Date</th>
                                    <th>Total Price</th>
                                    <th>Order Status</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>SN</th>
                                    <th>Customer Name</th>
                                    <th>Check In Date</th>
                                    <th>Check Out Date</th>
                                    <th>Total Price</th>
                                    <th>Order Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($bookall as $book)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td> {{ $book->customer_name }}</td>
                                        <td>{{ $book->check_in_date }}</td>
                                        <td>{{ $book->check_out_date }}</td>
                                        <td>${{ $book->total_price }}</td>
                                        <td>
                                            @if($book->status == 0)
                                                <button class="btn-primary btn-round btn">pending</button>
                                            @elseif($book->status == 1)
                                                <button class="btn-success btn-round btn">Delivered</button>
                                            @else
                                                <button class="btn-danger btn-round btn">Cancelled</button>
                                            @endif
                                        </td>
                                        <td class="text-right">

                                            <a href="{{ url('/admin/viewbookmail') }}/{{ $book->id }}"
                                               class="btn btn-link btn-warning btn-just-icon remove"><i
                                                    title="View Book" class="fa fa-eye"></i> </a>
                                        </td>


                                    </tr>
                                    @php
                                        $count ++;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

