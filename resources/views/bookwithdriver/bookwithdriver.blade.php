<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add</title>
</head>
<body>

    <div class="container">

        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Name <span class="text-danger">*</span></label>
                        <select class="form-control" name="name" id="name">
                             @foreach ( $user as $users )
                             <option value="{{$users->id}}">{{$users->name}}</option>

                             @endforeach

                        </select>
                        {{-- @error('name') <small class="text-danger">{{$message}}</small> @enderror --}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Car Name <span class="text-danger">*</span></label>
                        <select class="form-control" name="carname" id="carname">
                            {{-- @foreach ($users as $user) --}}
                                <option value=""></option>
                            {{-- @endforeach --}}
                        </select>
                        {{-- @error('carname') <small class="text-danger">{{$message}}</small> @enderror --}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Car Price </label>
                        <input class="form-control" type="number" name="carprice">
                        {{-- @error('fueltype') <small class="text-danger">{{$message}}</small> @enderror --}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Pick-up time </label>
                        <input class="form-control" type="time" name="pickuptime">
                        {{-- @error('fueltype') <small class="text-danger">{{$message}}</small> @enderror --}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Pick-Up Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="pickupdate">
                        {{-- @error('cartype') <small class="text-danger">{{$message}}</small> @enderror --}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Drop-Off Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" name="dropofftime">
                        {{-- @error('cartype') <small class="text-danger">{{$message}}</small> @enderror --}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Drop-off Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="dropoffdate">
                        {{-- @error('cartype') <small class="text-danger">{{$message}}</small> @enderror --}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Destination <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="destination">
                        {{-- @error('cartype') <small class="text-danger">{{$message}}</small> @enderror --}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Days of Trip <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="daytrip">
                        {{-- @error('cartype') <small class="text-danger">{{$message}}</small> @enderror --}}
                    </div>
                </div>
            <div class="table-responsive m-t-15">
                <h1>
                    Total Payment:
                </h1>
            </div>
            <div class="submit-section text-center mt-4">
                <button class="btn btn-primary submit-btn" type="submit">Submit</button>
            </div>
        </form>

    </div>

</body>
</html>
