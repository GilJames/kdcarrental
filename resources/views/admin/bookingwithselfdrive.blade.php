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
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/style.css') }}"> </head>
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
								<h4 class="card-title float-left mt-2">Bookings With SelfDrive </h4>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card card-table">
							<div class="card-body booking_card">
								<div class="table-responsive">
                                    @if(session('info'))
                                        <div class="alert alert-success" role="alert">{{session('info')}}</div>
                                    @endif
									<table class="datatable table table-stripped table table-hover table-center mb-0">
										<thead>
											<tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>PickupDate</th>
                                                <th>PickupTime</th>
                                                <th>DropoffDate</th>
                                                <th>Dropofftime</th>
                                                <th>Destination</th>
                                                <th>Days of trips</th>
                                                <th>License</th>
                                                <th>Carname</th>
                                                <th>Car price</th>
                                                <th>Booking Status</th>
                                                <th>Action</th>
                                                <th>Confirm</th>
                                                <th>Reject</th>
                                                <th>Completed</th>

											</tr>
										</thead>
										<tbody>

                                            @foreach($data as $key => $book)
											<tr>
                                                <th>{{$key + 1}}</th>
                                                <th>{{$book->user->name}}</th>
                                                <td>{{$book->pickupdate}}</td>
                                                <td>{{$book->pickuptime}}</td>
                                                <td>{{$book->dropoffdate}}</td>
                                                <td>{{$book->dropofftime}}</td>
                                                <td>{{$book->destination}}</td>
                                                <td>{{$book->daytrip}}</td>
                                                <td>{{$book->license}}</td>
                                                <td>{{$book->admincar->carname}}</td>
                                                <td>{{$book->admincar->carprice}}</td>
                                                <td>
                                                @if($book->status == 'confirm')
                                                   <span class="btn btn-sm bg-success-light mr-2">Confirm</span>
                                                 @elseif($book->status == 'reject')
                                                 <span class="btn btn-sm bg-danger-light mr-2">Reject</span>
                                                 @elseif($book->status == 'completed')
                                                 <span class="btn btn-sm bg-warning-light mr-2">Completed</span>
                                                 @elseif($book->status == 'pending')
                                                 <span class="btn btn-sm bg-danger-light mr-2">Pending</span>
                                                 @endif

                                                </td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href=""><i class="fas fa-pencil-alt m-r-5"></i> View</a>
                                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5"></i> Delete</a> </div>
                                                    </div>

                                                    <div id="delete_asset" class="modal fade delete-modal" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center"> <img src="new_admin/assets/img/sent.png" alt="" width="50" height="46">
                                                                                    <h3 class="delete_class">Are you sure want to delete this Asset?</h3>
                                                                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                                                    <a href=""><button type="submit" class="btn btn-danger">Delete</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
										        </td>
                                                <td><a href="{{url('selfconfirmstatus' , $book->id)}}" class="btn btn-success">Confirm</a></td>
                                                <td><a href="{{url('selfrejectstatus' , $book->id)}}" class="btn btn-danger">Reject</a></td>
                                                <td><a href="{{url('selfcompletedstatus' , $book->id)}}" class="btn btn-warning">To pay</a></td>
									        </tr>
                                            @endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

</body>
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
