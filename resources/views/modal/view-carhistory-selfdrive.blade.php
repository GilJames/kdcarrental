<div class="modal fade " id="viewHistory{{$item->id}}" tabindex="-1" role="dialog"
    aria-labelledby="view" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="viewHistory">Selfdrive Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <div class="modal-body">
            <div class="card">
                    <br>

                        <img src="{{ asset('../uploads/car/' . $item->admincar->image) }}" alt="" width="450px;" height="350px;" style="margin-left: 33%;">
                        <br>
                        <div class="pos">
                            <span style="margin-right: 70%;"class="spn"> <b>Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{$item->user->name}}</b></span><br>
                            <span style="margin-right: 70%;"class="spn"><b>Carname:</b>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<b>{{$item->admincar->carname}}</b></span><br>
                            <span style="margin-right:70%;"class="spn"><b>Pickupdate:</b> &nbsp;&nbsp;&nbsp;<b>{{ \Carbon\Carbon::parse($item->pickupdate)->format('F d, Y') }}</b></span><br>
                            <span style="margin-right:70%;"class="spn"><b>Dropoffdate:</b>&nbsp;&nbsp;&nbsp;<b>{{ \Carbon\Carbon::parse($item->dropoffdate)->format('F d, Y') }}</b></span><br>
                            <span style="margin-right:70%;"class="spn"><b>License:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{$item->license}}</b></span><br>
                            <span style="margin-right:70%;"class="spn"><b>Destination:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{$item->destination}}</b></span><br>
                            <span style="margin-right:70%;"class="spn"><b>Days of Trips:</b>&nbsp;&nbsp;&nbsp;<b>{{$item->daytrip}}</b></span><br>
                            <span style="margin-right:70%;"class="spn"><b>Carprice:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{$item->admincar->carprice}}</b></span><br>
                            <div style="margin-right:70%;"class="spn"><b>Status:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>
                            @if ($item->status == 'confirm')
                            <span class="btn btn-sm bg-success-light mr-2">Released</span>
                        @elseif($item->status == 'reject')
                            <span class="btn btn-sm bg-danger-light mr-2">Reject</span>
                        @elseif($item->status == 'completed')
                            <span class="btn btn-sm bg-warning-light mr-2">Completed</span>
                        @elseif($item->status == 'cancelled')
                            <span class="btn btn-sm bg-warning-light mr-2">Cancelled</span>
                        @elseif($item->status == 'pending')
                            <span class="btn btn-sm bg-danger-light mr-2">Pending</span>
                        @elseif($item->status == 'To_pay')
                            <span class="btn btn-sm bg-warning-light mr-2">To Pay</span>
                        @endif
</b>

                        </div>



                </div>


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

<style>
   .modal-body .card .detail{
        float:right;
        text-align:center;
    }
    .pos{
        margin-right: 44%;
    }
    .spn{
        font-size: 28px;
    }
    img{
        /* border: 2px solid #000; */
    }
</style>



