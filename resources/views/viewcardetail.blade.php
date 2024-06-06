@extends('layouts.rentcar')
@section('title', 'Car Listing')

@section('content')

    <br>
    <!--Listing-detail-->
    <section>

        {{-- Count Comment --}}

        @php
            $commentCount = $reviews->count();
            $ratingCount = 0;
            foreach ($reviews as $rs) {
                $ratingCount += $rs->rating;
            }
            $averageRating = $commentCount > 0 ? $ratingCount / $commentCount : 0;
        @endphp
        {{-- End Count --}}


        <div class="container">
            <div class="section">
                <!-- container -->
                <!-- row -->
                <div class="row">
                    <!-- Product main img -->
                    <div class="col-md-5 col-md-push-2">
                        <div id="product-main-img">
                            <div class="product-preview" style="width: 500px; height: 500px;">
                                @if ($data)
                                    <img src="{{ asset('../uploads/car/' . $data->image) }}" alt="image" class="preview-image" style="width: 500px; height:500px;">
                                </div>
                            </div>
                    </div>
                    <div class="col-md-2  col-md-pull-5">
                    </div>
                    <!-- Car details -->
                    <div class="col-md-5">
                        <div class="product-details">
                            <h2 class="product-name">{{ $data->carname }}</h2>
                            <div>
                                <div class="product-rating">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $overallRating)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                </div>
                                <a class="review-link" data-toggle="tab" href="#tab3">{{ $commentCount }} Review
                                    {{ $commentCount !== 1 ? '(s)' : '' }}</a>
                            </div>
                            <div>
                                <h3 class="product-price">{{ $data->carprice }}</del></h3>
                            </div>

                            <ul>
                                <li><i class="fa fa-user" aria-hidden="true"></i> {{ $data->carseats }}</li>
                                <li><i class="fa fa-calendar" aria-hidden="true"></i>{{ $data->carmodel }}</li>
                                <li><i class="fa fa-car" aria-hidden="true"></i> {{ $data->fueltype }}</li>
                                {{-- <li><i class="fa fa-car" aria-hidden="true"> &nbsp; {{ $data->fueltype }}</i></li> --}}
                            </ul>
                            <h5>Other Description</h5>
                            <p class="list-city"><span style="color:rgb(19, 9, 9)"><b>Car Model:</span> &nbsp;
                                {{ $data->carmodel }} </p>
                            <p class="list-city"><span
                                    style="color:rgb(19, 9, 9); font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif "><b>FuelType:</span>
                                &nbsp;{{ $data->fueltype }}</p>
                            <p class="list-city"><span style="color:rgb(19, 9, 9)"><b>Cartype:</span>
                                &nbsp;{{ $data->cartype }}</p>

                            <ul class="product-links">
                                <li>Share:</li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                            </ul>
                            <div class="add-to-cart">
                                <button class="add-to-cart-btn" data-toggle="modal" data-target="#bookNowModal">
                                    <i class="fa fa-light fa-address-book"></i> Book Here
                                </button>
                            </div>

                        </div>
                    </div>
                    @include('booking_modal_select')
                    <!-- /Car details -->
                    <!-- Car tab -->
                    <div class="col-md-12">
                        <div id="product-tab">
                            <!-- Car tab nav -->
                            <ul class="tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                                <li><a data-toggle="tab" href="#tab3">Reviews({{ $commentCount }}
                                        {{ $commentCount !== 1 ? 's' : '' }})</a></li>
                            </ul>
                            <!-- /Car tab nav -->

                            <!-- Car tab content -->
                            <div class="tab-content">
                                <!-- tab1  -->
                                <div id="tab1" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                Welcome to K & D Car Rental Services, where your journey begins with
                                                convenience and style. At K & D, we specialize in providing tailored
                                                car solutions crafted exclusively for you. Whether you're in search of
                                                a sleek and efficient vehicle or a robust driving companion, our diverse
                                                fleet awaits your selection. Our commitment to your satisfaction is
                                                reflected
                                                in our personalized approach to car rental. We offer a range of options to
                                                cater
                                                to your unique preferences, ensuring that your travel experience aligns
                                                perfectly
                                                with your individual needs.


                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /tab1  -->

                                <!-- tab3  -->
                                <div id="tab3" class="tab-pane fade in">
                                    <div class="row">
                                        <!-- Reviews -->
                                        <div class="col-md-6">
                                            <div id="reviews">
                                                <div>
                                                    @if (!$reviews->isEmpty())
                                                        <ul class="woocommerce-Reviews-title">{{ $commentCount }}
                                                            review{{ $commentCount !== 1 ? 's' : '' }} for
                                                            <span>{{ $reviews->first()->admincar->carname }}
                                                                [{{ $reviews->first()->admincar->carmodel }}]</span>
                                                    @endif
                                                    </ul>
                                                </div>
                                                <div id="comments">
                                                    <ol class="commentlist">
                                                        <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                                                            id="li-comment-20">
                                                            <div id="comment-20" class="comment_container">
                                                                @forelse ($reviews as $rs)
                                                                    <img alt=""
                                                                        src="{{ asset('../uploads/profile/' . $rs->user->photo) }}"
                                                                        height="80" width="80">
                                                                    <div class="comment-text">

                                                                        <div style="display: flex; align-items: center;">
                                                                            <span style="width: 80%; margin-left: 10px;">
                                                                                @for ($i = 0; $i < 5; $i++)
                                                                                    @if ($i < $rs->rating)
                                                                                        <i class="fa fa-star"
                                                                                            style="color: gold; font-size: 13px; margin-left: 1px; margin-right: 1px; "></i>
                                                                                    @else
                                                                                        <i class="fa fa-star-o"
                                                                                            style=" color: rgba(59, 59, 60, 0.868); font-size: 13px; margin-left: 1px; margin-right: 1px; "></i>
                                                                                    @endif
                                                                                @endfor
                                                                            </span>
                                                                        </div>
                                                                        <p class="meta">
                                                                            <strong
                                                                                class="woocommerce-review__author">{{ $rs->user->name }}</strong>
                                                                            <span class="woocommerce-review__dash"></span>
                                                                            <time class="woocommerce-review__published-date"
                                                                                datetime="{{ $rs->created_at }}">
                                                                                {{ \Carbon\Carbon::parse($rs->created_at)->format('F j, Y H:i') }}
                                                                            </time>
                                                                        </p>
                                                                        <div class="description">
                                                                            <p>{{ $rs->comment }}</p>
                                                                            @if (Auth::check() && Auth::id() == $rs->user_id)
                                                                                <div>
                                                                                    <td>
                                                                                        <form method="POST"
                                                                                            action="{{ url('deleteComment/' . $rs->id) }}">
                                                                                            @csrf
                                                                                            <input type="hidden"
                                                                                                name="id"
                                                                                                value="{{ $rs->id }}">
                                                                                            <button type="submit"
                                                                                                class="btnn"
                                                                                                onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                                                                        </form>
                                                                                        <br>
                                                                                    </td>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                @empty
                                                                    <div
                                                                        style="display: flex; justify-content: flex-end; align-items: center; margin-left: 690px;">
                                                                        <img src="../assets/images/empty.png" width="200"
                                                                            height="200"
                                                                            style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"
                                                                            alt="Empty Image">
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </li>
                                                </div>
                                                </ol>
                                            </div>



                                            {{-- <ul class="reviews-pagination">
                                            @if ($reviews->currentPage() != 1)
                                                <li><a href="{{ $reviews->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
                                            @endif

                                            @for ($i = 1; $i <= $reviews->lastPage(); $i++)
                                                <li class="{{ ($reviews->currentPage() == $i) ? 'active' : '' }}"><a href="{{ $reviews->url($i) }}">{{ $i }}</a></li>
                                            @endfor

                                            @if ($reviews->hasMorePages())
                                                <li><a href="{{ $reviews->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
                                            @endif
                                        </ul> --}}
                                        </div>
                                    </div>
                                    <!-- /Reviews -->

                                    <!-- Review Form -->
                                    {{-- <div class="col-md-3">
                                        <div id="review-form">
                                            <form class="review-form" action="{{url('storecomment')}}" method="post">
                                                @csrf
                                                <div>
                                                    <input class="input" type="hidden" name="admincars_id" value="{{ $data->id }}">
                                                </div>
                                                <div>
                                                    <textarea class="input" name="comment" placeholder="Your Review"></textarea>
                                                </div>
                                                <div class="input-rating">
                                                    <span>Your Rating: </span>
                                                    <div class="stars">
                                                        <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                        <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                        <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                        <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                        <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                                    </div>
                                                </div>
                                                @auth
                                                <button class="primary-btn">Submit</button>
                                                @else
                                                    <a href="/login" class="primary-btn"></a>
                                                @endauth
                                            </div>
                                        </form>
                                        </div>

                                    </div> --}}
                                </div>
                                <!-- /tab3  -->
                            </div>
                            <!-- /product tab content  -->
                        </div>
                    </div>
                    <!-- /product tab -->
                </div>
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->
        </div>
        @endif
    </section>
@endsection
<style>
    .btnn {
        background-color: rgb(230, 70, 70);
        color: #fff;
        border-color: rgb(230, 70, 70);
        ;
    }

    .btnn:hover {
        color: rgb(235, 30, 30);
        background-color: white;
        border-color: rgb(230, 70, 70);
        ;

    }

    .product-preview {
    width: 500px;
    height: 500px;
    overflow: hidden;
    }

    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
