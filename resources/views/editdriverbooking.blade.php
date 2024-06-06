@extends('layouts.rentcar')
@include('custom-style')
@section('title', 'Car Listing')

@section('content')
    <section class="page-header listing_page">
        <div class="container">
            <div class="page-header_wrap">
                <div class="page-heading">
                    {{-- <h1>View Car Details</h1> --}}
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
                    <div class="row" style="margin:15px;">
                        <div class="col-lg-12">
                            <h3 class="page-title mt-5" style="text-align:Center; margin-bottom:10%;">Update Booking Form
                            </h3>
                            <form action="{{ url('updateuserbooking') }}" method="POST">
                                @csrf
                                <div class="row formtype">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Cars List</label>
                                            <select data-bk_id="{{ $data->id }}" class="form-control carListSelect"
                                                id="carList" name="admincars_idSelect">
                                                @foreach ($datas as $cr)
                                                    <option {{ $data->admincar->id == $cr->id ? 'selected' : '' }}
                                                        value="{{ $cr->id }}" data-price="{{ $cr->carprice }}">
                                                        {{ ucfirst($cr->carname) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                    {{-- Pick up date --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pickup Date</label>
                                            <input class="form-control pickupdateInput dateInput date_picker" type="date"
                                                required id="pickupdate" name="pickupdate"value="{{ $data->pickupdate }}">
                                            {{-- @error('pickupdate') <small class="text-danger">{{$message}}</small> @enderror --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pickup Time</label>
                                            <input class="form-control" type="time" id="appt"
                                                name="pickuptime"value="{{ $data->pickuptime }}" required />
                                            {{-- @error('pickuptime') <small class="text-danger">{{$message}}</small> @enderror --}}

                                        </div>
                                    </div>

                                    {{-- Dropoff date --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>DropoffDate</label>
                                            <input class="form-control dropoffdateInput dateInput date_picker"
                                                type="date" required id="dropoffdate"
                                                name="dropoffdate"value="{{ $data->dropoffdate }}">
                                            {{-- @error('dropoffdate') <small class="text-danger">{{$message}}</small> @enderror --}}

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>DropoffTime</label>
                                            <input class="form-control" type="time" id="appt"
                                                name="dropofftime"value="{{ $data->dropofftime }}" required />
                                            {{-- @error('dropofftime') <small class="text-danger">{{$message}}</small> @enderror --}}

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Destination</label>
                                            <div class="time-icon">
                                                <input type="text" class="form-control" id="datetimepicker3"
                                                    name="destination"value="{{ $data->destination }}"
                                                    placeholder="Barangay/City/Province">
                                            </div>
                                            {{-- @error('destination') <small class="text-danger">{{$message}}</small> @enderror --}}

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Days of Trip</label>
                                            <div class="cal-icon">
                                                <input type="text" class="form-control datetimepicker daytripInput"
                                                    readonly disabled name="daytrip"value="{{ $data->daytrip }}">
                                            </div>
                                            {{-- @error('daytrip') <small class="text-danger">{{$message}}</small> @enderror --}}

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Car Price Per Day</label>

                                            <input class="form-control carPriceHere text-danger carPriceVal" readonly
                                                type="text" name="admincar_price" id="carprice"
                                                value="{{ $data->admincar->carprice }}">

                                        </div>

                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" id="sel3" type="hidden" name="status">
                                                <option value="pending">pending</option>
                                            </select>
                                        </div>
                                        <div class="row formtype">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input class="form-control" type="hidden" name="bookingId"
                                                        value="{{ $data->id }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12" style="padding-left: 3%; display: flex;">
                                        <div>
                                            <h3>Total Payment: <span class="totalPayment"></span></h3>
                                        </div>
                                    </div>


                                    @auth
                                    <div class="col-12" style="padding-left: 3%; display: flex;">
                                        <button type="submit" style="background-color: blue; width: 100%;" class="btn btn-primary" style="float:right;">Update
                                            Booking</button>
                                    </div>

                                    @else
                                    @endauth
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @include('editcustom-script')
    <script>
        daysofTrip();
        totalPayment();
        $(document).ready(function() {
            $('.carListSelect').change(function() {
                var selectedValue = $(this).val();

                $.ajax({
                    url: '{{ route('getCarPrice') }}',
                    type: 'get',
                    data: {
                        id: selectedValue,
                    },
                    success: function(response) {
                        // Handle success, if needed
                        // location.reload();
                        // console.log(response);
                        $('.carPriceHere').val(response.id.carprice);
                    },
                    error: function(error) {
                        // Handle error, if needed
                        console.log(error);
                    }
                });
            });
        });
    </script>
    @if (Session::has('message'))
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
@endsection
