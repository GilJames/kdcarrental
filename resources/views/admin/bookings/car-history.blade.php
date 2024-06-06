<div class="modal fade " id="viewHistoryAll{{ $car->id }}" tabindex="-1" role="dialog"
    aria-labelledby="viewHistoryAllLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="viewHistoryAllLabel">Car History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Sr.</th>
                                <th scope="col">Customers</th>
                                <th scope="col">Pickup date</th>
                                <th scope="col">Dropoff date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @if ($car->count() > 0)
                            @foreach ($car->bookings as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->pickupdate }}</td>
                                    <td>{{ $item->dropoffdate }}</td>
                                    <td>

                                        <div>
                                            <a href="" data-toggle="modal" data-target="#view{{$item->id}}"> View Details</a>
                                        </div>

                                    </td>
                                </tr>
                                @include('modal.view-carhistory-withdriver')
                                @endforeach

                            @foreach ($car->selfbookings as $item)
                            <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->pickupdate }}</td>
                                    <td>{{ $item->dropoffdate }}</td>
                                    <td>

                                        <div>
                                            <a href="" data-toggle="modal" data-target="#viewHistory{{$item->id}}"> View Details</a>
                                        </div>

                                    </td>
                            </tr>
                            @include('modal.view-carhistory-selfdrive')
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center text-danger">No data found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {{-- <div class="clearfix">
                        <hr>
                    {{$bookings->links()}}
                    </div> --}}
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success submitConfirm"
                    onclick="submitClick({{ $book->id }},'confirm', 'viewHistoryAll{{ $key }}', 'bookingModel')">Confirm</button>
            </div> --}}
        </div>
    </div>
</div>
