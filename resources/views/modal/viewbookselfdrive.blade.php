
<div class="modal fade " id="view{{$book->id}}" tabindex="-1" role="dialog"
    aria-labelledby="viewHistoryAllLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="view">SelfDrive Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="section about-section gray-bg" id="about">
                        <div class="row align-items-center flex-row-reverse">
                            <div class="col-lg-6">
                                <div class="about-text go-to">
                                    <h3 class="dark-color">{{$book->admincar->carname}}</h3>
                                    <div class="row about-list">
                                        <div class="col-md-6">
                                            <div class="media">
                                                <h6>Name:</h6>&emsp;
                                                <p>{{$book->user->name}}</p>
                                            </div>
                                            <div class="media">
                                                <h6>PickupDate:</h6> &emsp;
                                                <p>{{ \Carbon\Carbon::parse($book->pickupdate)->format('F d, Y') }}</p>
                                            </div>
                                            <div class="media">
                                                <h6>DropoffDate:</h6>&emsp;
                                                <p>{{ \Carbon\Carbon::parse($book->dropoffdate)->format('F d, Y') }}</p>
                                            </div>
                                            <div class="media">
                                                <h6>License:</h6>&emsp;
                                                <p>{{$book->license}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="media">
                                                <h6>Destination:</h6>&emsp;
                                                <p>{{$book->destination}}</p>
                                            </div>
                                            <div class="media">
                                                <h6>Days of Trips</h6>&emsp;
                                                <p>{{$book->daytrip}}</p>
                                            </div>
                                            <div class="media">
                                                <h6>Carprice:</h6>&emsp;
                                                <p>{{$book->admincar->carprice}}</p>
                                            </div>
                                            <div class="media">
                                                <h6>Status:</h6>&emsp;
                                                <p>{{$book->status}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="about-avatar">
                                    <img src="{{ asset('../uploads/car/' . $book->admincar->image) }}" title="" alt="">
                                </div>
                            </div>
                        </div>


                            </div>
                        </div>
                    </div>
                </section>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success submitConfirm"
                    onclick="submitClick({{ $book->id }},'confirm', 'viewHistoryAll{{ $key }}', 'bookingModel')">Confirm</button>
            </div> --}}
        </div>
    </div>
</div>

{{-- <style>
   .modal-body .card .detail{
        float:right;
        text-align:center;
    }
    .pos{
        margin-right: 44%;
    }
    .spn{
        font-size: 28px;
    }
    /* img{
        border: 2px solid #000;
    } */
</style> --}}

<style>
    body{
    color: #6F8BA4;
    margin-top:20px;
}
.section {
    padding: 100px 0;
    position: relative;
}
.gray-bg {
    background-color: #f5f5f5;
}
img {
    max-width: 100%;
}
img {
    vertical-align: middle;
    border-style: none;
}
/* About Me
---------------------*/
.about-text h3 {
  font-size: 45px;
  font-weight: 700;
  margin: 0 0 6px;
}
@media (max-width: 767px) {
  .about-text h3 {
    font-size: 35px;
  }
}
.about-text h6 {
  font-weight: 600;
  margin-bottom: 15px;
}
@media (max-width: 767px) {
  .about-text h6 {
    font-size: 18px;
  }
}
.about-text p {
  font-size: 18px;
  max-width: 450px;
}
.about-text p mark {
  font-weight: 600;
  color: #20247b;
}

.about-list {
  padding-top: 10px;
}
.about-list .media {
  padding: 5px 0;
}
.about-list label {
  color: #20247b;
  font-weight: 600;
  width: 88px;
  margin: 0;
  position: relative;
}
.about-list label:after {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  right: 11px;
  width: 1px;
  height: 12px;
  background: #20247b;
  -moz-transform: rotate(15deg);
  -o-transform: rotate(15deg);
  -ms-transform: rotate(15deg);
  -webkit-transform: rotate(15deg);
  transform: rotate(15deg);
  margin: auto;
  opacity: 0.5;
}
.about-list p {
  margin: 0;
  font-size: 15px;
}

@media (max-width: 991px) {
  .about-avatar {
    margin-top: 30px;
  }
}

.about-section .counter {
  padding: 22px 20px;
  background: #ffffff;
  border-radius: 10px;
  box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
}
.about-section .counter .count-data {
  margin-top: 10px;
  margin-bottom: 10px;
}
.about-section .counter .count {
  font-weight: 700;
  color: #20247b;
  margin: 0 0 5px;
}
.about-section .counter p {
  font-weight: 600;
  margin: 0;
}
mark {
    background-image: linear-gradient(rgba(252, 83, 86, 0.6), rgba(252, 83, 86, 0.6));
    background-size: 100% 3px;
    background-repeat: no-repeat;
    background-position: 0 bottom;
    background-color: transparent;
    padding: 0;
    color: currentColor;
}
.theme-color {
    color: #fc5356;
}
.dark-color {
    color: #20247b;
}
</style>






