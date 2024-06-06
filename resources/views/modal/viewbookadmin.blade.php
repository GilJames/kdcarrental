
<div class="modal fade " id="viewHistoryAll{{$book->id}}" tabindex="-1" role="dialog"
    aria-labelledby="viewHistoryAllLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="viewHistoryAllLabel">With Driver Booking</h5>
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
                                        </div>
                                        <div class="col-md-6">

                                            <div class="media">
                                                <h6>Days of Trips:</h6>&emsp;
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

                        {{-- user view design --}}
<br><hr>
<!-- Existing modal content here... -->

<div class="user-reviews">
    <div class="review-header">
        <h5>Last Reviews and Comments for this User:</h5>
    </div>
    <div class="review-list">
        <!-- Reviews will be appended here by the script -->
    </div>
</div>
                </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function loadUserRemarks(id) {
        $.ajax({
            url: `/user/${id}/remarks`,
            method: 'GET',
            success: function(remarks) {
                const container = $('.review-list');
                container.empty();  // Clear existing remarks
                remarks.forEach(remark => {
                    const isAdmin = remark.user.role === 0; // Check if the user is an admin
                    const userName = isAdmin ? `Admin: ${remark.user.name}` : remark.user.name; // Adjust display name based on role

                    container.append(`
                        <div class="single-review">
                            <div class="review-rating">
                                ${Array.from(Array(Math.round(remark.rate)).keys()).map(() => '<i class="fas fa-star checked"></i>').join('')}
                            </div>
                            <div class="review-text">
                                <p>${remark.comment}</p>
                            </div>
                            <div class="review-meta">
                                <span>Rated by: ${userName}</span>
                                <span>Date: ${new Date(remark.created_at).toLocaleDateString()}</span>
                            </div>
                        </div>
                    `);
                });
            },
            error: function(xhr) {
                console.error('Error loading remarks:', xhr.responseText);
            }
        });
    }
</script>




<style>
    body{
    color: #6F8BA4;
    margin-top:20px;
}
.section {
    padding: 100px 0;
    position: relative;
}
.about-user-avatar{
    max-width: 20%;

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
.user-reviews {
    margin-top: 20px;
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0,0,0,.1);
}

.review-header h5 {
    text-align: center;
    color: #333;
}

.single-review {
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

.review-rating .fa-star {
    color: #ccc; /* Default star color */
}

.review-rating .fa-star.checked {
    color: #f39c12; /* Rated star color */
}

.review-text p {
    margin: 5px 0;
    font-size: 14px;
    color: #666;
}

.review-meta span {
    display: block;
    font-size: 12px;
    color: #666;
}

.review-meta span:first-child {
    margin-bottom: 5px;
}


</style>





