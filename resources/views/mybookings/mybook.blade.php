@extends('layouts.rentcar')
@section('title', 'My Bookings')
@section('content')

<div class="card-container">
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    {{-- Sub cards --}}
    @foreach($data as $booking)
    <div class="sub-cards">
        <div class="card small">
            <!-- Image added above the Name -->
            <div class="card-header">
                <img src="{{ asset('uploads/car/'.$booking->admincar->image) }}" alt="Car Image" class="car-image">
            </div>
            <div class="card-body">
                <div class="card-text"><strong>Car Model:</strong> {{ $booking->carmodel }}</div>
                <div class="card-text"><strong>Name:</strong> {{ Auth::user()->name }}</div>
                <div class="card-text"><strong>Destination:</strong> {{ $booking->destination }}</div>
                <div class="card-text"><strong>Pick-Up Date:</strong> {{ $booking->pickupdate }}</div>
                <div class="card-text"><strong>Drop-Off Date:</strong> {{ $booking->dropoffdate }}</div>
                <div class="card-text"><strong>Days of Trip:</strong> {{ $booking->daytrip }}</div>
                <div class="card-text">
                    <strong>Expiration Time:</strong>
                    <span class="expiration-time" data-expiration-time="{{ $booking->expiration_time ? $booking->expiration_time->toIso8601String() : 'Not set' }}">
                        {{ $booking->expiration_time ? $booking->expiration_time->toDayDateTimeString() : 'No expiration time set' }}
                    </span>                </div>
                <div class="card-text"><strong>Status:</strong> {{ $booking->status }}</div>
                <hr>
                <div class="card-text"><strong>Total Payment:</strong> P{{ $booking->carprice }}</div>
                <div class="card-actions">
                    <a href="" class="upload-link">UPLOAD GCASH PROOF OF PAYMENT</a>
                    <button type="button" class="cancel-button" data-toggle="modal" data-target="#cancelModal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{ $data->links() }} {{-- Pagination links --}}
</div>

@endsection

<style>
    .card-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 50px;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .alert {
        margin-bottom: 20px;
    }

    .sub-cards {
        display: flex;
        justify-content: center; /* Center sub-cards horizontally */
        flex-wrap: wrap; /* Allow sub-cards to wrap on smaller screens */
        gap: 20px; /* Adds space between sub-cards */
    }

    .card.small {
        width: 300px; /* Adjust width as needed */
        background: #fff; /* White background */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
        overflow: hidden; /* Clip the content within the card */
        transition: transform 0.2s ease-in-out; /* Smooth transform effect */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card.small:hover {
        transform: translateY(-5px); /* Lift the card slightly on hover */
    }

    .card-header {
        text-align: center;
        background: #e9e9e9; /* Light grey background for header */
        padding: 10px;
    }

    .car-image {
        width: 100%;
        height: auto;
        border-bottom: 1px solid #ddd; /* Subtle separator line */
    }

    .card-body {
        padding: 20px;
        color: #333; /* Dark text color */
    }

    .card-text {
        margin-bottom: 10px;
        font-size: 14px; /* Slightly smaller text size */
        color: #555; /* Slightly lighter text color */
    }

    .card-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        border-top: 1px solid #ddd; /* Subtle separator line */
        background: #f9f9f9; /* Light background for actions */
    }

    .upload-link {
        color: #007BFF; /* Blue link color */
        text-decoration: none;
        font-weight: bold;
    }

    .upload-link:hover {
        text-decoration: underline; /* Underline on hover */
    }

    .cancel-button {
        padding: 8px 16px;
        background-color: #f44336; /* Red color for cancel actions */
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .cancel-button:hover {
        background-color: #d32f2f; /* Darker shade for hover effect */
    }

    /* Modal Customizations */
    .modal-dialog.modal-lg {
        max-width: 800px; /* Increased width */
    }

    .modal-header {
        border-bottom: 1px solid #dee2e6;
        padding: 1rem 1.5rem;
    }

    .modal-title {
        margin-bottom: 0;
        line-height: 1.5;
        font-size: 1.25rem;
    }

    .modal-body {
        position: relative;
        flex: 1 1 auto;
        padding: 1.5rem;
        color: #333;
        background-color: #f4f4f4;
    }

    .modal-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 1rem 1.5rem;
        border-top: 1px solid #dee2e6;
    }
    </style>

<script>
            document.addEventListener('DOMContentLoaded', function() {
                const expirationElements = document.querySelectorAll('.expiration-time');

                expirationElements.forEach(element => {
                    const expirationTimeString = element.getAttribute('data-expiration-time');
                    console.log("Expiration Time String:", expirationTimeString); // Verify the actual string in the console

                    if (!expirationTimeString || expirationTimeString === 'Not set') {
                        element.textContent = 'No expiration time set';
                        return; // Stop processing this element further
                    }

                    const expirationDate = new Date(expirationTimeString);
                    if (isNaN(expirationDate)) {
                        console.log("Failed to parse date:", expirationTimeString);
                        element.textContent = 'Invalid date format';
                        return;
                    }

                    function updateExpirationTime() {
                        const now = new Date();
                        const diff = expirationDate - now;

                        if (diff <= 0) {
                            element.textContent = 'Expired';
                        } else {
                            const hours = Math.floor(diff / (1000 * 60 * 60));
                            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                            element.textContent = `${hours}h ${minutes}m ${seconds}s remaining`;
                        }
                    }

                    updateExpirationTime();
                    setInterval(updateExpirationTime, 1000);
                });
            });



    </script>
