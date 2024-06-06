


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0') }}">
    <title>Hotel Dashboard Template</title>
    <link rel="shortcut icon" type="{{ asset('new_admin/image/x-icon" href="new_admin/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/feathericon.min.css') }}">
    <link rel="stylehseet" href="{{ asset('new_admin/https://cdn.oesmith.co.uk/morris-0.5.1.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
</head>

<body>


    <!-- heading -->
    @include('admin.header')
    <!-- end heading -->

    <!-- leftbar -->
    @include('admin.leftbar')
    <!-- end leftbar -->


    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">


                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Cars</h4> <a href="{{ url('addcar') }}"
                            class="btn btn-primary float-right veiwbutton" data-toggle="modal" data-target="#add_car"><i class="fa fa-plus"></i>Add Cars</a>
                        </div>
                    </div>
                    @include('admincar.addcar')
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body booking_card">
                            <div class="table-responsive">
                                <table class="datatable table table-striped table table-hover table-center table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Carname</th>
                                            <th>Rent Fee Per Day</th>
                                            <th>Carmodel</th>
                                            <th>Car Seats</th>
                                            <th>CarHistory</th>
                                            <th>FuelType</th>
                                            <th>Cartype</th>
                                            <th>Car Image</th>
                                            <th>Car Status</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data as $car)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $car->carname }}</td>
                                                <td>{{ $car->carprice }}</td>
                                                <td>{{ $car->carmodel }}</td>
                                                <td>{{ $car->carseats }}</td>
                                                <td>{{ $car->carhistory }}</td>
                                                <td>{{ $car->fueltype }}</td>
                                                <td>{{ $car->cartype }}</td>
                                                <td>
                                                    <img src="{{ asset('/uploads/car/' . $car->image) }}"
                                                        alt="image" width="80px" height="80px">
                                                <td>
                                                    @if ($car->status == 'notavailable')
                                                        <span class="btn btn-sm bg-danger-light mr-2 badge">Disable</span>
                                                    @elseif($car->status == 'available')
                                                        <span class="btn btn-sm bg-success-light mr-2 badge">Enable</span>
                                                    @endif
                                                </td>

                                                <td class="text-right">
                                                        <div>
                                                            <a href="{{ url('editing/' . $car->id) }}" data-toggle="modal"
                                                                data-target="#edit_car{{ $car->id }}" style="color:blue"><i
                                                                    class="fa-solid fa-pen-to-square"></i></a>

                                                                    {{--  view  history --}}
                                                                    <a href="#" data-toggle="modal" style="color:green"
                                                                    data-target="#viewHistoryAll{{ $car->id }}"><i
                                                                    class="fas fa-eye m-r-5" title="View History"></i></a>
                                                                </div>

                                                                @include('admin.bookings.car-history')
                                                            </div>



                                                    {{-- Modal View History --}}
                                                    @include('admincar.edit')
                                                </td>
                                                        <td><a href="{{ url('enablecar', $car->id) }}"
                                                            class="btn btn-success btn-sm" onclick=" return confirm ('Do you want to enable this car')" style="padding: 5px 10px; font-size: 12px;">Enable</a></td>
                                                    <td><a href="{{ url('disablecar', $car->id) }}"
                                                        class="btn btn-danger btn-sm" onclick=" return confirm ('Do you want to disable this car')" style="padding: 5px 10px; font-size: 12px;">Disable</a></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="clearfix">
                                                    <hr>
                                                {{$data->links()}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

</body>
<script data-cfasync="false"
    src="{{ asset('new_admin/../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
<script src="{{ asset('new_admin/assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('new_admin/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('new_admin/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('new_admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('new_admin/assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('new_admin/assets/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('new_admin/assets/js/chart.morris.js') }}"></script>
<script src="{{ asset('new_admin/assets/js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>
