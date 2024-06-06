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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
								<h4 class="card-title float-left mt-2">Ratings | Review</h4>
                                <form action="{{ url('searchFeedback') }}" method="GET">
                                    <div class="col-sm-5 offset-sm-7">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" placeholder="Search...">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <button type="submit" class="fa fa-search"></button>
                                                </span>
                                                @if(request()->has('search') && request()->input('search') != '')
                                                    <a href="{{ url('searchFeedback') }}" class="btn btn-outline-secondary">
                                                        Clear
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                                                <th>User Name</th>
                                                <th>Car Name</th>
                                                <th>Review</th>
                                                <th>Rating</th>
												<th class="text-right">Actions</th>
											</tr>
										</thead>
										<tbody>
                                            @php
                                                $i =1;
                                            @endphp
                                            @foreach($feedback as $fb)
											<tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$fb->user->name}}</td>
                                                <td>{{$fb->admincar->carname}}</td>
                                                <td>{{$fb->comment}}</td>
                                                <td>{{$fb->rating}}</td>
                                                <td>
                                                    <div>
                                                        <a href="{{ url('deletefeedback/' . $fb->id) }}" title="Delete" data-toggle="modal" data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5" style="color:red"></i></a>
                                                    </div>

                                                    <div id="delete_asset" class="modal fade delete-modal" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center"> <img src="new_admin/assets/img/sent.png" alt="" width="50" height="46">
                                                                                    <h3 class="delete_class">Are you sure want to delete this Asset?</h3>
                                                                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                                                    <a href="{{ url('deletefeedback/' . $fb->id) }}"><button type="submit" class="btn btn-danger">Delete</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
										        </td>
									        </tr>
                                            @endforeach
										</tbody>
									</table>
                                    <div class="clearfix">
                                            <hr>
                                        {{$feedback->links()}}
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
</body>
@if(Session::has('info'))
<script>
    swal({
        title: "Congrats",
        text: "{{ Session::get('info') }}",
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
            window.location.href = "{{url('feedback')}}";
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
