<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <div class="table-responsive">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h2>User Activity Logs</h2>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select name="" class="form-control" wire:model="selected">
                                                        <option value="">All</option>
                                                        <option value="user">User</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <input type="text" wire:model="searchTerm"
                                                            class="form-control" placeholder="Search...">
                                                        <button class="btn btn-primary" type="button">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Description</th>
                                            <th>Date Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($activityLog as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td style="width: 450px;">{{ $item->date_time }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-danger">No data found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <hr>
                                    {{ $activityLog->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
