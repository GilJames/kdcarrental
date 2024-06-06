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

    {{-- BOOTSTRAP NI SA MODAL --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
                <div class="main-body">

                    <!-- Breadcrumb -->

                    <!-- /Breadcrumb -->
                    <br>
                    <br>

                      <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                          <div class="card">
                            <div class="card-body">
                              <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{asset('../uploads/profile/' . $data->photo)}}" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                  <h4>{{$data->name}}</h4>
                                  <!-- <button class="btn btn-primary"><a href="">Edit</a></button> -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$data->id}}">
                              Edit Profile
                            </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
    </div>
</div>
<div class="col-md-8">
                          <div class="card mb-3">
                              <div class="card-body" style="padding:100px;">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$data->name}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$data->email}}
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$data->number}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    {{$data->address}}
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-9 text-secondary">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row gutters-sm">







                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

</div>




</div>





</div>



@include('modal.admineditprofile')



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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
<style>
    body{
      margin-top:20px;
      color: #1a202c;
      text-align: left;
      background-color: #e2e8f0;
      text-decoration:none;
  }
  .main-body {
      padding: 15px;
      text-decoration:none;
  }
  .card {
      box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
  }

  .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 0 solid rgba(0,0,0,.125);
      border-radius: .25rem;
  }

  .card-body {
      flex: 1 1 auto;
      min-height: 1px;
      padding: 1rem;
  }

  .gutters-sm {
      margin-right: -8px;
      margin-left: -8px;
  }

  .gutters-sm>.col, .gutters-sm>[class*=col-] {
      padding-right: 8px;
      padding-left: 8px;
  }
  .mb-3, .my-3 {
      margin-bottom: 1rem!important;
  }

  .bg-gray-300 {
      background-color: #e2e8f0;
  }
  .h-100 {
      height: 100%!important;
  }
  .shadow-none {
      box-shadow: none!important;
  }
  *{
    text-decoration:none;

  }
  </style>
