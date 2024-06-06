
@php
    $selfUserDetail = \App\Models\User::all();
    $selfCarDetail = \App\Models\Admincar::all();
@endphp

<div id="selfdrive" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 1400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Selfdrive Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('store_booking_selfdrive')}}" method="post">
                    @csrf

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">

                                <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="self_user_id" id="self_name">

                                    @foreach ($selfUserDetail as $selfUser)
                                        <option value="{{ $selfUser->id }}">{{ $selfUser->name }}</option>
                                    @endforeach
                                </select>
                                @error('self_name') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="self_admincars_id" id="self_carname" onchange="selfUpdateCarPrice()">
                                    @foreach ($selfCarDetail as $selfCar)
                                        <option value="{{ $selfCar->id }}" data-price="{{ $selfCar->carprice }}">
                                            {{ $selfCar->carname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car Price </label>
                                <input class="form-control" type="number" id="self_carprice" readonly name="self_car_price" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Pick-up time </label>
                                <input class="form-control" type="time" name="self_pickuptime" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Pick-Up Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="self_pickupdate" name="self_pickupdate" onchange="selfUpdateDaysAndTotal()" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Drop-Off Time <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="self_dropofftime" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Drop-off Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="self_dropoffdate" name="self_dropoffdate" onchange="selfUpdateDaysAndTotal()" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Destination <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="self_destination" required>
                            </div>
                        </div>
                        <input type="hidden" name="self_status" value="pending">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Days of Trip <span class="text-danger">*</span></label>
                                <input type="number" class="form-control"  name="self_daytrip" id="self_daytrip"  readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">License Number </label>
                                <input class="form-control" type="text" name="self_license" required>
                            </div>
                        </div>
                        <input type="hidden" name="self_totalPrice" id="self_totalPriceInput">

                        <div class="table-responsive m-t-15">
                            <h1 name="self_totalPrice" id="self_totalPrice">Total Payment: $0</h1>

                        </div>
                        <div class="submit-section text-center mt-4">
                            <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                        </div>
                </form>


                @if(Session::has('self_message'))
                <script>
                    swal({
                        title: "Congrats",
                        text: "{{ Session::get('self_message') }}",
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
                            window.location.href = "{{url('bookingwithdriver')}}";
                        }
                    });
                </script>
            @endif

                        {{-- @if(Session::has('message'))
                        <script>
                            swal("Message","{{ Session::get('message') }}",'success'{
                                button:true,
                                button:'OK'
                                dangerMode:true,
                        });
                        </script>
                        @endif --}}

            </div>
        </div>
    </div>
</div>






<script>
        document.addEventListener('DOMContentLoaded', function() {
            selfUpdateCarPrice(); // Set the initial car price when the page loads
        });

        function selfUpdateCarPrice() {
            var carSelect = document.getElementById('self_carname');
            if (!carSelect) {
                console.error("Car select element not found.");
                return;
            }
            if (carSelect.selectedIndex === -1) {
                console.error("No car selected.");
                return; // Exit if no car is selected
            }

            var selectedOption = carSelect.options[carSelect.selectedIndex];
            if (!selectedOption) {
                console.error("No option selected.");
                return;
            }

            var carPrice = selectedOption.getAttribute('data-price');
            if (!carPrice) {
                console.error("No data-price attribute found on the selected option.");
                return; // Exit if no data-price attribute is found
            }

            console.log("Car Price:", carPrice); // Log the car price to the console for debugging
            document.getElementById('self_carprice').value = carPrice; // Set the car price in the input field
        }

    // This function is intended for recalculating days and total payment if needed
    function selfUpdateDaysAndTotal() {
        var pickupDate = document.getElementById('self_pickupdate').value;
        var dropoffDate = document.getElementById('self_dropoffdate').value;
        if (pickupDate && dropoffDate) {
            var start = new Date(pickupDate);
            var end = new Date(dropoffDate);
            var diff = end - start;
            var days = Math.max(1, Math.ceil(diff / (1000 * 60 * 60 * 24)));

            document.getElementById('self_daytrip').value = days;
            var carPrice = parseFloat(document.getElementById('self_carprice').value) || 0;
            var total = days * carPrice;
            document.getElementById('self_totalPrice').innerText = "Total Payment: $" + total.toFixed(2);
            document.getElementById('self_totalPriceInput').value = total; // Update hidden input for form submission
        }
    }
    </script>






























{{-- <script>
    function updateCarPrice() {
        const carSelect = document.getElementById('carname');
        const selectedOption = carSelect.options[carSelect.selectedIndex];
        const carPrice = selectedOption.getAttribute('data-price');
        document.getElementById('carprice').value = carPrice; // Update the car price input
        updateTotal();
    }

    function updateTotal() {
        const dayTripInput = document.getElementById('daytrip');
        const pickUpDate = new Date(document.getElementById('pickupdate').value);
        const dropOffDate = new Date(document.getElementById('dropoffdate').value);
        const diffTime = Math.abs(dropOffDate - pickUpDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        dayTripInput.value = diffDays; // Update Days of Trip

        const carPrice = parseFloat(document.getElementById('carprice').value || 0);
        const totalPrice = diffDays * carPrice;

        document.getElementById('totalPrice').innerText = `Total Payment: ${totalPrice.toFixed(2)}`;
    }

    // Add event listeners to update total when dates or car selection changes
    document.getElementById('pickupdate').addEventListener('change', updateTotal);
    document.getElementById('dropoffdate').addEventListener('change', updateTotal);
    document.getElementById('carname').addEventListener('change', updateCarPrice);

    // Call updateCarPrice on page load to initialize values correctly
    window.onload = updateCarPrice;
    </script> --}}

{{-- <script>
    function updateCarPrice() {
        const carSelect = document.getElementById('carname');
        const carPrice = carSelect.options[carSelect.selectedIndex].getAttribute('data-price');
        const carPriceInput = document.getElementById('carprice');
        carPriceInput.value = carPrice; // Update the car price input

        calculateTotal(); // Call calculate total when car or dates change
    }

    function calculateTotal() {
        const startDate = new Date(document.getElementById('pickupdate').value);
        const endDate = new Date(document.getElementById('dropoffdate').value);
        const diffTime = Math.abs(endDate - startDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        const carPrice = parseFloat(document.getElementById('carprice').value);
        if (!isNaN(diffDays) && !isNaN(carPrice)) {
            const totalPrice = diffDays * carPrice;
            document.getElementById('totalPrice').innerText = `Total Payment: ${totalPrice.toFixed(2)}`;
        }

        // Update the Days of Trip input
        if (!isNaN(diffDays)) {
            document.getElementById('daytrip').value = diffDays;
        }
    }

    // Add event listeners
    document.getElementById('pickupdate').addEventListener('change', calculateTotal);
    document.getElementById('dropoffdate').addEventListener('change', calculateTotal);

    window.onload = updateCarPrice; // Initial update on page load if a car is already selected
    </script> --}}

