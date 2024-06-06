

@extends('layouts.rentcar')
@section('title','Car Listing')

@section('content')

   <h1 class="lead" style="text-align:center;">Driver's List</h1>

<div class="container-fluid" style="">
    <div class="container" style="">
        <div class="row g-5">
            <!-- First Card -->
            @foreach($data as $dv)

            @if($dv->statusdriver == 'available')
            <div class="col-md-4" data-wow-delay="0.1s">
                <!-- Increased bottom margin to mb-5 -->
                <div class="card">
                    <img src="{{asset('../uploads/drivers/'.$dv->profile)}}" class="card-img" alt="">
                    <div class="card-body border">
                        <h1 class="card-title" style="font-size: 15px; color:#fff; text-align:Center;" >Driver's Information</h1>
                        <h6  style="color:#fff"class="card-sub-title">Name: {{$dv->name}}</h6>
                        <h6  style="color:#fff"class="card-sub-title">Address: {{$dv->address}}</h6>
                        <h6  style="color:#fff"class="card-sub-title"> Experience: {{$dv->yearsofexperience}}</h6>
                        <h6  style="color:#fff"class="card-sub-title">Mobile No: {{$dv->number}}</h6>
                        <h6  style="color:#fff"class="card-sub-title">License: {{$dv->license}}</h6>

                    </div>

                </div>
                <br>
            </div>

            @endif
            @endforeach
            </div>
        </div>




@endsection

<style>
 .card {
    width: 320px;
    height: 500px;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid #0b0707;
    position: relative;
}

.card-img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 15px;

}

.card-body{
    width: 100%;
    height: 100%;
    top: 0;
    right: -100%;
    position: absolute;
    background: #1f3d4738;
    backdrop-filter: blur(5px);
    border-radius: 15px;
    color: #fff;
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    transition: 1s;
}

.card:hover .card-body{
    right: 0;

}
.card.title{
    text-transform: uppercase;
    font-size: 50px;
    font-weight: 500;
}
.card-sub-title{
    text-transform: capitalize;
    font-size: 14px;
    font-weight: 300;
}
.card-info{
    font-size: 16px;
    line-height: 25px;
    margin: 40px 0;
    font-weight: 400;
}
.card-btn{
    color: #1f3d47;
    background: #8fabba ;
    padding: 10px 20px;
    border-radius: 5px;
    text-transform: capitalize;
    border: none;
    outline: none;
    font-weight: 500;
    cursor: pointer;
    width: 120px;
}
</style>


