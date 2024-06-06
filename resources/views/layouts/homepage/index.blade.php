<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Car Rental Portal</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">

    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
        data-default-color="true" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange"
        media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue"
        media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink"
        media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green"
        media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple"
        media="all" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">



</head>

<body>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    @include('includes/colorswitcher')


    @include('includes/header')
    <div class="slider sliderParent">
        <div id="slide">
            <div class="item" style="background-image: url('{{ asset('1.jpg') }}');">
                <div class="content homeContent">
                    <div class="name">K & D</div>
                    <div class="des">
                        Explore your perfect ride with K & D Car Rental Services – designed just for you. Whether you
                        like sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you
                        with K & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car
                        Rental Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="item" style="background-image: url('{{ asset('4.jpg') }}');">
                <div class="content homeContent">
                    <div class="name">K & D</div>
                    <div class="des">Explore your perfect ride with K & D Car Rental Services – designed just for
                        you. Whether you like sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you
                        with K & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car
                        Rental Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="item" style="background-image: url('{{ asset('3.jpg') }}');">
                <div class="content homeContent">
                    <div class="name">K & D</div>
                    <div class="des">Explore your perfect ride with K & D Car Rental Services – designed just for
                        you. Whether you like sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you
                        with K & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car
                        Rental Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="item" style="background-image: url('{{ asset('4.jpg') }}');">
                <div class="content homeContent">
                    <div class="name">K & D</div>
                    <div class="des">Explore your perfect ride with K & D Car Rental Services – designed just for
                        you. Whether you like sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you
                        with K & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car
                        Rental Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="item" style="background-image: url('{{ asset('5.jpg') }}');">
                <div class="content homeContent">
                    <div class="name">K & D</div>
                    <div class="des">Explore your perfect ride with K & D Car Rental Services – designed just for
                        you. Whether you like sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you
                        with K & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car
                        Rental Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="item" style="background-image: url('{{ asset('6.jpg') }}');">
                <div class="content homeContent">
                    <div class="name">K & D</div>
                    <div class="des">Explore your perfect ride with K & D Car Rental Services – designed just for
                        you. Whether you like sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you
                        with K & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car
                        Rental Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="buttons">
                <button id="prev"><i class="fa-solid fa-angle-left"></i></button>
                <button id="next"><i class="fa-solid fa-angle-right"></i></button>
            </div>
        </div>
    </div>

    <!-- Resent Cat-->
    <section class="section-padding white-bg" style="padding: 0 0 20px;">
        <div class="container">
            <div class="section-header text-center">
                <h2 style="color: orange">Available Cars <span style="color:black">For You</span></h2>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form, by injected humour, or randomised words which don't look even slightly
                    believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                    anything embarrassing hidden in the middle of text.</p>
            </div>
            <div class="row">

                <!-- Nav tabs -->
                <div class="recent-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#resentnewcar" role="tab"
                                data-toggle="tab">New Car</a></li>
                    </ul>
                </div>
                <!-- Recently Listed New Cars -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="resentnewcar">


                        @foreach ($data as $index)
                            @php
                                $isAvailable = true;
                            @endphp


                            <!-- WITH DRIVER FILTER -->

                            @foreach ($bookings as $book)
                                @if ($book->admincars_id == $index->id && $book->status == 'confirm')
                                    @php
                                        $isAvailable = false;
                                        break;
                                    @endphp
                                @endif
                            @endforeach

                            <!-- SELFDRIVE FILTER -->

                            @foreach ($selfdrives as $selfdrive)
                                @if ($selfdrive->admincars_id == $index->id && $selfdrive->status == 'confirm')
                                    @php
                                        $isAvailable = false;
                                        break;
                                    @endphp
                                @endif
                            @endforeach

                            @if ($isAvailable)
                                <div class="col-list-3">
                                    <div class="recent-car-list">
                                        <div class="car-info-box"> <a href=" "><img
                                                    src="{{ asset('uploads/car/' . $index->image) }}"
                                                    class="img-responsive" alt="image"></a>
                                            <ul>
                                                <li><i class="fa fa-car" aria-hidden="true"></i>{{ $index->carname }}
                                                </li>
                                                <li><i class="fa fa-calendar"
                                                        aria-hidden="true"></i>{{ $index->carmodel }}</li>
                                                <li><i class="fa fa-user"
                                                        aria-hidden="true"></i>{{ $index->carseats }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="car-title-m">
                                            <h6><a href=" " style="text-decoration: none;">
                                                    <h3>{{ $index->cartype }}</h3>
                                                </a></h6>
                                            <span class="price">Php {{ $index->carprice }} /Day</span>
                                        </div>
                                        <div class="inventory_info_m">
                                            <p>Fueltype: {{ $index->fueltype }}</p>
                                            <p>
                                                Car Status:
                                                @if ($index->status == 'available')
                                                    <span class="badge text-bg-success">Available</span>
                                                @elseif($index->status == 'notavailable')
                                                    <span class="badge text-bg-danger">Not Available</span>
                                                @endif
                                            </p>
                                            <br>
                                            <!-- <a href="{{ url('register') }}"><button style="color:white; background-color:#41c520; padding: 5px;">Book now!</button></a> -->
                                            <a href="{{ url('register') }}" class="btn btn-success">Book now!</a>

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
    </section>
    <!-- /Resent Cat -->

    <!-- Fun Facts-->
    <section class="fun-facts-section">
        <div class="container div_zindex">
            <div class="row">
                <div class="col-lg-3 col-xs-6 col-sm-3">
                    <div class="fun-facts-m">
                        <div class="cell">
                            <h2><i class="fa fa-calendar" aria-hidden="true"></i>5+</h2>
                            <p>Years In Business</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 col-sm-3">
                    <div class="fun-facts-m">
                        <div class="cell">
                            <h2><i class="fa fa-car" aria-hidden="true"></i>5+</h2>
                            <p>New Cars For Rent</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 col-sm-3">
                    <div class="fun-facts-m">
                        <div class="cell">
                            <h2><i class="fa fa-car" aria-hidden="true"></i>20+</h2>
                            <p>Used Cars in Business</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 col-sm-3">
                    <div class="fun-facts-m">
                        <div class="cell">
                            <h2><i class="fa fa-user-circle-o"
                                    aria-hidden="true"></i>{{ App\Models\Feedback::all()->count() }}+</h2>
                            <p>Satisfied Customers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dark Overlay-->
        <div class="dark-overlay"></div>
    </section>
    <!-- /Fun Facts-->


    <!--Testimonial -->
    <section class="section-padding testimonial-section parallex-bg">
        <div class="container div_zindex">
            <div class="section-header white-text text-center">
                <h2>Our Satisfied <span>Customers</span></h2>
            </div>
            {{-- count three satisfied --}}
            {{-- <div class="row p-3">
                <div id="testimonial-slider" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
                    <div class="owl-wrapper-outer">
                        <div class="owl-wrapper"
                            style="width: 2340px; left: 0px; display: block; transition: all 1000ms ease 0s; transform: translate3d(0px, 0px, 0px);">
                            <div class="owl-item" style="width: 585px;">
                                <div class="testimonial-m">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item" style="width: 585px;">
                        <div class="testimonial-m">
                            <div class="testimonial-img"> <img src="assets/images/cat-profile.png" alt="">
                            </div>
                            <div class="testimonial-content">
                                <div class="testimonial-heading">
                                    <h5>Tom K</h5>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam nibh. Nunc
                                        varius facilis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-controls clickable" style="display: none;">
                <div class="owl-pagination">
                    <div class="owl-page active"><span class=""></span></div>
                </div>
            </div> --}}

            <div class="custom-row">

                @foreach ($feedbacks as $key => $feedback)
                    <div class="custom-col">
                        <div class="card custom-card">
                            <h5 class="card-header text text-center">
                                @php
                                    $numStars = $feedback->rating;
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fa-solid fa-star text-muted {{ $i <= $numStars ? 'text-warning' : '' }}"></i>
                                @endfor
                            </h5>
                            <div class="card-body custom-card-body">
                                <p class="card-text text text-center">{{ $feedback->comment }}</p>
                                <div class="text-center">
                                    <img width="50"
                                        src="{{ asset('uploads/profile/' . $feedback->user->photo) }}"
                                        style="border-radius: 50%;" alt="">
                                    <br>
                                    <span class="text">{{ $feedback->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        </div>
        </div>
        <!-- Dark Overlay-->
        <div class="dark-overlay"></div>
    </section>
    <!-- /Testimonial-->


    <!--Footer -->
    @include('includes/footer')
    <!-- /Footer-->

    <!--Back to top-->
    <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a>
    </div>
    <!--/Back to top-->

    <!--Login-Form -->
    {{-- @include('includes/login') --}}
    <!--/Login-Form -->

    <!--Register-Form -->
    {{-- @include('includes/registration') --}}

    <!--/Register-Form -->

    <!--Forgot-password-Form -->
    {{-- @include('includes/forgotpassword') --}}
    <!--/Forgot-password-Form -->

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/interface.js"></script>
    <!--Switcher-->
    <script src="assets/switcher/js/switcher.js"></script>
    <!--bootstrap-slider-JS-->
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <!--Slider-JS-->
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="homepage/script.js"></script>

    {{-- <script>
        document.getElementById('next').onclick = function(){
            let lists = document.querySelectorAll('.item');
        document.getElementById('slide').appendChild(lists[0]);
        }
        document.getElementById('prev').onclick = function(){
        let lists = document.querySelectorAll('.item');
        document.getElementById('slide').prepend(lists[lists.length - 1]);
        }
    </script> --}}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let currentIndex = 0;
        const intervalTime = 4000; // Change this value to set the interval time in milliseconds

        function slideNext() {
            let lists = document.querySelectorAll('.item');
            document.getElementById('slide').appendChild(lists[0]);
        }

        function slidePrev() {
            let lists = document.querySelectorAll('.item');
            document.getElementById('slide').prepend(lists[lists.length - 1]);
        }

        function autoSlide() {
            slideNext(); // You can change this to slidePrev() if you want to start in the opposite direction
            currentIndex++;
            if (currentIndex === document.querySelectorAll('.item').length) {
                currentIndex = 0;
            }
        }

        document.getElementById('next').onclick = function() {
            slideNext();
        };

        document.getElementById('prev').onclick = function() {
            slidePrev();
        };

        setInterval(autoSlide, intervalTime);
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

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->

</html>
