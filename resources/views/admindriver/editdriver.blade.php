
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <body>

<div id="edit_driver{{ $dv->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{url('updatedriver/'.$dv->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <div>
                            <input type="text" class="form-control" name="name" value="{{$dv->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <div>
                            <input type="text" class="form-control" name="address" value="{{$dv->address}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Experience <span class="text-danger">*</span></label>
                        <div>
                            <input type="text" class="form-control" name="yearsofexperience" value="{{$dv->yearsofexperience}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>License Number <span class="text-danger">*</span></label>
                        <div>
                            <input type="text" class="form-control" name="license" value="{{$dv->license}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Contact Number <span class="text-danger">*</span></label>
                        <div>
                            <input type="text" class="form-control" name="number" value="{{$dv->number}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Driver Status</label>
                        <select class="form-control" id="sel3" name="statusdriver">
                            <option value="available">Available</option>
                            <option value="notavailable">Not Available</option>
                            </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Upload Image</label>
                        <div class="custom-file">
                            <label class="custom-file-label" for="customFile">Upload Profile</label>
                            <input type="file" class="custom-file-input" id="customFile" name="profile" value="{{$dv->profile}}">
                        </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                    <br>
                </form>

                @if(Session::has('message'))
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
                            window.location.href = "{{url('admindriver')}}";
                        }
                    });
                </script>
            @endif
            </div>
        </div>
    </div>
</div>



</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>
