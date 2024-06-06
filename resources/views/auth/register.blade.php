@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register Account') }}

                        <a href="{{ url('/') }}" style="float:right" class="btn btn-danger">
                            Back
                        </a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name"
                                {{-- name ni e change sa nako og firstname --}}
                                    class="col-md-4 col-form-label text-md-right">{{ __(' Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="Enter your Fullname..">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="name"
                                {{-- name ni e change sa nako og firstname --}}
                                    class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="middlename"
                                        value="{{ old('middlename') }}" required autocomplete="middlename" autofocus
                                        placeholder="Enter your Middlename..">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="name"
                                {{-- name ni e change sa nako og firstname --}}
                                    class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" required autocomplete="surname" autofocus
                                        placeholder="Enter your Surname..">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            


                            {{-- default user photo --}}
                            <input type="hidden" class="image" name="photo" value="5856.jpg">
                            <br>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="valid email address">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="number"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="number" type="number" class="form-control" name="number" required
                                        autocomplete="number" placeholder="mobile no.">
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <label for="city"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Complete Address') }}</label>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- <input id="city" type="text" class="form-control" name="address" required
                                        autocomplete="address"placeholder="Your Permanent Address"> --}}
                                            <select name="" class="form-control" id="selected_region">
                                                <option value="" selected disabled>Select Region</option>
                                            </select>

                                            <select name="" class="form-control mt-3" id="selected_province">
                                                <option value="" selected disabled>Select Province</option>
                                            </select>
                                            <select name="" class="form-control mt-3" id="selected_city">
                                                <option value="" selected disabled>Select City/Municipality</option>
                                            </select>
                                            <select name="" class="form-control mt-3" id="selected_barangay">
                                                <option value="" selected disabled>Select Barangay</option>
                                            </select>

                                            <input id="purok" type="text" class="form-control mt-3"
                                                placeholder="Purok/Street (Optional)">
                                            <input id="userAddress" type="hidden" class="form-control" name="address"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="must consist of 8-9 characters">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="must consist of 8-9 characters">
                                </div>
                            </div>
                            <br>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>




                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        getRegions();

        function getRegions() {
            // Make an AJAX request
            $.ajax({
                url: '/getregions/registration', // URL of the server endpoint to fetch regions
                method: 'GET', // HTTP method
                // dataType: 'json', // Data type expected from the server
                success: function(data) {
                    // Clear existing options
                    $('#selected_region').empty();

                    // Add a default option
                    $('#selected_region').append('<option value="" selected disabled>Select Region</option>');

                    // Append options for each region
                    $.each(data.regions, function(index, region) {
                        $('#selected_region').append('<option value="' + region.regCode + '">' + region
                            .regDesc + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr);
                }
            });
        }

        function getProvince(val) {
            // Make an AJAX request
            $.ajax({
                url: '/getprovince/registration', // URL of the server endpoint to fetch regions
                method: 'GET',
                data: {
                    regCode: val,
                }, // HTTP method
                // dataType: 'json', // Data type expected from the server
                success: function(data) {

                    // Clear existing options
                    $('#selected_province').empty();

                    // Add a default option
                    $('#selected_province').append(
                        '<option value="" selected disabled>Select Province</option>');

                    // Append options for each region
                    $.each(data.provinces, function(index, region) {
                        $('#selected_province').append('<option value="' + region.provCode + '">' +
                            region
                            .provDesc + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr);
                }
            });
        }

        function getCities(val) {
            // Make an AJAX request
            $.ajax({
                url: '/getcities/registration', // URL of the server endpoint to fetch regions
                method: 'GET',
                data: {
                    provCode: val,
                }, // HTTP method
                // dataType: 'json', // Data type expected from the server
                success: function(data) {
                    // Clear existing options
                    $('#selected_city').empty();

                    // Add a default option
                    $('#selected_city').append(
                        '<option value="" selected disabled>Select City/Municipality</option>');

                    // Append options for each region
                    $.each(data.cities, function(index, region) {
                        $('#selected_city').append('<option value="' + region.citymunCode + '">' +
                            region
                            .citymunDesc + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr);
                }
            });
        }

        function getBarangays(val) {
            // Make an AJAX request
            $.ajax({
                url: '/getbarangays/registration', // URL of the server endpoint to fetch regions
                method: 'GET',
                data: {
                    citymunCode: val,
                }, // HTTP method
                // dataType: 'json', // Data type expected from the server
                success: function(data) {
                    // Clear existing options
                    $('#selected_barangay').empty();

                    // Add a default option
                    $('#selected_barangay').append(
                        '<option value="" selected disabled>Select Barangay</option>');

                    // Append options for each region
                    $.each(data.barangays, function(index, region) {
                        $('#selected_barangay').append('<option value="' + region.citymunCode + '">' +
                            region
                            .brgyDesc + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr);
                }
            });
        }

        function completeAddress() {
            let regText = $('#selected_region option:selected').text();
            let provText = $('#selected_province option:selected').text();
            let cityText = $('#selected_city option:selected').text();
            let barangayText = $('#selected_barangay option:selected').text();
            let purokText = $('#purok').val();


            $('#userAddress').val(regText + ', ' + provText + ', ' + cityText + ', ' + barangayText + ', ' + purokText);


        }
        $(document).ready(function() {
            $('#selected_region').change(function() {
                let regCode = $(this).val();
                getProvince(regCode);
            });

            $('#selected_province').change(function() {
                let provCode = $(this).val();
                getCities(provCode);
            });
            $('#selected_city').change(function() {
                let citymunCode = $(this).val();
                getBarangays(citymunCode);
            });
            $('#selected_barangay').change(function() {
                completeAddress();
            });


            $('#purok').change(function(e) {
                e.preventDefault();
                completeAddress();
            });



        });
    </script>
@endpush
