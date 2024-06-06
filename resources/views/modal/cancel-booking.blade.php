<!-- Add this modal just before the closing </body> tag in your main layout or in the same file -->
<div class="modal fade" id="cancelModal_{{ $bk->id }}" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" style="position: relative">
        <form action="{{ url('cancelbooking/') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
                    <button type="button" style="position: absolute; top: 10px; right: 20px;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="reason">Reason for Cancel:</label>
                        <input type="hidden" value="{{ $bk->id }}" name="bk_id">
                        <input type="hidden" value="withDriver" name="driveType">
                        <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Optional"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger border border-dark">Submit</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
