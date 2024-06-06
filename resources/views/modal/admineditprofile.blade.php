<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <body>

<div id="exampleModal_{{$data->id}}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{url('updated/'.$data->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="text-center">
                        <img src="{{asset('../uploads/profile/' . $data->photo)}}" alt="Admin" class="rounded-circle" width="250" height="250">
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary ml-2" onclick="uploadPhoto()">Upload Photo</button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="photo" onchange="updateFileName(this); handleFileChange(this);">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <div>
                            <input type="text" class="form-control" placeholder="Enter fullname" value="{{$data->name}}" name="name">
                        </div>
                    </div>
                    @error('name') <small class="text-danger">{{$message}}</small> @enderror
                    <div class="form-group">
                        <label>Email Address <span class="text-danger">*</span></label>
                        <div>
                            <input type="email" class="form-control" placeholder="Enter email" value="{{$data->email}}" name="email">
                        </div>
                    </div>
                    @error('email') <small class="text-danger">{{$message}}</small> @enderror
                    <div class="form-group">
                        <label>Mobile Number <span class="text-danger">*</span></label>
                        <div>
                            <input type="text" class="form-control" placeholder="Enter mobile number" value="{{$data->number}}" name="number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <div>
                            <input type="text" class="form-control" placeholder="Enter your address" value="{{$data->address}}" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Update Password <span class="text-danger">*</span></label>
                        <div>
                            <input type="password" class="form-control" placeholder="Update Your Password Always" name="password">
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
                            window.location.href = "../adminprofile/{{ Auth::user()->id }}";
                        }
                    });
                </script>
            @endif
            </div>
        </div>
    </div>
</div>



</body>
<script>
    function uploadPhoto() {
        document.getElementById('customFile').click();
    }

    function clearPhoto() {
    // Remove the uploaded file name from the database
    document.querySelector('input[name="photo"]').value = '';

    // Clear the file input
    var fileInput = document.getElementById('customFile');
    fileInput.value = '';

    // Reset the custom file label
    document.querySelector('.custom-file-label').innerHTML = 'Upload Profile';

    // Set the profile image source to the default image source
    document.getElementById('profile-image').src = '{{ asset("uploads/profile/default.jpg") }}';
}

    function updateFileName(input) {
        var fileName = input.value.split('\\').pop();
        document.querySelector('.custom-file-label').innerHTML = fileName;
    }

    function handleFileChange(input) {
        var fileInput = input.files[0];
        if (fileInput) {
            var formData = new FormData();
            formData.append('photo', fileInput);

            fetch('{{url('updated/'.$data->id)}}', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                document.querySelector('input[name="photo"]').value = data.fileName;
                document.getElementById('profile-image').src = '{{ asset("uploads/profile/") }}' + '/' + data.fileName;
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>



