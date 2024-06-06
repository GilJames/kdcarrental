<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KD Car Rental Agreement</title>
</head>
<body>
    <div class="container">
        <div class="wrapper">
             <div class="header">
                <h1>KD Car Rental Agreement</h1>
                <br>
                <br>

                <div class="date">
                    <span class="dates">Date: _________________</span>
                </div>
                <br>
                <br>
                <div class="agree">
                    <p>The Owner hereby agrees to rent to renter a vehicle SUV Adventure GLS with place no. <b>NAD 3380</b> Engine no: 
                    4D5GAAP4306 Chassis no: PAEVB5NHHGB015440 Model 17.</p>
                </div>
                <div class="rentalperiod">
                 <p><b>Rental Period:</b> &emsp; <b><u>{{$data->daytrip}} days</u></b></p>
               
                 <p><b>Rental rate: </b> &emsp;<b><u>{{ ucfirst($data->admincar->carprice)}}</u></b>/day all fuel shall be paid for by the renter</p>
                 <p><b>Total Rent:</b> &emsp; <b><u> {{$data->total_payment}} </u></b></p>
                </div>

                  
                <div class="liability">
                   <p><b>Liability for loss Accident </b></p>
                   <div class="group">
                      <li>That in case of damage to the vehicle due to accident, the cost of repairs shall be the renter liabilities
                      All repairs due to abusive use shall be for the account of the renter.</li>
                      <li>Any Accident and loss of vehicle should be immediately reported by the renter to the owner/Reported 
                   to the nearest  PNP station for the police report and take photo for case of accident. </li>
                   <li>That in case lose to the vehicle due to car napping. Shall be responisible to the renter.</li>
                   <li>The owner are not responsible/liable for any transaction to the use of car.</li>
                   <li>If the renter wants to extend just inform to owner car</li>
                   <li>The renter provide 2 valid ID and any proof of billing</li>
                </div>
                <div class="booking">
                    <li class="row"><span><b>Transaction Number: <u>{{$data->confirmed_OR ?? 'N/A'}}</u></b></span></li><br>
                    <li class="row">    <span><b>Starting Date: <u>{{ \Carbon\Carbon::parse($data->pickupdate)->format('F d, Y') }}</u></b></span></li><br>
                    <li class="row">    <span><b>Returning Date:  <u>{{ \Carbon\Carbon::parse($data->dropoffdate)->format('F d, Y') }}</u></b></span></li>
                    <br>
                    <br>
                </div>
                <div class="footer">
                    <div class="owner">
                       <li class="row"><b>Owner name and Signature</b></li><br>
                      <li class="row"><b><u>Mckinley Glenn Clapero</u></b></li><br>
                      <li class="row">Contact no: ________________</li>
                    </div>
                    <div class="renter">
                         <li class="row"><b>Renter name and Signature</b></li><br>
                         <li class="row"><b><u>{{$data->user->name}}</u></b></li><br>
                         <li class="row">Contact no: <b><u>{{$data->user->number}}</u></b></li>
                         

                    </div>
                </div>
             </div>
        </div>
    </div>
    
</body>
</html>



<style>
    *{
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
       box-sizing: border-box;
    }
    h1{
        text-align:center;
        margin-top: 2rem;

    }
    .date, .dates{
        margin-left: 1.2rem;
    }
    .agree, p{
        margin: 1.2rem;
    
    }
    .rentalperiod{
        margin: 1.4rem;
    }
    .liability{
        margin: 1.4rem;
    }
    .liability, .group{
        margin: 1.9rem;

    }
    div.wrapper{
        margin: 2rem;
    }
    .booking, .row{
        list-style: none;
        line-height: 1rem;
    }
    .renter{
        float:right;
      
    }
    .row, .fot{
        margin-left:2rem;
    }
 

</style>
