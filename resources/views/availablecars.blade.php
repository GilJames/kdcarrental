@extends('layouts.rentcar')
@section('title','Car Listing')

@section('content')

<section class="listing-page">
  <div class="container">
    <div class="row">
  <div class="col-md-9 col-md-push-3">


       @foreach($data as $car)


          @if($car->status =='available')

       {{-- @php
          $isAvailable = true;
       @endphp --}}


    <!-- WITH DRIVER FILTER -->

    {{-- @foreach($bookings as $book)
        @if($book->admincars_id == $car->id && $book->status == 'confirm')
            @php
            $isAvailable = false;
            break;
            @endphp
        @endif
    @endforeach --}}

    <!-- SELFDRIVE FILTER -->

    {{-- @foreach($selfdrives as $selfdrive)
        @if($selfdrive->admincars_id == $car->id && $selfdrive->status == 'confirm')
            @php
            $isAvailable = false;
            break;
            @endphp
        @endif
    @endforeach

    @if($isAvailable) --}}

        <div class="product-listing-m gray-bg" style="font-family: 'Arial', 'Helvetica', sans-serif;">
          <div class="product-listing-img"><img  src="{{asset('../uploads/car/'.$car->image)}}" class="img-responsive" alt="Image" width="450px" height="560px;"/> </a>
          </div>
          <div class="product-listing-content">
            <h5><a href="{{url('viewcardetails/'.$car->id)}}">{{$car->carname}}</a></h5>
            <p class="list-price">Rent Fee Per Day: <b> {{$car->carprice}} </b></p>
            <ul>
              <li><i class="fa fa-user" aria-hidden="true"></i> {{$car->carseats}}</li>
              <li><i class="fa fa-car" aria-hidden="true"></i>{{$car->carmodel}}</li>
              <li><i class="fa fa-filter" aria-hidden="true"></i> {{$car->fueltype}}</li>
              <!-- <li><i class="fa fa-car" aria-hidden="true" style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif"> &nbsp; {{$car->fueltype}}</i></li> -->
            </ul>
            <h5>Other  Description</h5>
            <p class="list-city"> <span style="color:red"><b>Car History:</span> &nbsp; {{$car->carhistory}} </p>
            <p class="list-city"><span style="color:red"><b>Car Model:</span> &nbsp; {{$car->carmodel}} </p>
            <p class="list-city"><span style="color:red"><b>FuelType:</span> &nbsp;{{$car->fueltype}}</p>

            {{-- <p class="list-city"><span style="color:black"><b>Status:</span> &nbsp; --}}
            {{-- <button style="color:green">Available</button>
              <!-- @if($car->status == 'notavailable')
                         <button style="color:red">Not Available</button>
                        @elseif($car->status == 'available')
                        <button style="color:green">Available</button>
              @endif  --> --}}


            </p>
            <a href="{{url('viewcardetails/'.$car->id)}}" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          </div>
        </div>

                  {{-- @endif --}}

                  @else

                  @endif

        @endforeach


         </div>

      <!--Side-Bar-->
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your  Car </h5>
          </div>
          <div class="sidebar_filter">

            <form action="{{url('search')}}" method="get">
                <label for="">Search Car</label>
                <input type="text" name="search" value=""><br>
                <br><input type="submit" name="" value="Search"><br>
                <br><a href="{{url('availablecars')}}">Back</a>
            </form>

              <div class="form-group">

              </div>
            </form>
          </div>
        </div>

        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Listed Cars</h5>
          </div>
          <div class="recent_addedcars">
            <ul>



            @foreach($data as $car)

            @if($car->status =='available')

{{--
            @php
          $isAvailable = true;
       @endphp --}}


    <!-- WITH DRIVER FILTER -->

    {{-- @foreach($bookings as $book)
        @if($book->admincars_id == $car->id && $book->status == 'confirm')
            @php
            $isAvailable = false;
            break;
            @endphp
        @endif
    @endforeach --}}

    <!-- SELFDRIVE FILTER -->

    {{-- @foreach($selfdrives as $selfdrive)
        @if($selfdrive->admincars_id == $car->id && $selfdrive->status == 'confirm')
            @php
            $isAvailable = false;
            break;
            @endphp
        @endif
    @endforeach

    @if($isAvailable) --}}

              <li class="gray-bg">
                <div class="recent_post_img"> <a href="{{url('viewcardetails/'.$car->id)}}" alt="image"><img src="{{asset('../uploads/car/'.$car->image)}}" alt="image"></a> </div>
                <div class="recent_post_title" style="font-family: 'Arial', 'Helvetica', sans-serif;"> <a href="">{{$car->carname}}</a>
                  <p class="widget_price"><b>{{$car->carprice}}  Per Day</p>
                </div>
              </li>


              {{-- @endif --}}

              @else

              @endif

              @endforeach




            </ul>
          </div>
        </div>
      </aside>
      <!--/Side-Bar-->
    </div>
  </div>
</section>
<!-- /Listing-->

@endsection

<style>
    *
    {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
