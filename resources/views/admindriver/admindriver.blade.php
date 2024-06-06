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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/style.css') }}"> </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

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


                                <div class="mt-5">
                                    <h4 class="card-title float-left mt-2">Driver's List</h4> <a href="{{url('addriver')}}" class="btn btn-primary float-right veiwbutton"
                                    data-toggle="modal" data-target="#add_driver">Add Drivers</a> </div>
                            </div>

                                @include('admindriver.addriver')
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
                                                <th>Profile</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Experience</th>
                                                <th>Contact Number</th>
                                                <th>License Number</th>
                                                <th>Driver Status</th>
                                                <th>Action</th>

												<th class="text-right"></th>
											</tr>
										</thead>
										<tbody>
                                            @php
                                                $i =1;
                                            @endphp
                                            @foreach($admindriver as $dv)
											<tr>
                                                <td>{{$i++}}</td>
                                                <td> <img src="{{ asset('/uploads/drivers/' . $dv->profile) }}" alt="image" width="80px" height="80px"></td>
                                                <td>{{$dv->name}}</td>
                                                <td>{{$dv->address}}</td>
                                                <td>{{$dv->yearsofexperience}}</td>
                                                <td>{{$dv->number}}</td>
                                                <td>{{$dv->license}}</td>
                                                <td>
                                                    @if($dv->statusdriver == 'available')
                                                    <span class="btn btn-sm bg-success-light mr-2">Available</span>

                                                    @elseif($dv->statusdriver == 'notavailable')

                                                    <span class="btn btn-sm bg-danger-light mr-2">Not Available</span>

                                                    @endif
                                                </td>
                                                <td>
                                                    <div>
                                                        <a class="Manage Driver" title="Edit" data-toggle="modal" data-target="#edit_driver{{ $dv->id }}"><i class="fa-solid fa-pen-to-square" style="color:blue"></i></a>
                                                        <a class="delete" title="Delete" href="{{url('deleteadmin/'.$dv->id)}}" data-toggle="modal" data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5" style="color:red"></i></a>
                                                    </div>

                                                    <div id="delete_asset" class="modal fade delete-modal" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-body text-center"> <img src="new_admin/assets/img/sent.png" alt="" width="50" height="46">
                                                                                        <h3 class="delete_class">Are you sure want to delete this Asset?</h3>
                                                                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                                                        <a href="{{url('deleteadmin/'.$dv->id)}}"><button type="submit" class="btn btn-danger">Delete</button></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
									        </tr>
                                            @include('admindriver.editdriver')
                                            @endforeach

										</tbody>
									</table>
                                    <div class="clearfix">
                                            <hr>
                                        {{$admindriver->links()}}
								    </div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

</body>
@if(Session::has('message'))
<script>
    swal({
        title: "Congrats",
        text: "{{ Session::get('message') }}",
        icon: 'success',
        buttons: {
            ok: {
                text: 'OK',
                value: 'ok',
            },
        },
        closeOnClickOutside: false,
        closeOnEsc: true,
    }).then((value) => {
        if (value === 'ok') {
            window.location.href = "{{url('admindriver')}}";
        }
    });
</script>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script data-cfasync="false" src="{{ asset('new_admin/../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
	<script src="{{ asset('new_admin/assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('new_admin/assets/js/popper.min.js') }}"></script>
	<script src="{{ asset('new_admin/assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('new_admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('new_admin/assets/plugins/raphael/raphael.min.js') }}"></script>
	<script src="{{ asset('new_admin/assets/plugins/morris/morris.min.js') }}"></script>
	<script src="{{ asset('new_admin/assets/js/chart.morris.js') }}"></script>
	<script src="{{ asset('new_admin/assets/js/script.js') }}"></script>
</html>
