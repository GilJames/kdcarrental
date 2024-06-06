<div class="main-wrapper">
		<div class="header" >
			<div class="header-left" style="background-color:#565353;">
				<a href="{{ url('admin_dashboard') }}" class="logo">  <span class="logoclass" style="color:#fff" >K & D CAR RENTAL</span> </a>
				<!-- <a href="{{ url('admin_dashboard') }}" class="logo logo-small"> <img src="{{asset('../uploads/profile/' . Auth::user()->photo)}}" alt="Logo" width="30" height="30"> </a> -->
			</div>
			<a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
			<a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
			<ul class="nav user-menu">
				<li class="nav-item dropdown noti-dropdown">
					<div class="dropdown-menu notifications">
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('../uploads/profile/' . Auth::user()->photo)}}">
											</span>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('../uploads/profile/' . Auth::user()->photo)}}">
											</span>
											<div class="media-body">
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('../uploads/profile/' . Auth::user()->photo)}}">
											</span>
											<div class="media-body">
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('../uploads/profile/' . Auth::user()->photo)}}">
											</span>
											<div class="media-body">
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</li>
				<li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span class="user-img"><img class="rounded-circle" src="{{asset('../uploads/profile/' . Auth::user()->photo)}}" width="31" alt=""></span> </a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm"> <img src="{{asset('../uploads/profile/' . Auth::user()->photo)}}" alt="User Image" class="avatar-img rounded-circle"> </div>
							<div class="user-text">
								<h6>{{ Auth::user()->name }}</h6>
								{{-- <p class="text-muted mb-0">Administrator</p> --}}
							</div>
						</div> <a class="dropdown-item" href="{{url('adminprofile')}}">My Profile</a> <a class="dropdown-item" href="{{url('adminprofile')}}">Account Settings</a>
                        	<a onclick="event.preventDefault();
								document.getElementById('logout-form').submit();"
                            		href="{{ route('logout') }}" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-account"></i>
                                </div>
                            </div>

                            {{-- Logout --}}
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">Logout</p>
                            </div>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
				</li>
			</ul>
		</div>
         <style>
            .header{

                background-color: #C43535;

            }



         </style>




