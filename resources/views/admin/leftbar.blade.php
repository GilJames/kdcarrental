<!-- <div class="sidebar">
<div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="assets/img/profile.jpg">
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        Hizrian
                        <span class="user-level">Administrator</span>
                        <span class="caret"></span>
                    </span>
                </a>
                <div class="clearfix"></div>

                <div class="collapse in" id="collapseExample" aria-expanded="true">
                    <ul class="nav">
                        <li>
                            <a href="#profile">
                                <span class="link-collapse">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#edit">
                                <span class="link-collapse">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <span class="link-collapse">Settings</span>
                            </a>
                        </li>

                        <div class="dropdown-divider"></div>
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
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item active">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin_dashboard') }}">
                    <i class="la la-table"></i>
                    <p>Manage Booking</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admincar') }}">
                    <i class="la la-keyboard-o"></i>
                    <p>Manage Car</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('adminuser') }}">
                    <i class="la la-th"></i>
                    <p>Manage User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin_dashboard') }}">
                    <i class="la la-bell"></i>
                    <p>User Feedback</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin_dashboard') }}">
                    <i class="la la-font"></i>
                    <p>All Reports</p>
                </a>
            </li>
        </ul>
    </div>
</div> -->
@php
     $notifbooking =
        App\Models\Booking::where('status', 'pending')->count() +
        App\Models\Selfdrive::where('status', 'pending')->count();
     $notifFeedback = App\Models\Feedback::where('status', 'rated')->count();

@endphp
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ 'admin_dashboard' == request()->path() ? 'active' : '' }}"> <a
                        href="{{ url('admin_dashboard') }}"><i class="fas fa-tachometer-alt"></i>
                        <span  style="color:#fff">Dashboard</span></a> </li>
                <li class="list-divider"></li>
                <li class="{{ 'bookingwithdriver' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('bookingwithdriver') }}"><i class="fas fa-address-book"></i> <span style="color:#fff"> Bookings
                        </span>

                        @if ($notifbooking > 0)
                            <span style="position: relative;" class="notificationBellClass">
                                <i id="bellIcon" class="fas fa-bell fa-lg shake"></i>
                                <span
                                    style="position: absolute; right: -60%; top: -10%; border-radius: 50%; background-color: rgb(1, 136, 1); color: aliceblue;"
                                    class="badge">{{ $notifbooking }}</span>
                               </span>
                        @endif

                        {{-- @if ($data->status == 'pending')
                                <span class="right badge badge-danger">{{ $data->total() }}</span>
                                @endif --}}
                    </a>
                </li>
                <li class="{{ 'adminuser' == request()->path() ? 'active' : '' }}"> <a
                        href="{{ url('adminuser') }}"><i class="fas fa-user"></i> <span  style="color:#fff"> Manage Users </span></a>
                </li>
                <li class="{{ 'admincar' == request()->path() ? 'active' : '' }}"> <a href="{{ url('admincar') }}"><i
                            class="fas fa-car"></i> <span style="color:#fff"> Manage Cars </span></a>
                </li>
                <li class="{{ 'admindriver' == request()->path() ? 'active' : '' }}"> <a
                        href="{{ url('admindriver') }}"><i class="fas fa-address-card"></i> <span style="color:#fff"> Manage Drivers
                        </span></a>
                </li>

                <li class="{{ 'feedback' == request()->path() ? 'active' : '' }}"> <a href="{{ url('feedback') }}"><i
                            class="fas fa-comments"></i> <span style="color:#fff"> Manage Feedback </span></a>
                </li>
                <li class="{{ 'bookingreports' == request()->path() ? 'active' : '' }}"> <a
                        href="{{ url('bookingreports') }}"><i class="fas fa-file"></i> <span style="color:#fff" >  Booking
                            Reports</span></a>
                <li class="{{ 'feedbackreports' == request()->path() ? 'active' : '' }}"> <a
                        href="{{ url('feedbackreports') }}"><i class="fas fa-folder-open"></i> <span style="color:#fff"> Feedback
                            Reports</span>
                        @if ($notifFeedback > 0)
                            <span style="position: relative;" class="notificationBellClass">
                                <i id="bellIcon" class="fas fa-bell fa-lg shake"></i>
                                <span
                                    style="position: absolute; right: -60%; top: -10%; border-radius: 50%; background-color: rgb(1, 136, 1); color: aliceblue;"
                                    class="badge">{{ $notifFeedback }}</span>
                            </span>
                        @endif
                    </a>
                <li class="{{ 'userActivity' == request()->path() ? 'active' : '' }}"> <a
                        href="{{ url('userActivity') }}"><i class="fas fa-history"></i> <span style="color:#fff"> Activity Logs </span></a>
                </li>
            </ul>
        </div>
    </div>
</div>



<style>

    .sidebar{
      background-color:#565353;
    }



</style>
