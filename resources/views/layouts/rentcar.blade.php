<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Car Rental | @yield('title')</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/about.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/owl.transitions.css" type="text/css">
    <link href="../assets/css/slick.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" id="switcher-css" type="text/css" href="../assets/switcher/css/switcher.css"
        media="all" />
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="alternate stylesheet" type="text/css" href="../assets/switcher/css/red.css" title="red" media="all"
        data-default-color="true" />
    <link rel="alternate stylesheet" type="text/css" href="../assets/switcher/css/orange.css" title="orange"
        media="all" />
    <link rel="alternate stylesheet" type="text/css" href="../assets/switcher/css/blue.css" title="blue"
        media="all" />
    <link rel="alternate stylesheet" type="text/css" href="../assets/switcher/css/pink.css" title="pink"
        media="all" />
    <link rel="alternate stylesheet" type="text/css" href="../assets/switcher/css/green.css" title="green"
        media="all" />
    <link rel="alternate stylesheet" type="text/css" href="../assets/switcher/css/purple.css" title="purple"
        media="all" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="../assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="../assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="../assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/images/favicon-icon/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link href="../css/rentcar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


    {{-- new_assets --}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../new_assets/css/slick.css" />
    <link type="text/css" rel="stylesheet" href="../new_assets/css/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="../new_assets/css/nouislider.min.css" />
    <link rel="stylesheet" href="../new_assets/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../new_assets/css/style.css" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('link')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <style>
        .booked-event {
            background-color: red;
        }

        .disabled-date {
            pointer-events: none;
            /* Make the date unclickable */
        }
    </style>
    <livewire:styles />
</head>

<body>


    <!-- Start Switcher -->
    @include('../includes/colorswitcher')
    <!-- /Switcher -->


    @include('../includes/rentcarheader')
    <div>
        @yield('content')
    </div>
    <!--Footer -->
    @include('../includes/rentcarfooter')
    <!-- /Footer-->
    <!--Back to top-->
    <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a>
    </div>
    <!--/Back to top-->

    <!-- Scripts -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/interface.js"></script>
    <!--Switcher-->
    <script src="../assets/switcher/js/switcher.js"></script>
    <!--bootstrap-slider-JS-->
    <script src="../assets/js/bootstrap-slider.min.js"></script>
    <!--Slider-JS-->
    <script src="../assets/js/slick.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- new_assets --}}
    <script src="../new_assets/js/jquery.min.js"></script>
    <script src="../new_assets/js/slick.min.js"></script>
    <script src="../new_assets/js/nouislider.min.js"></script>
    <script src="../new_assets/js/jquery.zoom.min.js"></script>
    <script src="../new_assets/js/main.js"></script>

    {{-- Cardetails --}}
    <link rel="stylesheet" type="text/css" href="../cardetails/assets/css/style.css">

    {{-- New Cardetails --}}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <script>
        function confirmAndRedirect() {
            // Ask for confirmation
            var confirmDelete = confirm('Are you sure you want to delete this comment?');

            // If user confirms, redirect to viewcardetails
            if (confirmDelete) {
                window.location.href = '{{url('viewcardetails/'.$data->id)}}'; // Replace '/viewcardetails' with your actual URL
            }
        }
    </script> --}}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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



    @yield('custom-scripts')
    <livewire:scripts />
</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->

</html>
