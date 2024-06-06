<header>
    <div class="default-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 col-6">
                    <div class="logo"> <a href="/"><img src="assets/images/logg.png" alt="image" /></a> </div>
                </div>
                <div class="col-md-9 col-6">
                    <div class="header_info text-md-end">
                        <div class="header_widgets">
                            <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
                            <p class="uppercase_text">For Support Mail us : </p>
                            <a href="mailto:info@example.com">butalk07@gmail.com</a>
                        </div>
                        <div class="header_widgets">
                            <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                            <p class="uppercase_text">Service Helpline Call Us: </p>
                            <a href="tel:61-1234-5678-09">0966 963 2155</a>
                        </div>
                        <div class="social-follow">
                            <ul>
                                <li><a href="https://www.facebook.com/profile.php?id=61552501830668"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>

                        @auth
                            <div class="login_btn"> <a href="{{ url('/home') }}" class="btn btn-xs uppercase"
                                    data-toggle="modal" data-dismiss="modal">Return to portal</a> </div>
                        @else
                            <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal"
                                    data-dismiss="modal">Login / Register</a> </div>
                            @include('auth/login')

                            @if (Route::has('register'))
                                {{-- <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a> --}}
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
