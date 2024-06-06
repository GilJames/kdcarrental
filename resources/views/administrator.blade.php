
@extends('layouts.admin')

@section('content')

<br>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Manage Car</title>
</head>
<body>
    <div class="container">
        <br>
    <table class="table table-hover">
        <a href="{{url('../addcar')}}"style="float:right"><button class ="btn btn-primary">Add Car</button></a>
        <br>
        <tr>
            <br>
            <th>#</th>
            <th>Carname</th>
            <th>Carprice</th>
            <th>Carmodel</th>
            <th>Carseats</th>
            <th>Address</th>
            <th>Carpic</th>
            <th>Personnumber</th>
            <th>Car History</th>
            <th>Fueltype</th>
            <th>Car Type</th>
             <th>Action</th>
        </tr>
        @foreach($data as $car)
        <tr> 
            <td>{{$car->id}}</td>
            <td>{{$car->carname}}</td>
            <td>{{$car->carprice}}</td>
            <td>{{$car->carmodel}}</td>
            <td>{{$car->carseats}}</td>
            <td>{{$car->address}}</td>
            <td>
                <img src="{{asset('../uploads/'.$car->carpic)}}" alt="image" width="100px" height="80px;">
            </td>
            <td>{{$car->personnumber}}</td>
            <td>{{$car->carhistory}}</td>
            <td>{{$car->fueltype}}</td>
            <td>{{$car->cartype}}</td>
            <td>
                <a href=""><button class="btn btn-danger">Manage</button></a>
            </td>

        </tr>
        @endforeach
        

   </table>

    </div>
    
</body>
</html>



@endsection