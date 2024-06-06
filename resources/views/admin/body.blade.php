<div class="page-wrapper">

    <div class="content container-fluid">
        <div class="page-header">
            <br>
            <div class="dashboard">
                <br>
                <h3 style="color:#000">Dashboard</h3>
            </div>
            <br>
            <br>
            <div class="row justify-content-center"> <!-- Center the content in the row -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-10 col-12 mb-4">
                    <!-- Adjusted column width for responsiveness -->
                    <div class="card board1 fill"
                        style="border-radius:10px;">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <div>
                                    <h3 class="card_widget_header"><span >{{ $totalbook }}</span>
                                    </h3>
                                    <h5 class="text-muted"> <span></span>  Total Bookings</h5>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="110" height="110"
                                            viewbox="0 0 24 24" fill="none" stroke="#F84343" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.2;"
                                            class="feather feather-user-plus">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="12" y1="18" x2="12" y2="12"></line>
                                            <line x1="9" y1="15" x2="15" y2="15"></line>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-10 col-12">
                    <!-- Adjusted column width for responsiveness -->
                    <div class="card board1 fill"
                        style="border-radius:10px;">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <div>
                                    <h3 class="card_widget_header" stroke="#fff">{{ $admincar }}</h3>
                                    <h6 class="text-muted" stroke="#fff">Total Cars</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="110" height="110"
                                            viewBox="0 0 24 24">
                                            <g fill="none" stroke="#F84343" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" style="opacity: 0.2;">
                                                <path d="M1 3h15v13H1zm15 5h4l3 3v5h-7z"></path>
                                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- <div class="col-xl-3 col-sm-6 col-12">
                <div class="card board1 fill" style="padding: 59px;">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                                <h3 class="card_widget_header">{{ $user }}</h3>
                                <h6 class="text-muted">Total Users</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-file-plus">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <line x1="20" y1="8" x2="20" y2="14"></line>
                                        <line x1="23" y1="11" x2="17" y2="11"></line>
                                    </svg></span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card board1 fill"  style="padding: 59px;">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                                <h3 class="card_widget_header">{{ $feedback }}</h3>
                                <h6 class="text-muted">Feedbacks</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                              viewBox="0 0 24 24"><g fill="none" stroke="#009688"
                               stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                               <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                               <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1l1-4z"/></g></svg></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row justify-content-center"> <!-- Center the content in the row -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-10 col-12 mb-4">
                <!-- Adjusted column width for responsiveness -->
                <div class="card board1 fill"
                    style="border-radius:10px;">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                                <h3 class="card_widget_header">{{ $user }}</h3>
                                <h6 class="text-muted">Total Users</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="110" height="110"
                                        viewbox="0 0 24 24" fill="none" stroke="#F84343" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.2;"
                                        class="feather feather-file-plus">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <line x1="20" y1="8" x2="20" y2="14"></line>
                                        <line x1="23" y1="11" x2="17" y2="11"></line>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-10 col-12 mb-4">
                <!-- Adjusted column width for responsiveness -->
                <div class="card board1 fill"
                    style="border-radius:10px; ">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                                <h3 class="card_widget_header">{{ $feedback }}</h3>
                                <h6 class="text-muted">Feedbacks</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="110" height="110"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="#F84343" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" style="opacity: 0.2;">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1l1-4z" />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <br>
        <div class="imagecarousel pb-4">
            <div class="imagecontent" style="background-image: url(../assets/images/image1.jpg);"></div>
            <div class="imagecontent" style="background-image: url(../assets/images/image2.jpg);"></div>
            <div class="imagecontent" style="background-image: url(../assets/images/image1.jpg);"></div>
            <div class="imagecontent" style="background-image: url(../assets/images/image2.jpg);"></div>
            <!-- Add more slides as needed -->
        </div>









        {{-- <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">Reports</h4>
                    </div>
                    <div class="card-body">
                        <div id="line-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">ROOMS BOOKED</h4>
                    </div>
                    <div class="card-body">
                        <div id="donut-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h4 class="card-title float-left mt-2">Booking</h4>
                        <button type="button" class="btn btn-primary float-right veiwbutton">Veiw All</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center">
                                <thead>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Name</th>
                                        <th>Email ID</th>
                                        <th>Aadhar Number</th>
                                        <th class="text-center">Room Type</th>
                                        <th class="text-right">Number</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>BKG-0001</div>
                                        </td>
                                        <td class="text-nowrap">Tommy Bernal</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="3743585a5a4e55524559565b77524f565a475b521954585a">[email&#160;protected]</a>
                                        </td>
                                        <td>12414786454545</td>
                                        <td class="text-center">Double</td>
                                        <td class="text-right">
                                            <div>631-254-6480</div>
                                        </td>
                                        <td class="text-center"> <span
                                                class="badge badge-pill bg-success inv-badge">INACTIVE</span> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>BKG-0002</div>
                                        </td>
                                        <td class="text-nowrap">Ellen Thill</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="89fbe0eae1e8fbedebfbe6ebfafdc9ecf1e8e4f9e5eca7eae6e4">[email&#160;protected]</a>
                                        </td>
                                        <td>5456223232322</td>
                                        <td class="text-center">Double</td>
                                        <td class="text-right">
                                            <div>830-468-1042</div>
                                        </td>
                                        <td class="text-center"> <span
                                                class="badge badge-pill bg-success inv-badge">INACTIVE</span> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>BKG-0003</div>
                                        </td>
                                        <td class="text-nowrap">Corina Kelsey</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="76131a1a1318021e1f1a1a36130e171b061a135815191b">[email&#160;protected]</a>
                                        </td>
                                        <td>454543232625</td>
                                        <td class="text-center">Single</td>
                                        <td class="text-right">
                                            <div>508-335-5531</div>
                                        </td>
                                        <td class="text-center"> <span
                                                class="badge badge-pill bg-success inv-badge">INACTIVE</span> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>BKG-0004</div>
                                        </td>
                                        <td class="text-nowrap">Carolyn Lane</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="50333f22393e313b353c23352910373d31393c7e333f3d">[email&#160;protected]</a>
                                        </td>
                                        <td>2368989562621</td>
                                        <td class="text-center">Double</td>
                                        <td class="text-right">
                                            <div>262-260-1170</div>
                                        </td>
                                        <td class="text-center"> <span
                                                class="badge badge-pill bg-success inv-badge">INACTIVE</span> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>BKG-0005</div>
                                        </td>
                                        <td class="text-nowrap">Denise</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="1c7f7d6e73706572707d72795c7b717d7570327f7371">[email&#160;protected]</a>
                                        </td>
                                        <td>3245455582287</td>
                                        <td class="text-center">Single</td>
                                        <td class="text-right">
                                            <div>570-458-0070</div>
                                        </td>
                                        <td class="text-center"> <span
                                                class="badge badge-pill bg-success inv-badge">INACTIVE</span> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
    </div>
</div>
</div>
</div>



<style>

.card.board1.fill {
  /* Your CSS styles here */

  background-color:  #FF8E8E;
}



    .page-wrapper {
        /* background-color:#F1F9F6; */




    }

    /* .imagecontent{

        background: url(../assets/images/image1.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        object-fit: cover;
         height: 80vh;
         width: 75%;
         margin: auto;



    } */

    /* .imagecarousel {
        overflow: hidden;
        width: 88%;
        margin: auto;
    }

    .imagecontent {
        display: none;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        object-fit: cover;
        height: 80vh;
        width: 100%;
    } */

    .imagecarousel {
        display: flex;
        overflow-x: auto;
        /* Enable horizontal scrolling */
        scroll-snap-type: x mandatory;
        /* Snap to each slide */
        -webkit-overflow-scrolling: touch;
        /* Enable smooth scrolling on iOS */
    }

    .imagecontent {
        flex: 0 0 auto;
        /* Prevent items from shrinking */
        width: 100%;
        /* Ensure each slide takes full width */
        scroll-snap-align: start;
        /* Snap alignment */
        background-size: cover;
        height: 300px;
        /* Set initial height, adjust as needed */
    }

    /* Media queries for responsiveness */
    @media screen and (min-width: 576px) {
        .imagecontent {
            height: 400px;
            /* Adjust height for small devices */
        }
    }

    @media screen and (min-width: 768px) {
        .imagecontent {
            height: 500px;
            /* Adjust height for medium devices */
        }
    }

    @media screen and (min-width: 992px) {
        .imagecontent {
            height: 600px;
            /* Adjust height for large devices */
        }
    }

    @media screen and (min-width: 1200px) {
        .imagecontent {
            height: 700px;
            /* Adjust height for extra large devices */
        }
    }






    /* Add more slides as needed */


    /* .content, .container-fluid{
        background: url(../assets/images/image1.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        /* object-fit: cover; */
    /* height: 100%;
        width: 100%; */
    */
    /* } */
</style>
<script>
    // Using JavaScript to create an automatic carousel slider
    let currentSlide = 0;
    const slides = document.querySelectorAll('.imagecontent');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.display = i === index ? 'block' : 'none';
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function startCarousel() {
        setInterval(nextSlide, 2000); // Change slide every 3 seconds (adjust as needed)
    }

    // Initialize the carousel
    showSlide(currentSlide);
    startCarousel();
</script>
