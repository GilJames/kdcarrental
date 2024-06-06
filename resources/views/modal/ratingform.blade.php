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

    .fa-car {
        font-size: 2em;
        color: #ccc;
        cursor: pointer;
        margin-right: 10px;
        /* Add margin between icons */
        transition: color 0.3s ease;
    }

    .fa-car:hover {
        color: #3498db;
    }

    .fa-car.checked {
        color: #f39c12;
    }
</style>
<div class="modal fade text-left" id="ModalCreate_{{ $bk->id }}{{ $key }}" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" style="width: 80%;" role="document">
        <form action="{{ url('storecomment') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header" style="position: relative">
                    <br>
                    <br>
                    <p class="modal-title" style="position: absolute; top:10; left:0; font-weight: bold;">Make Your
                        Reviews in {{ $bk->admincar->carname }}</p>

                    <button style="position: absolute; top:3; right:-5;" type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- First Column for Car Image -->
                        <div class="col-md-6">
                            <div>
                                <img src="{{ asset('../uploads/car/' . $bk->admincar->image) }}" alt="image"
                                    class="img-fluid" style="max-width: 100%; height: auto;">
                                <br>
                            </div>
                        </div>

                        <!-- Second Column for Rating and Comment -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="input" type="hidden" name="book_id" value="{{ $bk->id }}">
                                <input class="input" type="hidden" name="admincars_id"
                                    value="{{ $bk->admincars_id }}">
                                <input class="input" type="hidden" name="model" value="withdrive">
                            </div>

                            <p style="font-weight: bold">Rate 1-5</p>

                            <div class="rating-container">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input type="checkbox" class="rating-checkbox"
                                        id="car{{ $i }}{{ $key }}{{ $bk->id }}">
                                    <label
                                        onclick="rateCar({{ $i }}, {{ $key }}, {{ $bk->id }})"
                                        for="car{{ $i }}{{ $key }}{{ $bk->id }}"><i
                                            class="fas fa-car"></i></label>
                                @endfor
                            </div>

                            <input type="hidden" name="rating"
                                id="ratingValue{{ $key }}{{ $bk->id }}" value="">
                            @error('rating')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <br>

                            <p class="commentHere" style="font-weight: bold">Please Comment Your Review</p>

                            <textarea class="form-control" name="comment" placeholder="Your Review" style="resize: none; height: 150px;"></textarea>
                            @error('comment')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div class="modal-footer">
                                <button style="margin-bottom: 5%" type="button"
                                    class="btn grey btn-outline-secondary reviewBtn" data-dismiss="modal">Back</button>
                                <button style="margin-bottom: 5%" type="submit"
                                    class="btn btn-success reviewBtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


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
                        window.location.href = "{{ url('viewcardetails/' . $bk->admincar->id) }}";
                    }
                });
            </script>
        @endif

    </div>
</div>

<!-- WITH REVIEWS NI SHA NA MODAL -->
{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
<script>
    function rateCar(rating, key, id) {
        // Find the modal associated with the clicked button
        var modalSelector = '#ModalCreate_' + id + key;

        // Uncheck all checkboxes within the specific modal
        $(modalSelector + ' .rating-checkbox').prop('checked', false);

        // Check the selected checkbox within the specific modal
        $(modalSelector + ' #car' + rating + key + id).prop('checked', true);

        // Change the color or apply any dynamic styling based on the rating
        $(modalSelector + ' .fa-car').removeClass('checked');
        $(modalSelector + ' .fa-car:lt(' + rating + ')').addClass('checked');

        // Update hidden input value
        $(`#ratingValue${key}${id}`).val(rating);
    }
</script>
