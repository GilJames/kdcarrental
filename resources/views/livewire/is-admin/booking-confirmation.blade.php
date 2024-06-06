@component('mail::message')
<div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px; font-family: Arial, sans-serif;">
    <h2 style="color: #333; font-size: 20px;">Great News! Your Booking is Confirmed</h2>
    <p style="color: #666;">Please visit our store on the specified date for a smooth pick-up and an easy payment process.</p>
    <p style="color: #666;">Your exciting journey with us is about to begin. Enjoy the ride!</p>
    <hr style="border-top: 1px solid #ddd;">
    <p style="color: #333; font-weight: bold;">Booking Details:</p>
    <p><strong>Pickup Date:</strong> {{ $booking->pickupdate }}</p>
    <p><strong>Pickup Time:</strong> {{ $booking->pickuptime }}</p>
    <p><strong>Dropoff Date:</strong> {{ $booking->dropoffdate }}</p>
    <p><strong>Dropoff Time:</strong> {{ $booking->dropofftime }}</p>
    <p><strong>Destination:</strong> {{ $booking->destination }}</p>
    <p><strong>Day Trip:</strong> {{ $booking->daytrip }} days</p>
    <hr style="border-top: 1px solid #ddd;">
    @component('mail::button', ['url' => 'https://www.facebook.com/profile.php?id=61552501830668'])
        For more info, visit our Facebook page
    @endcomponent
    <p style="margin-top: 15px; color: #666;">Thank you for choosing our service!</p>
</div>
@endcomponent
