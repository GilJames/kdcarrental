<div class="page-wrapper">

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">{{ session('message') }}
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                    @endif
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Users</h4> <a href="{{ url('adduser') }}"
                            class="btn btn-primary float-right veiwbutton">Add Customers</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Address</th>
                                        <th>Password</th>
                                        <th>User Role</th>
                                        <th>isBan/unBan</th>
                                        <th>Status</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($data as $user)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->number }}</td>
                                            <td>{{ $user->address }}</td>

                                            <td>Password</td>
                                            <td>
                                                @if ($user->role == '1')
                                                    Customer
                                                @elseif($user->role == '0')
                                                    Administrator
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->isBanned())
                                                    <label class="label label-danger">Yes</label>
                                                @else
                                                    <label class="label label-success">No</label>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->isBanned())
                                                    <a href="{{ url('users.revokeuser', $user->id) }}"
                                                        class="btn btn-success btn-sm"> Enable</a>
                                                @else
                                                    <a class="btn btn-success ban btn-sm"
                                                        data-id="{{ $user->id }}"
                                                        data-action="{{ route('users.ban') }}"> Disable</a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="actions"> <a href="#"
                                                        class="badge btn btn-sm bg-success-light mr-2">Active</a>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action"> <a href="#"
                                                        class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false"><i
                                                            class="fas fa-ellipsis-v ellipse_color"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right"> <a
                                                            class="dropdown-item"
                                                            href="{{ url('editinguser/' . $user->id) }}"><i
                                                                class="fas fa-pencil-alt m-r-5"></i>Manage User</a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('deleteuser/' . $user->id) }}"
                                                            data-toggle="modal" data-target="#delete_asset"><i
                                                                class="fas fa-trash-alt m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>

                                                <div id="delete_asset" class="modal fade delete-modal"
                                                    role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center"> <img
                                                                    src="new_admin/assets/img/sent.png"
                                                                    alt="" width="50" height="46">
                                                                <h3 class="delete_class">Are you sure want to delete
                                                                    this Asset?</h3>
                                                                <div class="m-t-20"> <a href="#"
                                                                        class="btn btn-white"
                                                                        data-dismiss="modal">Close</a>
                                                                    <a href="{{ url('deleteuser/' . $user->id) }}"><button
                                                                            type="submit"
                                                                            class="btn btn-danger">Delete</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
