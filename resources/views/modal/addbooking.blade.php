
@php
    $users = \App\Models\User::all();
    $cars = \App\Models\Admincar::all();

@endphp

<div id="addbooking" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add With Driver Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('store_booking_withdriver')}}" method="post">
                    @csrf

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">

                                <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="user_id" id="name">

                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('name') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="carname" id="carname" onchange="updateCarPrice()">
                                    @foreach ($cars as $car)
                                        <option value="{{ $car->id }}" data-price="{{ $car->carprice }}">{{ $car->carname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car Price </label>
                                <input class="form-control" type="number"  id="carprice" readonly name="car_price" required  >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Pick-up time </label>
                                <input class="form-control" type="time" name="pickuptime" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Pick-Up Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="pickupdate" name="pickupdate" onchange="updateDaysAndTotal()" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Drop-Off Time <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="dropofftime" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Drop-off Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="dropoffdate" name="dropoffdate" onchange="updateDaysAndTotal()" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Destination <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="destination" required>
                            </div>
                        </div>
                        <input type="hidden" name="status" value="pending">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Days of Trip <span class="text-danger">*</span></label>
                                <input type="number" class="form-control"  name="daytrip" id="daytrip"  readonly>
                            </div>
                        </div>
                        <input type="hidden" name="totalPrice" id="totalPriceInput">

                    <div class="table-responsive m-t-15">
                        <h1 name="totalPrice" id="totalPrice">Total Payment: $0</h1>

                    </div>
                    <div class="submit-section text-center mt-4">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                </form>


                @if(Session::has('message'))
                <script>
                    swal({
                        title: "Congrats",
                        text: "{{ Session::get('message') }}",
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
    function updateCarPrice() {
        var carSelect = document.getElementById('carname');
        var carPrice = carSelect.options[carSelect.selectedIndex].getAttribute('data-price');
        document.getElementById('carprice').value = carPrice;
        updateDaysAndTotal();  // Recalculate everything if car is changed
    }

    function updateDaysAndTotal() {
    var pickupDate = document.getElementById('pickupdate').value;
    var dropoffDate = document.getElementById('dropoffdate').value;
    var carPrice = parseFloat(document.getElementById('carprice').value) || 0;

    if (pickupDate && dropoffDate) {
        var start = new Date(pickupDate);
        var end = new Date(dropoffDate);
        var diff = end - start;
        var days = Math.ceil(diff / (1000 * 60 * 60 * 24)); // Calculate full days

        // Ensure minimum of 1 day rental
        if (days < 1) {
            days = 1;
        }

        document.getElementById('daytrip').value = days;
        var total = days * carPrice;
        document.getElementById('totalPrice').innerText = "Total Payment: $" + total.toFixed(2);
    }
}

    // Initial setup when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        updateCarPrice(); // To set initial car price when page loads
    });
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

