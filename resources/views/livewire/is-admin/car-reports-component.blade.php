<div class="page-wrapper">
    <div class="content container-fluid">

        {{-- WTF --}}
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <h2>Car Reports</h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Carname</th>
                            <th>Last Booked</th>
                            <th>Last Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ucfirst($report->admincar->carname)}}</td>
                                <td>{{ \DateTime::createFromFormat('Y-m-d', $report->pickupdate)->format('F d, Y') }} - {{ \DateTime::createFromFormat('Y-m-d', $report->dropoffdate)->format('F d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->lastrate)->format('F j, Y') }}</td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
