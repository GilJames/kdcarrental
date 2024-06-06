<!-- view self booking details ni na modal -->
<style>
    .modal-title {
        font-weight: bold;
        font-size: 100%;
        /* Adjust as needed */
    }

    /* Define the media query for smaller screens */
    @media (max-width: 768px) {
        .modal-title {
            font-size: 100%;
        }
        .reviewBtn,
        .commentHere {
            font-size: 60% !important;
            /* Adjust for smaller screens */
        }
        .reviewBtnatag {
            font-size: 30%;
        }
    }

    /* Define the media query for even smaller screens */
    @media (max-width: 576px) {
        .modal-title {
            font-size: 100%;
            /* Adjust for even smaller screens */
        }
    }
</style>
<div class="modal fade" id="modal1_{{ $bk->id }}{{ $key }}" tabindex=" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Booking Details</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- First Column for Car Image -->
                    <div class="{{ $bk->lastrate === null ? 'col-md-12' : 'col-md-6' }}">

                            <img src="{{ asset('../uploads/car/' . $bk->admincar->image) }}" alt="image"
                                class="img-fluid"
                                style="max-width: {{ $bk->lastrate === null ? '50%' : '100%' }}; height: auto;">
                            <br>
                            <div>

                            <br>

                            <p>Car Name: {{ $bk->carname }}</p>
                            <p>Pickup Date: {{ $bk->pickupdate }}</p>
                            <p>Dropoff Date: {{ $bk->dropoffdate }}</p>
                            <p>Destination: {{ $bk->destination }}</p>
                            <p>Days of trips: {{ $bk->daytrip }}</p>
                            <p>Your Status: <span style="color:red">{{ $bk->status }}</span></p>

                            <br>
                            <br>
                        </div>

                        </div>
                    </div>
                    @if ($bk->lastrate != null)
                        <div class="col-md-6">
                            <div class="review_here{{ $bk->id }}">
                                <h4 class="text-center">Your Review</h4>

                                <p class="">Rate:</p>
                                <div class="rating-container">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="checkbox" {{ $bk->rate >= $i ? 'checked' : '' }}
                                            class="rating-checkbox" id="car{{ $i }}" disabled>
                                        <label for="car{{ $i }}" class=""><i
                                                class="fas fa-car"></i></label>
                                    @endfor
                                    <input type="hidden" class="bk_rate{{ $bk->id }}{{ $key }}">
                                </div>

                                <br>
                                <p class="">Comment:</p>
                                <textarea class="form-control" readonly id="comment{{ $bk->id }}{{ $key }}"
                                    name="comment{{ $bk->id }}{{ $key }}" placeholder="Your Review"
                                    style="resize: none; height: 150px;"></textarea>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <div class="status">
                        @if ($bk->status == 'reject' || $bk->status == 'completed')
                            <a href="{{ url('viewcardetails/' . $bk->admincar->id) }}"
                                class="btn btn-danger reviewBtnatag">Book again</a>
                        @elseif($bk->status == 'confirm')
                            <h2 class="h5 mb-3" style="text-align: center;">
                                <a href="#" class="text-muted">A Confirmation for Your Booking was Sent, Please
                                    Check
                                    Your Email!</a>
                            </h2>
                            <a href="https://mail.google.com/" class="btn btn-primary"
                                style="text-decoration: underline;">Check Your Email here!</a>
                        @endif
                    </div>
                    <button type="button" class="btn btn-secondary reviewBtn" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        function checkCarsBasedOnInputValue(modalSelector, id, key, model) {
            // Find the modal associated with the specific button

            // let rate = 0;
            // let comment = '';

            $.ajax({
                url: '/getDataRate', // Removed the trailing slash
                method: 'POST', // 'post' should be lowercase
                data: {
                    id: id,
                    model: model
                },
                success: function(res) {
                    var rate = res.book.rating;
                    console.log(rate);

                    // Use the context of the modal to find the input value
                    const modalSelector = '#modal1_' + id + key;
                    const carCheckboxes = $(modalSelector + ' .rating-checkbox');
                    const carIcons = $(modalSelector + ' .fa-car');

                    // Uncheck all checkboxes within the specific modal
                    carCheckboxes.prop('checked', false);

                    // Check the corresponding checkboxes based on the input value
                    for (let i = 0; i < rate; i++) {
                        const checkbox = $(modalSelector + ` #car${i + 1}`);
                        if (checkbox.length) {
                            checkbox.prop('checked', true);
                        }
                    }

                    // Change the color or apply any dynamic styling based on the input value
                    carIcons.each(function(index) {
                        $(this).removeClass('checked');
                        if (index < rate) {
                            $(this).addClass('checked');
                        }
                    });

                    // Update hidden input value with the rate
                    $('#ratingValue').val(rate);
                    $(`#comment${id}${key}`).val(res.book.comment);
                },

                error: function(err) {
                    console.error(err);
                },
            });

        }
    </script>

    <!-- Include jQuery (or Popper.js) and Bootstrap JS -->
