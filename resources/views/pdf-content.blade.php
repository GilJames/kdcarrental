<div>
    <table class="tble">
        <tr>
            <th class="head">Or #</th>
            <th>Booker</th>
            <th class="head">Vehicle Name</th>
            <th class="head">Vehicle Model</th>
            <th class="head">Pickup Date</th>
            <th class="head">Dropoff Date</th>
            <th class="head">Rental Days</th>
            <th class="head">Rental Total</th>
        </tr>
        {{-- @foreach ($bookings as $key => $book)
            <tr>
                <td class="data">{{ $book->confirmed_OR ?? 'N/A' }}</td>
                <td class="data" style="text-align:center;">{{ ucfirst($book->user->name) }}</td>
                <td class="data" style="text-align:center;">{{ ucfirst($book->admincar->carname) }}</td>
                <td class="data">{{ ucfirst($book->admincar->carmodel) }}</td>
                <td class="data">{{ \Carbon\Carbon::parse($book->pickupdate)->format('F d, Y') }}</td>
                <td class="data">{{ \Carbon\Carbon::parse($book->dropoffdate)->format('F d, Y') }}</td>
                <td class="data">{{ $book->daytrip }}</td>
                <td class="data">{{ $book->total_payment }}</td>
            </tr>
        @endforeach --}}


    </table>
</div>