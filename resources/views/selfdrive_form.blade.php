@extends('layouts.rentcar')
@include('custom-style')
@section('title', 'Car Listing')

@section('content')
    <section class="page-header listing_page">
        <div class="container">
            <div class="page-header_wrap">
                <div class="page-heading">
                    <h1>Self Drive Booking</h1>
                </div>
                <!-- Dark Overlay-->
                <div class="dark-overlay"></div>
    </section>
    <br>
    <!--Listing-detail-->
    <section class="listing-detail">

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="calendar-container calendar"></div>
                </div>
                <div class="col-md-6" style=" padding-left: 3%">
                    <h3 class="page-title" style="text-align:Center; margin-bottom: 5%">Booking Form</h3>
                    <form class="bookingFormwrapper" action="{{ url('selfdrivebook') }}" method="POST">
                        @csrf

                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Car name</label>
                                    <input class="form-control" type="text" name="car_name"  value="{{ $data->carname }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pickup Date</label>
                                    <input class="form-control dateInput pickupdateInput" type="date" id="sel2"
                                        name="pickupdate">
                                    @error('pickupdate') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pickup Time</label>
                                    <input class="form-control" type="time" id="appt" name="pickuptime" required />
                                    @error('pickuptime') <small class="text-danger">{{$message}}</small> @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>DropoffDate</label>
                                    <input class="form-control dateInput dropoffdateInput" type="date" id="sel2"
                                        name="dropoffdate">
                                     @error('dropoffdate') <small class="text-danger">{{$message}}</small> @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>DropoffTime</label>
                                    <input class="form-control" type="time" id="appt" name="dropofftime" required />
                                     @error('dropofftime') <small class="text-danger">{{$message}}</small> @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Destination</label>
                                    <div class="time-icon">
                                        <input type="text" class="form-control" id="datetimepicker3" name="destination"
                                            placeholder="Barangay/City/Province">
                                    </div>
                                 @error('destination') <small class="text-danger">{{$message}}</small> @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Days of Trip</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker daytripInput" readonly
                                            name="daytrip">
                                    </div>
                                     @error('daytrip') <small class="text-danger">{{$message}}</small> @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Car Price Per Day</label>
                                    <input class="form-control carPriceVal" readonly type="text" name="admincars_id"
                                        value="{{ $data->carprice }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>License number</label>
                                    <input class="form-control" type="text" name="license" value="">
                                </div>
                                @error('license') <small class="text-danger">{{$message}}</small> @enderror

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="status" id="" value="pending">
                                </div>

                            </div>
                        </div>
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="car_by_id" value="{{ $data->id }}">
                                </div>
                            </div>
                        </div>
                        <div class="row formtype">
                                <div class="form-group">
                                <input style="margin-left: 20px;" type="checkbox" id="" name="" value="" required> <a href=""data-toggle="modal" data-target="#exampleModal">I have Accept the Terms and Conditions</a>
                                </div>
                                @include('modal.terms')
                                <br>
                            </div>
                            <br>


                        <div class="col-12" style="padding-left: 3%;">

                            <p style="font-weight: bold;">Total Payment: <span style="color: red" class="totalPayment"></span></p>
                            <input type="hidden" class="inputtotalPayment" name="totalPayment">

                        </div>
                        @auth
                        <div class="col-12" style="padding-left: 3%; display: flex;">
                            <button type="submit" style="background-color: blue; width: 100%;" class="btn btn-primary">Create Booking</button>
                        </div>
                        @else
                        @endauth
                    </form>

                    @if(Session::has('message'))
                    <script>
                        swal({
                            title: "Congrats",
                            text: "{{ Session::get('message') }}",
                            icon: 'success',
                            buttons: {
                                ok: {
                                    text: 'Proceed to your details',
                                    value: 'ok',
                                },
                            },
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then((value) => {
                            if (value === 'ok') {
                                window.location.href = "../bookdetails/{{ Auth::user()->id }}";
                            }
                        });
                    </script>
                @endif

                </div>
                <br>
            </div>
        </div>


    </section>

    @include('custom-script')
@endsection
