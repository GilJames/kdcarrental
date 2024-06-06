@php
    // If the session variable is not set, set it to a default value
    if (!session()->has('selectedOption')) {
        session(['selectedOption' => 'all']); // or any default value you prefer
    }
@endphp


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="{{ asset('new_admin/image/x-icon" href="new_admin/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/feathericon.min.css') }}">
    <link rel="stylehseet" href="{{ asset('new_admin/https://cdn.oesmith.co.uk/morris-0.5.1.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Add this in the <head> section of your HTML -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


    <style>
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
        }
    </style>


</head>
</head>

<body>


    <!-- heading -->
    @include('admin.header')
    <!-- end heading -->

    <!-- leftbar -->
    @include('admin.leftbar')
    <!-- end leftbar -->

    <div class="page-wrapper" id="page-wrapperParent">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col mb-2">
                        <div class="mt-5">
                            <div class="float-right d-none preloader">
                                <i class="fas fa-spinner fa-spin"></i> Please wait ...
                            </div>
                            {{-- <h4 class="card-title float-left mt-2">Bookings With Drivers</h4> --}}

                            <select id="selectDrive" class="form-control w-100">
                                <option value="all" {{ session('selectedOption') == 'all' ? 'selected' : '' }}>All
                                </option>
                                <option value="withdDriver"
                                    {{ session('selectedOption') == 'withdDriver' ? 'selected' : '' }}>With Driver
                                </option>
                                <option value="selfDrive"
                                    {{ session('selectedOption') == 'selfDrive' ? 'selected' : '' }}>Self Drive
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- With driver wrapper --}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body booking_card">

                                {{-- all bookings --}}
                                @include('admin.all-bookings')
                                {{-- all bookings table end --}}

                                {{-- With driver Table --}}
                                @include('admin.with-driver-table')
                                {{-- With driver Table end --}}

                                {{-- selfdrive --}}
                                @include('admin.self-drive-table')
                                {{-- selfdrive --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- With driver wrapper --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('admin.add-customScript')
<script>
    function submitClick(bookingId, clickstatus, parentMod, model) {
        var selectDrive = $('#selectDrive').val();

        // selfDriveModel, bookingModel

        $(".preloader").removeClass('d-none');

        var data = clickstatus == 'reject' ? {
            rejectionReason: $(`#${parentMod}`).find('.rejectionReason' + bookingId).val(),
            bookingId: bookingId,
            status: $(`#${parentMod}`).find('.rejectionStatus' + bookingId).val(),
            model: model,
        } : {
            officialReceipt: $(`#${parentMod}`).find('.officialReceipt' + bookingId).val(),
            bookingId: bookingId,
            status: $(`#${parentMod}`).find('.confirmStatus' + bookingId).val(),
            model: model,
        };


        // Make an AJAX request to the controller method
        $.ajax({
            url: '{{ route('reject.booking') }}',
            type: 'POST',
            data: data,
            success: function(response) {
                // Show preloader
                console.log(response);

                if (response.status === 'success') {
                    toastr["success"]("Success");

                } else if (response.status === 'error') {
                    toastr["error"]("Error occur, Please try again!");

                }
                // Hide preloader once Toastr is displayed
                $(".preloader").addClass('d-none');

                // Reset Toastr options
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                location.reload();
            },


            error: function(error) {
                // Handle error, if needed
                console.log(error);
            }

        });


        $(`#${parentMod}`).modal('hide');



    }

    function toPay(id, model) {

        // console.log(model);

        $(".preloader").removeClass('d-none');
        $.ajax({
            url: '{{ route('to_pay') }}',
            type: 'POST',
            data: {
                id: id,
                model: model,
            },
            success: function(response) {
                // Show preloader
                console.log(response);

                if (response.status === 'success') {
                    toastr["success"]("Success");


                } else if (response.status === 'error') {
                    toastr["error"]("Error occur, Please try again!");

                }
                // Hide preloader once Toastr is displayed
                $(".preloader").addClass('d-none');

                // Reset Toastr options
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                location.reload();
            },


            error: function(error) {
                // Handle error, if needed
                console.log(error);
            }

        });
    }
</script>

<script>
    function confirmToPay(bookId, type) {
        var confirmation = confirm('Do you want to accept their booking?');

        if (confirmation) {
            toPay(bookId, type);
        } else {}
    }
</script>
<script>
    expiredFunction();
    function expiredFunction() {
        $.ajax({
            url: '/expiredfunction',
            method: 'get',
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>

</html>
