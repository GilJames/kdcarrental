<div class="modal fade" id="bookNowModal" tabindex="-1" role="dialog" aria-labelledby="bookNowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl custom-modal-dialog" role="document" style="position: relative">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookNowModalLabel">Select your type of Booking</h5>
              <div style="position: absolute; top:0; right: 2px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            <div class="modal-body text-center">
                <a href="{{ url('bookingform/'.$data->id) }}" class="btn btn-primary btn-block mb-2">With Driver</a>
                <a href="{{ url('selfdrive_form/'.$data->id) }}" class="btn btn-primary btn-block">Self Drive</a>
            </div>
        </div>
    </div>
</div>
