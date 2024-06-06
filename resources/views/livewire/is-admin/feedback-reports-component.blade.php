<div class="page-wrapper">
    <div class="content container-fluid">

        {{-- WTF --}}
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <h2>Feedback Reports</h2>
                        </div>
                        <div class="col-sm-5 offset-sm-3">
                            <div class="filter-group float-right">
                                <input type="text" wire:model="searchTerm" class="form-control" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Carname</th>
                            <th>Date of comment</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks->groupBy('user_id') as $userFeedbacks)
                            <tr>
                                <td>{{ $userFeedbacks->first()->user->name }}</td>
                                <td>
                                    <ul>
                                        @foreach ($userFeedbacks->groupBy('admincars_id') as $byCarId)
                                            <li>{{ $byCarId->first()->admincar->carname }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($userFeedbacks->groupBy('admincars_id') as $byCarId)
                                            <li>{{ $byCarId->first()->updated_at->format('F d, Y') }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td style="width: 500px;">
                                    <ul>
                                        @foreach ($userFeedbacks->groupBy('comment') as $byCarId)
                                            <li>{{ $byCarId->first()->comment != null? $byCarId->first()->comment : 'No Comment' }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <hr>
                {{$feedbacks->links()}}
            </div>
            </div>
        </div>
    </div>
</div>
