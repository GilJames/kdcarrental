@extends('layouts.rentcar')
@section('title','About Us')
@section('content')

<br>

<div class="responsive-container-block bigContainer">
    <div class="responsive-container-block Container">
      <div class="responsive-container-block leftSide">
        <h2 class="text-blk heading">
          About Us
        </h2>
        <p class="text-blk subHeading">
          Welcome to K & D Car Rental, your trusted partner for seamless and reliable transportation solutions in Maramag, Philippines. Located at P6 Anahawon, we take pride in offering a fleet of well-maintained and top-quality vehicles to meet your diverse travel needs.
        <p class="text-blk subHeading">
          At K & D Car Rental, our mission is to provide you with a hassle-free and enjoyable journey. Whether you're a local resident in need of a temporary vehicle or a visitor exploring the beautiful landscapes of Maramag, we have the perfect car rental options for you.        </p>
      </div>


      <div class="responsive-container-block rightSide">
        <img class="number1img" src="{{asset('../assets/images/services.jpg')}}">
        <img class="number2img" src="{{asset('../assets/images/logo.jpg')}}">
        <img class="number3img" src="{{asset('../assets/images/image1.jpg')}}">
        <img class="number5img" src="{{asset('../assets/images/image2.jpg')}}">
        <img class="number4vid" src="{{asset('../assets/images/image1.jpg')}}">
        <img class="number7img" src="{{asset('../assets/images/services.jpg')}}">
        <img class="number6img" src="{{asset('../assets/images/image2.jpg')}}">
      </div>
    </div>
    <!-- <div class="maincontent">
      <p>CAR RENTAL SYSTEM</p>
    </div> -->
  </div>

</div>
<style>
</style>
@endsection

