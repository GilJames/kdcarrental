 {{-- Seld drive Table --}}
 <div id="selfDrivetableParentClass"
     class="table-responsive {{ session('selectedOption') != 'selfDrive' ? 'd-none' : '' }}">

     @if (session('info'))
         <div class="alert alert-success" role="alert">{{ session('info') }}</div>
     @endif


     <label><b>Filter by status</b></label>
     <div class="row">
         <div class="col-12 col-md-6 mb-2">
             <form action="" method="GET">
                 <div class="row">
                     <div class="col-md-3 col-8">
                         <select name="status" class="form-control">
                             <option value="">Any</option>
                             <option value="pending">Pending</option>
                             <option value="To_pay">To pay</option>
                             <option value="confirm">Released</option>
                             <option value="completed">Completed</option>
                             <option value="reject">Rejected</option>
                             <option value="cancelled">Cancelled</option>
                         </select>
                     </div>
                     <div class="col-md-6 col-4 mb-3">
                         <button type="submit" class="btn btn-primary">Filter</button>
                     </div>
                 </div>
             </form>
         </div>
         <div class="col-12 col-md-6 mb-2">
             <div class="row">
                 <div class="col-sm-12 col-md-7 offset-md-5 ">
                     <form action="" method="GET">
                         <div class="input-group">
                             <input type="text" name="searchBooking" class="form-control" placeholder="Search...">
                             <div class="input-group-append">
                                 <span class="input-group-text">
                                     <button type="submit" class="fa fa-search"></button>
                                 </span>
                                 @if (request()->has('searchBooking') && request()->input('searchBooking') != '')
                                     <a href="{{ url('bookingwithdriver') }}" class="btn btn-outline-secondary">
                                         Clear
                                     </a>
                                 @endif
                             </div>
                         </div>
                     </form>
           

                 </div>
             </div>
         </div>
         <div class="d-flex justify-content-end mt-1">
                <button type="button" class="btn btn-success" style="margin-left: 84rem;"data-toggle="modal" data-target="#selfdrive">
                    <i class="fa-solid fa-eye m-r-5"></i> AddSelfBooking
                </button>
            </div>
            @include('modal.addselfbooking');

            <br>
     </div>
   
    



     <table id="selfDriveTableWrapper" class="datatable table table-striped table-hover table-center table-bordered mb-0">
        <br>
         <thead>
             <tr>
                 <th>#</th>
                 <th>Name</th>
                 <th>PickupDate</th>
                 <th>PickupTime</th>
                 <th>DropoffDate</th>
                 <th>Dropofftime</th>
                 <th>Destination</th>
                 <th>Days of trips</th>
                 <th>Carname</th>
                 <th>Car price</th>
                 <th>License</th>
                 <th>Booking Status</th>
                 <th>Action</th>
                 <th></th>
                 <th></th>
             </tr>
         </thead>
         <tbody>
            @if ($selfdrive->count() > 0)
             @foreach ($selfdrive as $key => $book)
                 <tr>
                     <th>{{ $key + 1 }}</th>
                     <th>{{ $book->user->name }}</th>
                     <td>{{ \Carbon\Carbon::parse($book->pickupdate)->format('F d, Y') }}</td>
                     <td>{{ \Carbon\Carbon::parse($book->pickuptime)->format('h:i A') }}</td>
                     <td>{{ \Carbon\Carbon::parse($book->dropoffdate)->format('F d, Y') }}</td>
                     <td>{{ \Carbon\Carbon::parse($book->dropofftime)->format('h:i A') }}</td>
                     <td>{{ $book->destination }}</td>
                     <td>{{ $book->daytrip }}</td>
                     <td>{{ $book->admincar->carname }}</td>
                     <td>{{ $book->admincar->carprice }}</td>
                     <td>{{ $book->license }}</td>

                     <td>
                        @if ($book->status == 'confirm')
                            <span class="btn btn-sm bg-success-light mr-2 badge">Released</span>
                        @elseif($book->status == 'reject')
                            <span class="btn btn-sm bg-danger-light mr-2 badge">Reject</span>
                        @elseif($book->status == 'completed')
                            <span class="btn btn-sm bg-warning-light mr-2 badge">Completed</span>
                        @elseif($book->status == 'cancelled')
                            <span class="btn btn-sm bg-warning-light mr-2 badge">Cancelled</span>
                        @elseif($book->status == 'pending')
                            <span class="btn btn-sm bg-danger-light mr-2 badge">Pending</span>
                        @elseif($book->status == 'To_pay')
                            <span class="btn btn-sm bg-warning-light mr-2 badge">To Pay</span>
                        @elseif($book->status == 'expired')
                            <span class="btn btn-sm bg-danger-light mr-2 badge">Expired</span>
                        @endif
                    </td>
                     <td>
                        <div>
                            <a href="#" data-toggle="modal" title="View Details" data-target="#view{{$book->id}}">
                                <button type="button" class="btn btn-success" style="padding: 5px 10px; font-size: 12px;">
                                    <i class="fa-solid fa-eye m-r-5"></i>View
                                </button>
                            </a>
                        </div>
                         {{-- Modal View --}}

                     @include('modal.viewbookselfdrive')

                         <div id="delete_asset" class="modal fade delete-modal" role="dialog">
                             <div class="modal-dialog modal-dialog-centered">
                                 <div class="modal-content">
                                     <div class="modal-body text-center"> <img src="new_admin/assets/img/sent.png"
                                             alt="" width="50" height="46">
                                         <h3 class="delete_class">Are you sure want to
                                             delete this Asset?</h3>
                                         <div class="m-t-20"> <a href="#" class="btn btn-white"
                                                 data-dismiss="modal">Close</a>
                                             <a href=""><button type="submit"
                                                     class="btn btn-danger">Delete</button></a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </td>


                     {{-- Self Drive confirm --}}
                     @if ($book->status != 'cancelled')
                         @if ($book->status != 'reject')
                             <td>
                                 @if ($book->status == 'To_pay')
                                     <a href="#" class="btn btn-success btn-sm statusClick" style="padding: 5px 10px; font-size: 12px;" data-toggle="modal"
                                         data-target="#confirmModalSelf{{ $book->id }}"
                                         id="confirmButton{{ $book->id }}">Confirm</a>
                                     <div class="modal fade" id="confirmModalSelf{{ $book->id }}" tabindex="-1"
                                         role="dialog" aria-labelledby="confirmModalSelfLabel" aria-hidden="true">
                                         <div class="modal-dialog" role="document">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <h5 class="modal-title" id="confirmModalSelfLabel">
                                                        Transaction Number</h5>
                                                     <button type="button" class="close" data-dismiss="modal"
                                                         aria-label="Close">
                                                         <span aria-hidden="true">&times;</span>
                                                     </button>
                                                 </div>
                                                 <div class="modal-body">
                                                     <input
                                                         value="{{ $book->confirmed_OR != null ? $book->confirmed_OR : '' }}"
                                                         class="form-control" type="number" min="1"
                                                         id="officialReceipt{{ $book->id }}" />
                                                     <input type="hidden" id="confirmStatus{{ $book->id }}"
                                                         value="confirm" />
                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-secondary"
                                                         data-dismiss="modal">Close</button>
                                                     <button type="button" class="btn btn-success submitConfirm"
                                                         onclick="submitClick({{ $book->id }},'confirm', 'confirmModalSelf{{ $book->id }}', 'selfDriveModel')">Confirm</button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                             </td>



                             <td>
                                 {{-- <a href="{{ url('rejectstatus', $book->id) }}" class="btn btn-danger">Reject</a> --}}
                                 <a href="#" class="btn btn-danger btn-sm statusClick" style="padding: 5px 10px; font-size: 12px;" data-toggle="modal"
                                     data-status="reject" data-target="#rejectModalSelf{{ $book->id }}"
                                     id="rejectButton{{ $book->id }}">Reject
                                 </a>

                                 <div class="modal fade" data-status="rejected" id="rejectModalSelf{{ $book->id }}"
                                     tabindex="-1" role="dialog" aria-labelledby="rejectModalSelfLabel"
                                     aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title" id="rejectModalSelfLabel">
                                                     Reason for Rejection</h5>
                                                 <button type="button" class="close" data-dismiss="modal"
                                                     aria-label="Close">
                                                     <span aria-hidden="true">&times;</span>
                                                 </button>
                                             </div>
                                             <div class="modal-body">
                                                 <textarea class="form-control" id="rejectionReason{{ $book->id }}"></textarea>
                                                 <input type="hidden" id="rejectionStatus{{ $book->id }}"
                                                     value="reject" />
                                             </div>
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary"
                                                     data-dismiss="modal">Close</button>
                                                 <button type="button" class="btn btn-danger submitReject"
                                                     onclick="submitClick({{ $book->id }},'reject','rejectModalSelf{{ $book->id }}', 'selfDriveModel')">Reject</button>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </td>


                             <td>
                             @elseif($book->status == 'pending')
                                 <a href="#" class="btn btn-warning btn-sm" style="padding: 5px 10px; font-size: 12px;"
                                     onclick="confirmToPay({{ $book->id }}, 'selfdrive');">To Pay</a>
                             </td>

                             <td>
                                 {{-- <a href="{{ url('rejectstatus', $book->id) }}" class="btn btn-danger">Reject</a> --}}
                                 <a href="#" class="btn btn-danger btn-sm statusClick" style="padding: 5px 10px; font-size: 12px;" data-toggle="modal"
                                     data-status="reject" data-target="#rejectModalSelf{{ $book->id }}"
                                     id="rejectButton{{ $book->id }}">Reject
                                 </a>

                                 <div class="modal fade" data-status="rejected"
                                     id="rejectModalSelf{{ $book->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="rejectModalSelfLabel" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title" id="rejectModalSelfLabel">
                                                     Reason for Rejection</h5>
                                                 <button type="button" class="close" data-dismiss="modal"
                                                     aria-label="Close">
                                                     <span aria-hidden="true">&times;</span>
                                                 </button>
                                             </div>
                                             <div class="modal-body">
                                                 <textarea class="form-control" id="rejectionReason{{ $book->id }}"></textarea>
                                                 <input type="hidden" id="rejectionStatus{{ $book->id }}"
                                                     value="reject" />
                                             </div>
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary"
                                                     data-dismiss="modal">Close</button>
                                                 <button type="button" class="btn btn-danger submitReject"
                                                     onclick="submitClick({{ $book->id }},'reject','rejectModalSelf{{ $book->id }}', 'selfDriveModel')">Reject</button>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </td>
                             @elseif($book->status == 'completed')
                        <td style="font-size: 30px; text-align: end">
                            <form action="{{ route('printPdf') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" value="{{ $book->id }}"
                                    name="book_id">
                                <button type="submit" class="view"
                                    title="Print Reciept" data-toggle="tooltip">
                                    <i class="fa fa-print fa-sm"
                                        aria-hidden="true" style="font-size: 20px;"></i>
                                </button>
                            </form>

                    </td>
                             <td>
                             @elseif($book->status == 'confirm')
                                 @php
                                     $model = 'selfdrive';
                                 @endphp
                                 <a href="{{ url('completedstatus/' . $book->id . '/' . $model) }}"
                                     class="btn btn-warning btn-sm" onclick=" return confirm ('Do you want to complete the book?')" style="padding: 5px 10px; font-size: 12px;">Completed</a>
                             </td>
                             <td style="font-size: 30px; text-align: end">
                                 @if ($book->status === 'confirm')
                                     <form action="{{ route('printPdf') }}" method="POST">
                                         @csrf
                                         <input type="hidden" value="{{ $book->id }}" name="book_id">
                                         <button type="submit" class="view" title="Print Reciept"
                                             data-toggle="tooltip">
                                             <i class="fa fa-print fa-sm" aria-hidden="true" style="font-size: 20px;"></i>
                                         </button>
                                     </form>
                                 @endif
                         @endif
                     @endif
             @endif
             </td>
             </tr>
             @endforeach
             @else
             <tr>
                 <td colspan="5" class="text-center text-danger">No data found</td>
             </tr>
            @endif
         </tbody>
     </table>

     <div class="clearfix">
        <hr>
        {{$selfdrive->links()}}
    </div>

 </div>
 {{-- Seld drive Table end --}}
