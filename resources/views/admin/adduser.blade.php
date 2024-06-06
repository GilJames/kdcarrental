<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <body>

<div id="adduser" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action ="{{url('saveuser')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <div>
                            <input class="form-control" type="text" placeholder="Fullname" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <div>
                            <input class="form-control" type="email" placeholder="Enter your email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone Number <span class="text-danger">*</span></label>
                        <div>
                            <input class="form-control" type="number" placeholder="Enter your phone number" name="number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <div>
                            <input class="form-control" type="text" placeholder="Enter your address" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input class="form-control" placeholder="Enter your password" type="password" name="password">
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                </form>
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
                            window.location.href = "{{url('adminuser')}}";
                        }
                    });
                </script>
            @endif
            </div>
        </div>
    </div>
</div>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>

{{-- <!DOCTYPE html>
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
    <div class="row">
					<div class="col-lg-12">

          @if(session('message'))
        <div class="alert alert-success" role="alert">{{session('message')}}</div>
        @endif

          <form action ="{{url('saveuser')}}" method="post">
            @csrf
							<div class="row formtype">
								<div class="col-md-4">
									<div class="form-group">
										<label>Name</label>
                    					<input type="text" class="form-control" placeholder="Fullname" name="name" value="">
                                        {{-- @error('name') <small class="text-danger">{{$message}}</small> @enderror

									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Email</label>
                    					<input type="email" class="form-control" placeholder="Enter your email" name="email" value="">
                                        @error('email') <small class="text-danger">{{$message}}</small> @enderror
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Phone Number</label>
                    					<input type="number" class="form-control" placeholder="Enter your phone number" name="number" value="">
                                        @error('number') <small class="text-danger">{{$message}}</small> @enderror
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Address</label>
                    					<input type="text" class="form-control" placeholder="Enter your address" name="address" value="">
                                        @error('address') <small class="text-danger">{{$message}}</small> @enderror
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Password</label>
										<div class="time-icon">
											<input type="text" class="form-control" name="password" > </div>
                                            @error('password') <small class="text-danger">{{$message}}</small> @enderror
									</div>
								</div>
							</div>
                        </div>
								<button type="submit" class="btn btn-primary">Submit</button>
              					<a href="{{url('../adminuser')}}" class="btn btn-danger">Back</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
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
</html> --}}
