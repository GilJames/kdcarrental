@extends('layouts.admin')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <br>
                    <br>
                    <div class="col">
                        <br><br>
                        <div class="col-auto float-right ml-auto">
                            <h4 class="card-title float-left mt-2"></h4> <a href="{{ url('adduser') }}"
                                class="btn btn-primary float-right veiwbutton" data-toggle="modal" data-target="#adduser">Add
                                Customer</a>
                        </div>
                    </div>

                    @include('admin.adduser')


                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body booking_card">
                            <div class="table-responsive">

                                <form action="{{ url('searchUser') }}" method="GET">
                                    <div class="col-sm-5 offset-sm-7">
                                        <div class="input-group">
                                            <input type="text" name="searchUser" class="form-control"
                                                placeholder="Search...">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <button type="submit" class="fa fa-search"></button>
                                                </span>
                                                @if (request()->has('searchUser') && request()->input('searchUser') != '')
                                                    <a href="{{ url('searchUser') }}" class="btn btn-outline-secondary">
                                                        Clear
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <table
                                    class="datatable table table-striped table table-hover table-center table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile</th>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Address</th>
                                            <th>Password</th>
                                            <th>User Role</th>
                                            <th>isBan/unBan</th>
                                            <th>Status</th>
                                            <th class="text-right">Info</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp

                                        @foreach ($data as $user)
                                            <tr id="parent_tr{{ $user->id }}">
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <img src="{{ asset('/uploads/profile/' . $user->photo) }}"
                                                        class="rounded-circle" alt="image" width="50px" height="50px">
                                                <td>
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
                                                <td id="yes_no{{ $user->id }}">
                                                    @if ($user->isBanned())
                                                        <label class="label label-danger">Yes</label>
                                                    @else
                                                        <label class="label label-success">No</label>
                                                    @endif
                                                </td>
                                                <td id="revoke_ban{{ $user->id }}">
                                                    @if ($user->isBanned())
                                                        {{-- <a href="#" class="btn btn-success btn-sm revoke_user"
                                                            data-status="revoked" data-id="{{ $user->id }}"
                                                            data-action="user/revokeuser">Revoke</a> --}}
                                                        <a href="#" class="btn btn-success btn-sm revoke_user"
                                                            onclick="revokeUser('user/revokeuser', {{ $user->id }}, '#parent_tr{{ $user->id }}')"
                                                            data-status="revoked" data-id="{{ $user->id }}"
                                                            data-action="user/revokeuser">Enable</a>
                                                    @else
                                                        <a class="btn btn-success ban btn-sm ban_user" data-status="banned"
                                                            data-id="{{ $user->id }}" data-action="userBan"
                                                            data-toggle="modal"
                                                            data-target="#banModal{{ $user->id }}">Disable</a>


                                                        <!-- The modal -->
                                                        <div class="modal fade" id="banModal{{ $user->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="banModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form id="form_id{{ $user->id }}" action="">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="banModalLabel">
                                                                                Disable
                                                                                User
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="reason">Reason</label>
                                                                                        <textarea class="form-control" id="reason{{ $user->id }}" rows="5"
                                                                                            placeholder="Enter the reason for disabled"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel</button>
                                                                            {{-- <a class="btn btn-success ban btn-sm ban_user" data-status="banned" data-id="{{ $user->id }}" data-action="userBanWithreason">Ban</a> --}}
                                                                            <button type="button" class="btn btn-danger"
                                                                                onclick="onClickBanUser('userBanWithreason', {{ $user->id }}, '#parent_tr{{ $user->id }}')">Confirm
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td id="user_info{{ $user->id }}">
                                                    @if ($user->isBanned())
                                                        <div class="actions"> <a href="#"
                                                                class="badge btn btn-sm bg-danger-light mr-2">InActive</a>
                                                        </div>
                                                    @else
                                                        <div class="actions"> <a href="#"
                                                                class="badge btn btn-sm bg-success-light mr-2">Active</a>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div> <a href="#" data-toggle="modal" title="Edit User"
                                                            data-target="#edit_user{{ $user->id }}"><i
                                                                class="fa-solid fa-pen-to-square"
                                                                style="color:blue;"></i></a>
                                                    </div>
                                                    <div>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#viewRemarks"><i
                                                                class="fa-solid fa-pen-to-square"
                                                                style="color:blue;"></i>Remarks</a>
                                                    </div>


                                                    <div id="delete_asset" class="modal fade delete-modal"
                                                        role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-body text-center"> <img
                                                                        src="new_admin/assets/img/sent.png" alt=""
                                                                        width="50" height="46">
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
                                                    @include('modal.remarksUser')
                                                </td>
                                            </tr>
                                            @include('admin.edituser')
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <hr>
                                    {{ $data->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
