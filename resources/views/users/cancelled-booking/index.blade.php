@extends('layouts.rentcar')
<style>
    body {
        color: #566787;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
        font-size: 13px;
    }

    .table-responsive {
        margin: 30px 0;
    }

    .table-wrapper {
        width: 100%;
        background: #fff;
        padding: 20px 25px;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .table-wrapper .btn {
        float: right;
        color: #333;
        background-color: #fff;
        border-radius: 3px;
        border: none;
        outline: none !important;
        margin-left: 10px;
    }

    .table-wrapper .btn:hover {
        color: #333;
        background: #f2f2f2;
    }

    .table-wrapper .btn.btn-primary {
        color: #fff;
        background: #03A9F4;
    }

    .table-wrapper .btn.btn-primary:hover {
        background: #03a3e7;
    }

    .table-title .btn {
        font-size: 13px;
        border: none;
    }

    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }

    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }

    .table-title {
        color: #fff;
        background: #4b5366;
        padding: 16px 25px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }

    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }

    .show-entries select.form-control {
        width: 60px;
        margin: 0 5px;
    }

    .table-filter .filter-group {
        float: right;
        margin-left: 15px;
    }

    .table-filter input,
    .table-filter select {
        height: 34px;
        border-radius: 3px;
        border-color: #ddd;
        box-shadow: none;
    }

    .table-filter {
        padding: 5px 0 15px;
        border-bottom: 1px solid #e9e9e9;
        margin-bottom: 5px;
    }

    .table-filter .btn {
        height: 34px;
    }

    .table-filter label {
        font-weight: normal;
        margin-left: 10px;
    }

    .table-filter select,
    .table-filter input {
        display: inline-block;
        margin-left: 5px;
    }

    .table-filter input {
        width: 200px;
        display: inline-block;
    }

    .filter-group select.form-control {
        width: 110px;
    }

    .filter-icon {
        float: right;
        margin-top: 7px;
    }

    .filter-icon i {
        font-size: 18px;
        opacity: 0.7;
    }

    table.table tr th,
    table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }

    table.table tr th:first-child {
        width: 60px;
    }

    table.table tr th:last-child {
        width: 80px;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }

    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }

    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }

    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }

    table.table td a:hover {
        color: #2196F3;
    }

    table.table td a.view {
        width: 30px;
        height: 30px;
        color: #2196F3;
        border: 2px solid;
        border-radius: 30px;
        text-align: center;
    }

    table.table td a.view i {
        font-size: 22px;
        margin: 2px 0 0 1px;
    }

    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }

    .status {
        font-size: 30px;
        margin: 2px 2px 0 0;
        display: inline-block;
        vertical-align: middle;
        line-height: 10px;
    }

    .text-success {
        color: #10c469;
    }

    .text-info {
        color: #62c9e8;
    }

    .text-warning {
        color: #FFC107;
    }

    .text-danger {
        color: #ff5b5b;
    }

    .pagination {
        float: right;
        margin: 0 0 5px;
    }

    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }

    .pagination li a:hover {
        color: #666;
    }

    .pagination li.active a {
        background: #03A9F4;
    }

    .pagination li.active a:hover {
        background: #0397d6;
    }

    .pagination li.disabled i {
        color: #ccc;
    }

    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }

    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;


    }
</style>
@section('title', 'Car Listing')

@section('content')
    <br>

    <section>
        <div class="container" style="width: 90%">
            <div class="table-responsive">
                <div class="table-wrapper" style="background-color:whitesmoke;">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-4">
                                <h2 style="color: white;">Booking Details</h2>
                            </div>
                        </div>
                    </div>
                    <div class="table-filter">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="show-entries">
                                    <p>With Driver</p>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Car Name</th>
                                    <th>Pickup Date</th>
                                    <th>Dropoff Date</th>
                                    <th>Car Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            @foreach ($data as $key => $bk)
                                <tbody>
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><a href="#"><img
                                                    src="{{ asset('../uploads/car/' . $bk->admincar->image) }} "
                                                    width="45px" height="45px" class="avatar"
                                                    alt="Avatar">{{ $bk->admincar->carname }}</a></td>
                                        <td>{{ $bk->pickupdate }}</td>
                                        <td>{{ $bk->dropoffdate }}</td>
                                        <td>{{ $bk->admincar->carprice }}/day</td>
                                        <td><span class="status text-success">&bull;</span>{{ $bk->status }}</td>
                                        <td><a href="{{ url('viewdriverbooking/' . $bk->id) }}" class="view"
                                                title="View Details" data-toggle="modal"
                                                data-target="#modal1_{{ $bk->id }}"><i
                                                    class="material-icons">&#xE5C8;</i></a></td>
													@include('modal.bookingDetails')
													@include('modal.cancel-booking')
                                    </tr>
                                    
                            @endforeach
                            </tbody>
                        </table>
                        <div class="clearfix">

                            {{ $data->links() }}
                        </div>

                        <br>

                        {{-- selfdrive --}}
                        <div class="table-filter">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="show-entries">
                                        <p>Self Drive</p>
                                    </div>
                                </div>

                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Car Name</th>
                                            <th>Pickup Date</th>
                                            <th>Dropoff Date</th>
                                            <th>Car Price</th>
                                            <th>License</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @foreach ($selfdrive as $key => $bk)
                                        <tbody>
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td><a href="#"><img
                                                            src="{{ asset('../uploads/car/' . $bk->admincar->image) }} "
                                                            width="45px" height="45px" class="avatar"
                                                            alt="Avatar">{{ $bk->admincar->carname }}</a></td>
                                                <td>{{ $bk->pickupdate }}</td>
                                                <td>{{ $bk->dropoffdate }}</td>
                                                <td>{{ $bk->admincar->carprice }}/day</td>
                                                <td>{{ $bk->license }}</td>
                                                <td><span class="status text-success">&bull;</span>{{ $bk->status }}</td>
                                                <td><a href="{{ url('viewselfbooking/' . $bk->id) }}" class="view"
                                                        title="View Details" data-toggle="modal"
                                                        data-target="#modal_{{ $bk->id }}"><i
                                                            class="material-icons">&#xE5C8;</i></a></td>
															@include('modal.viewselfbooking')
															@include('modal.cancel-booking-self-drive')
                                            </tr>
                                            
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="clearfix">

                                    {{ $selfdrive->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

			

    </section>
@endsection
