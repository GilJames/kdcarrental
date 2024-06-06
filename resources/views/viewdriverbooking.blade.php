@extends('layouts.rentcar')
@section('title','Car Listing')

@section('content')
<section class="page-header listing_page">
    <div class="container">
        <div class="page-header_wrap">
            <div class="page-heading">
                <h1>Your Booking Details</h1> 
            </div>
            <!-- Dark Overlay-->
            <div class="dark-overlay"></div>
        </section>
        <br>
        <!--Listing-detail-->
        <section class="listing-detail">
        <div class="container-fluid">

<div class="container">
  <!-- Title -->
  <div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h5 mb-0" style="text-align:Center;"><a href="#" class="text-muted"></a>Thankyou for Booking! at Mommy Ambol Car Rental Please Wait for your booking Confirmation!</h2>
  </div>
<br>
<br>
  <!-- Main content -->
  <div class="row">
    <div class="col-lg-8">
      <!-- Details -->
    
            <div class="d-flex">

              <div class="dropdown">
          
                <ul class="dropdown-menu dropdown-menu-end">
               
                </ul>
              </div>
            </div>
          </div>
        
                <img src="{{asset('../uploads/car/'.$data->admincar->image)}}" alt="image" width="45px"  height="45px"> 
            
        
            
          <br>
          <table class="table table-borderless">
            <tbody>
            

         
            <tr>
                <td colspan="2">Carname:</td>
             
                <td class="text-end"> <b>{{$data->admincar->carname}} </b></td>
          

       
         
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2">Pickupdate</td>
                <td class="text-end"><b>{{$data->pickupdate}}</b></td>
              </tr>
              <tr>
                <td colspan="2">PickupTime</td>
                <td class="text-end"><b>{{$data->pickuptime}} </b></td>
              </tr>
              <tr>
                <td colspan="2">DropoffDate</td>
                <td class="text-danger text-end"><b>{{$data->dropoffdate}} </b></td>
              </tr>
              <tr>
                <td colspan="2">Dropofftime</td>
                <td class="text-danger text-end"><b>{{$data->dropofftime}} </b></td>
              </tr>
              <tr>
                <td colspan="2">Destination</td>
                <td class="text-end"><b>{{$data->destination}} </b></td>
              </tr>
              <tr>
                <td colspan="2">Days of Trips</td>
                <td class="text-end"><b>{{$data->daytrip}} days </b></td>
              </tr>
              <tr class="fw-bold">
                <td colspan="2">Your Status</td>
                <td class="text-end"><span class="badge bg-success rounded-pill">{{$data->status}}</span></td>
                <br>
              
                
                
              </tr>
            </tfoot>
          </table>
          <br>
          <div class="status" style="margin: auto; text-align: center;">
            @if($data->status == 'pending')
                <a href="#" class="btn">Cancel Booking</a>
                <a href="{{url('editdriverbooking/'.$data->id)}}" class="btn">Edit Booking</a>
            @elseif($data->status == 'reject')
                <a href="#" class="btn">Book again</a>
            @elseif($data->status == 'completed')
                <a href="#" class="btn">Book again</a>
                <a href="#" class="btn">Make Reviews</a>
            @elseif($data->status == 'confirm')
            <h2 class="h5 mb-0" style="text-align:Center;"><a href="#" class="text-muted"></a>A Confirmation for Your Booking was Sent , Please Check Your Email! </h2>
            <a href="https://mail.google.com/" style="text-decoration: underline;">Check Your Email here!</a>

            @endif
       </div>

      </div>
    


                
                      
                </div>
            </div>

        </div>
    </div>
    </div>
</div>

</section>

@endsection


<style>


body{
    background:#eee;
}
.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 1rem;
}
.text-reset {
    --bs-text-opacity: 1;
    color: inherit!important;
}
a {
    color: #5465ff;
    text-decoration: none;
}
</style>