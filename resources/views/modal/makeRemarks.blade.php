<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .modal-title {
        font-weight: bold;
        font-size: 100%;
        /* Adjust as needed */
    }

    /* Define the media query for smaller screens */
    @media (max-width: 768px) {

        .reviewBtn,
        .commentHere,
        .modal-title {
            font-size: 100%;
            /* Adjust for smaller screens */
        }
    }

    /* Define the media query for even smaller screens */
    @media (max-width: 576px) {
        .modal-title {
            font-size: 100%;
            /* Adjust for even smaller screens */
        }
    }

    .modal-content {

        background-color: whitesmoke;

    }

    .modal-dialog {

        width: 80%;
        height: 80px;


    }

    textarea {

        padding: 80px;
    }

    .btn btn-success:hover {
        background-color: red;

    }

    h4 {
        text-align: center;
    }

    .rating-container {
        display: flex;
        align-items: center;
        /* Change from column to row */
        flex-direction: row;
    }

    .rating-checkbox {
        display: none !important;
    }

    .fa-star {
        font-size: 2em;
        color: #ccc;
        cursor: pointer;
        margin-right: 10px;
        /* Add margin between icons */
        transition: color 0.3s ease;
    }

    .fa-star:hover {
        color: #3498db;
    }

    .fa-star.checked {
        color: #f39c12;
    }
    .modal-content {
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,.2);
}

.modal-title {
    color: #495057;
}

.rating-container .fas {
    font-size: 24px;
    color: #ddd; /* Default star color */
    cursor: pointer;
}

.rating-container .fas:hover,
.rating-container input:checked ~ .fas {
    color: #ffc107; /* Gold color for active stars */
}

.rating-input {
    display: none;
}

.text-secondary {
    color: #6c757d !important;
}
.booking-details .details-heading {
    color: #495057; /* Darker shade for heading */
    margin-bottom: 1rem; /* Adds space below the heading */
}

.booking-details .detail {
    color: #333; /* Dark text for better readability */
    margin-bottom: 0.5rem; /* Adds space between each detail */
    padding-left: 1rem; /* Adds padding to align text nicely under the heading */
}

/* General enhancements for the booking details container */
.booking-details {
    background-color: #f8f9fa; /* Light background for the container */
    border-left: 5px solid #007bff; /* Adds a blue left border for emphasis */
    padding: 1rem; /* Padding around the content inside the container */
    border-radius: 5px; /* Rounded corners */
    box-shadow: 0 2px 4px rgba(0,0,0,.1); /* Subtle shadow for depth */
}

/* Styling for strong tags to ensure they stand out */
.booking-details strong {
    color: #0056b3; /* Blue color for strong tags making them stand out */
}

</style>
<div class="modal fade text-left" id="makeRemarks_{{ $book->id }}{{ $key }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remarks for {{ $book->user->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Start Form -->
            <form action="{{ url('userRemarks') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <!-- Car Image Column -->
                        <div class="col-md-6">
                            <img src="{{ asset('../uploads/profile/' . $book->user->photo) }}" alt="User Image"
                                 class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
                            <div class="mt-3 p-2 bg-light rounded booking-details">
                                <h6 class="details-heading">Booking Details:</h6>
                                <p class="detail"><strong>Car Name:</strong> {{ $book->admincar->carname ?? 'Not Specified' }}</p>
                                <p class="detail"><strong>Pick-Up:</strong> {{ $book->pickupdate ?? 'Not Specified' }}</p>
                                <p class="detail"><strong>Drop-Off:</strong> {{ $book->dropoffdate ?? 'Not Specified' }}</p>
                                <p class="detail"><strong>Destination:</strong> {{ $book->destination ?? 'Not Specified' }}</p>
                            </div>
                        </div>

                        <!-- Rating and Comment Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="booking_id" value="{{ $book->id }}">
                                <input type="hidden" name="cars_id" value="{{ $book->id }}">
                                <input type="hidden" name="model" value="withdrive">
                                <label class="font-weight-bold">Rate 1-5</label>
                                <div class="rating-container">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="checked" class="rating-checkbox" id="star{{ $i }}{{ $key }}{{ $book->id }}">
                                        <label onclick="rateStar({{ $i }}, {{ $key }}, {{ $book->id }})" for="star{{ $i }}{{ $key }}{{ $book->id }}">
                                            <i class="fas fa-star"></i>
                                        </label>
                                    @endfor
                                </div>
                                <input type="hidden" name="rate" id="ratingValue{{ $key }}{{ $book->id }}" value="">
                                @error('rating')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <p class="commentHere font-weight-bold">Please Comment Your Review</p>
                            <textarea class="form-control rounded" name="comment" placeholder="Your Review" style="height: 150px;" required></textarea>
                            @error('comment')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="background-color: red; color: white;">Back</button>
                    <button type="submit" class="btn btn-primary" style="background-color: green; color: white;">Submit</button>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
</div>




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
                        window.location.href = "{{ url('viewcardetails/' . $book->admincar->id) }}";
                    }
                });
            </script>
        @endif

    </div>
</div>

<!-- WITH REVIEWS NI SHA NA MODAL -->
{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
<script>
    function rateStar(rating, key, id) {
        // Find the modal associated with the clicked button
        var modalSelector = '#ModalCreate_' + id + key;

        // Uncheck all checkboxes within the specific modal
        $(modalSelector + ' .rating-checkbox').prop('checked', false);

        // Check the selected checkbox within the specific modal
        $(modalSelector + ' #star' + rating + key + id).prop('checked', true);

        // Change the color or apply any dynamic styling based on the rating
        $(modalSelector + ' .fa-star').removeClass('checked');
        $(modalSelector + ' .fa-star:lt(' + rating + ')').addClass('checked');

        // Update hidden input value
        $(`#ratingValue${key}${id}`).val(rating);
    }
</script>
