

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <body>


<div id="edit_car{{$car->id}}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('uploadvehicle/'.$car->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car Name <span class="text-danger">*</span></label>
                                <input  class="form-control" type="text"  name="carname" value="{{$car->carname}}">
                                @error('carname') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car Price</label>
                                <input class="form-control" type="text" name="carprice" value="{{$car->carprice}}">
                                @error('carprice') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car Model <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="carmodel" value="{{$car->carmodel}}">
                                @error('carmodel') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car Seats <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="carseats" value="{{$car->carseats}}">
                                @error('carseats') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car History</label>
                                <input class="form-control" type="text" name="carhistory" value="{{$car->carhistory}}">
                                @error('carhistory') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Fuel Type</label>
                                <input class="form-control" type="text" name="fueltype" value="{{$car->fueltype}}">
                                @error('fueltype') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car Type <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="cartype" value="{{$car->cartype}}">
                                @error('cartype') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Upload File <span class="text-danger">*</span></label>
                                <div class="custom-file mb-3">
                                    <label class="custom-file-label" for="customFile"><i class="col-form-label"></i>Choose file</label>
                                    <input type="file" class="custom-file-input" id="customFile" name="image" value="{{$car->image}}">
                                    @error('image') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car Status</label>
                                    <select class="form-control" id="sel3" name="status">
                                        <option value="available">Available</option>
                                        <option value="notavailable">Not Available</option>
                                    </select>
                            </div>
                        </div>
                    <div class="table-responsive m-t-15">
                        <table class="table table-striped custom-table">
                            </tbody>
                        </table>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                </form>
                @if(Session::has('info'))
                <script>
                    swal({
                        title: "Congrats",
                        text: "{{ Session::get('info') }}",
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
                            window.location.href = "{{url('admincar')}}";
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










