<div id="edit_user{{ $user->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action ="{{ url('updateuser/' . $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <div>
                            <input class="form-control" type="text" placeholder="Fullname" name="name"
                                value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <div>
                            <input class="form-control" type="email" placeholder="Enter your email" name="email"
                                value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone Number <span class="text-danger">*</span></label>
                        <div>
                            <input class="form-control" type="number" placeholder="Enter your phone number"
                                name="number" value="{{ $user->number }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <div>
                            <input class="form-control" type="text" placeholder="Enter your address" name="address"
                                value="{{ $user->address }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <div>
                            <select class="form-control" type="text" name="role">
                                <option value="1">Customer</option>
                                <option value="0">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" onchange="checkmepass('{{ $user->id }}');"
                                    type="checkbox" role="switch" id="myCheckbox{{ $user->id }}">
                                <label class="form-check-label" for="myCheckbox{{ $user->id }}">Change
                                    Password</label>
                            </div>
                        </div>

                    </div>

                    <div class="form-group d-none" id="changepassParent{{ $user->id }}">
                        <label>New Password <span class="text-danger">*</span></label>
                        <input class="form-control" placeholder="Enter new password" type="password"
                            id="changePassId{{ $user->id }}" name="password">
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
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
                                    text: 'OK',
                                    value: 'ok',
                                },
                            },
                            closeOnClickOutside: false,
                            closeOnEsc: true,
                        }).then((value) => {
                            if (value === 'ok') {
                                window.location.href = "{{ url('adminuser') }}";
                            }
                        });
                    </script>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function checkmepass(id) {
            if ($(`#myCheckbox${id}`).is(':checked')) {
                $(`#changepassParent${id}`).removeClass('d-none');
            } else {
                $(`#changepassParent${id}`).addClass('d-none');
                $(`#changePassId${id}`).val('');
            }
        }
    </script>
@endpush
