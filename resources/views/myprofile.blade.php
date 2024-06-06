
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyProfile Setings</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>




<body>

        <div class="wrapper">
        <div class="logo">
               <li class="left"><a style="text-decoration:none;" href="../home">Home</a></li>
                <li class="left"><a style="text-decoration:none;"href="../about-us">About Us</a></li>
                <li class="left"><a style="text-decoration:none;"href="{{url('drivers')}}">Drivers</a></li>
                <li class="left"><a style="text-decoration:none;"href="../contact">Contact Us</a></li>
                
            </div>
          
            <div class="headbar">
            <li class="left"><a style="text-decoration:none; color: white;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        href="{{ route('logout') }}" data-toggle="modal" data-dismiss="modal" class="text-danger">Sign
                                        Out</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
           
               
            </div>
           
            <!-- <div class="log">
                <p>Logout.</p>
            </div> -->
     
    </div>
    <br>


  
    <div class="container flex-grow-1 container-p-y">



        <h4 class="font-weight-bold py-3 mb-4">
           My Profile
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">My Profile Settings</a>
                        <!-- <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password">Change password</a> -->
                            <!-- <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="">My Info</a> -->

<!--
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-social-links">Social links</a> -->
                        <!-- <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-connections">Connections</a> -->
                        <!-- <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-notifications">Notifications</a> -->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="{{asset('../uploads/profile/'.Auth::user()->photo)}}" alt
                                    class="d-block ui-w-80">
                                <div class="media-body ml-4">
                                    <div class="text-light small mt-1">Upload Photo here JPG, GIF or PNG. Max size of 800K</div>
                                    <a href="" class="text-primary" data-toggle="modal"
            data-target="#edit_profile{{ $data->id }}" style="text-decoration:none;">Profile Settings</a>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Name:</label>
                                 <h4>{{Auth::user()->name}}</h4>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email:</label>
                                    <h4>{{Auth::user()->email}}</h4>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Mobile:</label>
                                    <h4>{{Auth::user()->number}}</h4>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address:</label>
                                    <h4>{{Auth::user()->address}}</h4>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="form-label">My Password:</label>
                                    <input type="password" class="form-control" value="{{Auth::user()->password}}">
                                </div> -->
                            </div>
                            </div>
                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mt-3">
           <!-- <a href="../editprofile/{{Auth::user()->id}}"> <button class="btn btn-primary">Edit</button>&nbsp; </a> -->
           <!-- <a href="#" data-toggle="modal"
            data-target="#edit_profile{{ $data->id }}" class="btn btn-primary">Edit Profile &nbsp; </a>
            <a href="{{url('home')}}" class="btn btn-danger">Back</a> -->
        </div>
    </div>

    @include('editprofile')
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>
<style>
    body {
    background: #f5f5f5;
    margin-top: 20px;
    font-family: 'Poppins', sans-serif;
}

.ui-w-80 {
    width : 80px !important;
    height: auto;
}

.btn-default {
    border-color: rgba(24, 28, 33, 0.1);
    background  : rgba(0, 0, 0, 0);
    color       : #4E5155;
}

label.btn {
    margin-bottom: 0;
}

.btn-outline-primary {
    border-color: #26B4FF;
    background  : transparent;
    color       : #26B4FF;
}

.btn {
    cursor: pointer;
}

.text-light {
    color: #babbbc !important;
}

.btn-facebook {
    border-color: rgba(0, 0, 0, 0);
    background  : #3B5998;
    color       : #fff;
}

.btn-instagram {
    border-color: rgba(0, 0, 0, 0);
    background  : #000;
    color       : #fff;
}

.card {
    background-clip: padding-box;
    box-shadow     : 0 1px 4px rgba(24, 28, 33, 0.012);
}

.row-bordered {
    overflow: hidden;
}

.account-settings-fileinput {
    position  : absolute;
    visibility: hidden;
    width     : 1px;
    height    : 1px;
    opacity   : 0;
}

.account-settings-links .list-group-item.active {
    font-weight: bold !important;
}

html:not(.dark-style) .account-settings-links .list-group-item.active {
    background: transparent !important;
}

.account-settings-multiselect~.select2-container {
    width: 100% !important;
}

.light-style .account-settings-links .list-group-item {
    padding     : 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}

.light-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}

.material-style .account-settings-links .list-group-item {
    padding     : 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}

.material-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}

.dark-style .account-settings-links .list-group-item {
    padding     : 0.85rem 1.5rem;
    border-color: rgba(255, 255, 255, 0.03) !important;
}

.dark-style .account-settings-links .list-group-item.active {
    color: #fff !important;
}

.light-style .account-settings-links .list-group-item.active {
    color: #4E5155 !important;
}

.light-style .account-settings-links .list-group-item {
    padding     : 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}

/* .wrapper {
    width:  100%;
    height:130px;
    background-color: black;
    display:flex;


}
.wrapper, .headbar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap: 5rem;
    margin-right:37%;

}
.wrapper, .headbar, .bar{

    color: white;
    list-style:none;
 

}

.logo{
    margin-left: 20px;
} */

.wrapper {
    width:  100%;
    height:130px;
    background-color:black;
    display:flex;
    justify-content: space-between;
    align-items:center;


}

.wrapper, .logo, .left{
    display:flex;
    color:white;
    font-size: 15px;

}
.logo, .left{
  gap: 20px;
  margin: 20px;
}

.wrapper, .headbar, h6{
    color: white;
}
.headbar, h6{
    margin-right: 5px;
}
.body{
    overflow:hidden;
}
.logo, .left. a:hover{
    color:red;
    text-decoration:none;
    font-weight: bold;


}
.wrapper, .logo, .left, a{

    color:white;
    text-decoration:none;

}







</style>

