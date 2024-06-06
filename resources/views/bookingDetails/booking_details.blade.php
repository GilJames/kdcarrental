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

    a:hover i.fas.fa-eye {
        color: red;
    }

    a i.fas.fa-eye {
        color: blue;
        transition: color 0.3s;
    }

    a:hover i.fa-solid.fa-comments {
        color: red;
    }

    a i.fa-solid.fa-comments {
        color: green;
        transition: color 0.3s;
    }

    a:hover i.fa-solid.fa-xmark {
        color: red;
    }

    a i.fa-solid.fa-xmark {
        color: red;
        transition: color 0.3s;
    }

    a:hover i.fa-solid.fa-xmark {
        color: red;
    }

    a i.fa-solid.fa-xmark {
        color: red;
        transition: color 0.3s;
    }

    a:hover i.fa-solid.fa-pen-to-square {
        color: red;
    }

    a i.fa-solid.fa-pen-to-square {
        color: orange;
        transition: color 0.3s;
    }

    /* For small devices (phones, 576px and up) */
    @media (min-width: 576px) {
        .table-title h2 {
            font-size: 20px;
            /* Decrease font size */
        }
    }

    /* For medium devices (tablets, 768px and up) */
    @media (min-width: 768px) {
        .table-title {
            padding: 12px 20px;
            /* Adjust padding */
        }
    }

    /* For large devices (desktops, 992px and up) */
    @media (min-width: 992px) {
        .table-wrapper {
            padding: 30px;
            /* Increase padding */
        }
    }

    /* For extra large devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) {
        .table-filter {
            margin-bottom: 20px;
            /* Adjust margin */
        }
    }

    th,
    td {
        font-size: 14px;
        /* Default font size */
    }



    /* Media query for screens smaller than 768px */
    @media screen and (max-width: 768px) {

        th,
        td {
            font-size: 12px;
            /* Adjusted font size for smaller screens */
        }

        .emailSize {
            font-size: 40% !important;
        }

        .imgTable {
            width: 100%;
            /* Ensure image width covers the container */
            border-radius: 50%;
            /* Maintain the image border as a circle */

        }
    }
</style>

@section('title', 'Car Listing')

@section('content')
    <section style="margin-top: 30px;">


        <div class="container-fluid">
            <div style="background-color: #333; ">
                <h4 style="color: whitesmoke; padding: 1%">Booking Details</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover  withtable">
                    <thead>
                        <tr>
                            <th colspan="8">With Driver</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Car Name</th>
                            <th>Pickup Date</th>
                            <th>Dropoff Date</th>
                            <th>Car Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        @if (count($data) > 0)
                            @foreach ($data as $key => $bk)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="#"><img src="{{ asset('../uploads/car/' . $bk->admincar->image) }}"
                                                width="45px" height="45px" class="avatar imgTable" alt="Avatar"></a>
                                    </td>
                                    <td><span>{{ $bk->carname }}</span></td>
                                    <td>{{ $bk->pickupdate }}</td>
                                    <td>{{ $bk->dropoffdate }}</td>
                                    <td>{{ $bk->carprice }}/day</td>
                                    <td>
                                        @if ($bk->status == 'confirm')
                                            <span style="font-weight: bold; color: green;">Confirmed</span>
                                        @elseif($bk->status == 'reject')
                                            <span style="font-weight: bold; color: red;">Reject</span>
                                        @elseif($bk->status == 'completed')
                                            <span style="font-weight: bold; color: blue;">Completed</span>
                                        @elseif($bk->status == 'cancelled')
                                            <span style="font-weight: bold; color: red;">Cancelled</span>
                                        @elseif($bk->status == 'pending')
                                            <span style="font-weight: bold; color: red;">Pending</span>
                                        @elseif($bk->status == 'To_pay')
                                            <span style="font-weight: bold; color: orange;">To Pay</span>
                                        @endif
                                    </td>
                                    <td style="display: flex;">
                                        <a href="#" title="View Details" data-toggle="modal"
                                            onclick="checkCarsBasedOnInputValue('#modal1_{{ $bk->id }}{{ $key }}',{{ $bk->id }}, {{ $key }}, 'withdrive')"
                                            data-target="#modal1_{{ $bk->id }}{{ $key }}">
                                            <i class="fas fa-eye"
                                                style="font-size: 16px; transition: color 0.3s; margin-right: 5px;"></i>
                                        </a>
                                        @if ($bk->status == 'completed' && $bk->lastrate === null)
                                            <a href="#" title="Write Your Reviews" data-toggle="modal"
                                                data-target="#ModalCreate_{{ $bk->id }}{{ $key }}">
                                                <i class="fa-solid fa-comments"
                                                    style="font-size: 16px; transition: color 0.3s; margin-right: 5px;"></i>
                                            </a>
                                        @elseif ($bk->status == 'pending')
                                            <a href="#" title="Cancel Booking" data-toggle="modal"
                                                data-target="#cancelModal_{{ $bk->id }}">
                                                <i class="fa-solid fa-xmark"
                                                    style="font-size: 16px; transition: color 0.3s; margin-right: 5px;"></i>
                                            </a>
                                            <a href="{{ url('editdriverbooking/' . $bk->id) }}" title="Edit Booking">
                                                <i class="fa-solid fa-pen-to-square"
                                                    style="font-size: 16px; transition: color 0.3s; margin-right: 5px;"></i>
                                            </a>
                                        @endif
                                    </td>
                                    @include('modal.bookingDetails')
                                </tr>
                                @include('modal.cancel-booking')
                                @include('modal.ratingform')
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center text-danger">No data found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="clearfix">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table table-striped table-hover selftable">
                    <thead>
                        <tr>
                            <th colspan="9">Self Drive</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Car Name</th>
                            <th>Pickup Date</th>
                            <th>Dropoff Date</th>
                            <th>Car Price</th>
                            <th>License</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($selfdrive) > 0)
                            @foreach ($selfdrive as $key => $bk)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="#"><img src="{{ asset('../uploads/car/' . $bk->admincar->image) }} "
                                                width="45px" height="45px" class="avatar imgTable" alt="Avatar">
                                        </a>
                                    </td>
                                    <td>
                                        <span>{{ $bk->carname }}</span>
                                    </td>
                                    <td>{{ $bk->pickupdate }}</td>
                                    <td>{{ $bk->dropoffdate }}</td>
                                    <td>{{ $bk->carprice }}/day</td>
                                    <td>{{ $bk->license }}</td>
                                    <td>
                                        @if ($bk->status == 'confirm')
                                            <span style="font-weight: bold; color: green;">Confirmed</span>
                                        @elseif($bk->status == 'reject')
                                            <span style="font-weight: bold; color: red;">Reject</span>
                                        @elseif($bk->status == 'completed')
                                            <span style="font-weight: bold; color: blue;">Completed</span>
                                        @elseif($bk->status == 'cancelled')
                                            <span style="font-weight: bold; color: red;">Cancelled</span>
                                        @elseif($bk->status == 'pending')
                                            <span style="font-weight: bold; color: red;">Pending</span>
                                        @elseif($bk->status == 'To_pay')
                                            <span style="font-weight: bold; color: orange;">To Pay</span>
                                        @endif
                                    </td>
                                    <td style="display: flex;">
                                        <a href="#"
                                            onclick="checkCarsBasedOnInputValueSelf('#modalself{{ $bk->id }}{{ $key }}',{{ $bk->id }}, {{ $key }}, 'selfdrive')"
                                            title="View Details" data-toggle="modal"
                                            data-target="#modalself{{ $bk->id }}{{ $key }}">
                                            <i class="fas fa-eye"
                                                style="font-size: 16px; transition: color 0.3s; margin-right: 5px;"></i>
                                        </a>
                                        @if ($bk->status == 'completed' && $bk->lastrate === null)
                                            <a href="#" title="Write Your Reviews" data-toggle="modal"
                                                data-target="#ModalCreate_Self{{ $bk->id }}{{ $key }}"><i
                                                    class="fa-solid fa-comments"
                                                    style="font-size: 16px; transition: color 0.3s; margin-right: 5px;"></i></a>
                                        @elseif ($bk->status == 'pending')
                                            <a href="#" title="Cancel Booking" data-toggle="modal"
                                                data-target="#cancelModal_self_{{ $bk->id }}">
                                                <i class="fa-solid fa-xmark"
                                                    style="font-size: 16px; transition: color 0.3s; margin-right: 5px;"></i>
                                            </a>
                                            <a href="{{ url('editselfbooking/' . $bk->id) }}" title="Edit Booking">
                                                <i class="fa-solid fa-pen-to-square"
                                                    style="font-size: 16px; transition: color 0.3s; margin-right: 5px;"></i>
                                            </a>
                                        @endif
                                    </td>
                                    @include('modal.viewselfbooking')
                                </tr>
                                @include('modal.cancel-booking-self-drive')
                                @include('modal.selfmodalratingform')
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center text-danger">No data found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="clearfix">
                    {{ $selfdrive->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
