<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <h2>Reports</h2>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="start">By Month & Year</label>
                                    <input type="month" id="start" class="MonthYear form-control" name="start"
                                        wire:model="searchmonth" />
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <label>Status</label>
                                    <select class="form-control" wire:model="statusFilter">
                                        <option value="" selected>Any</option>
                                        <option value="confirm">Confirmed</option>
                                        <option value="completed">Completed</option>
                                        <option value="reject">Rejected</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label>Start Date:</label>
                                    <input type="date" wire:model="startDate" class="form-control">
                                    <label>End Date:</label>
                                    <input type="date" wire:model="endDate" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <td colspan="8" class="text-right">
                                <button id="printButton">Print</button>

                            </td>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Car Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Reason</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody class="livewireTableBody" id="tableBody">
                        @if ($bookings->count() > 0)
                            @foreach ($bookings as $key => $book)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ ucfirst($book->user->name) }}</td>
                                    <td>{{ ucfirst($book->admincar->carname) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($book->pickupdate)->format('F d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($book->dropoffdate)->format('F d, Y') }}</td>
                                    <td>{{ $book->status }}</td>
                                    @if ($book->status == 'cancelled')
                                        <td>{{ $book->cancelled_reason ?? 'N/A' }}</td>
                                    @elseif($book->status == 'reject')
                                        <td>{{ $book->reject_reason ?? 'N/A' }}</td>
                                    @elseif($book->status == 'confirm')
                                        <td>{{ $book->confirm ?? 'N/A' }}</td>
                                    @elseif($book->status == 'completed')
                                        <td>{{ $book->status == 'completed' ? 'N/A' : ($book->status == 'rejected' ? $book->reject_reason : ($book->status == 'cancelled' ? $book->cancelled_reason : '')) }}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center text-danger">No data found</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="clearfix">
                <hr>
                {{ $bookings->links() }}
            </div>
            <!-- Chart Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-chart">
                        <div class="card-header">
                            {{--
                            <label for="yearInput">Select Year:</label>
                             <input type="number" class="form-control w-25" id="yearInput" name="year" wire:model="year" min="1900"
                                max="2100"> --}}
                            {{-- <input type="number" class="form-control w-25" name="year" min="1900" max="2100"
                                wire:model="year" />
                            <input type="number" class="form-control w-25" id="yearInput" name="year" min="1900"
                                max="2100" value="{{ $year }}" /> --}}
                        </div>
                        <div id="neededscreenshoot">
                            <div class="card-body" id="chartContainer">
                                <canvas id="realtimeChart" width="400" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($bookings->count() > 0)
        <script>
            // Define the getMonthIndex function
            function getMonthIndex(monthName) {
                var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
                    'November', 'December'
                ];
                return months.indexOf(monthName) + 1;
            }

            document.addEventListener('livewire:load', function() {
                Livewire.on('updateChart', function(data) {
                    updateChart(data.salesData);
                    console.log(data);
                });

                var ctx = $('#realtimeChart')[0].getContext('2d');
                var myChart;

                function captureScreenshotAndGeneratePDF() {
                    // Capture the screenshot of the chart container
                    html2pdf(document.getElementById('chartContainer'), {
                        margin: 10,
                        filename: 'chart_report.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 0.98
                        },
                        html2canvas: {
                            scale: 2
                        },
                        jsPDF: {
                            unit: 'mm',
                            format: 'a4',
                            orientation: 'portrait'
                        }
                    });
                }
                document.getElementById('printButton').addEventListener('click', function() {
                    captureScreenshotAndGeneratePDF();
                });

                function fetchData(monthYear) {
                    Livewire.emit('fetchChartData', monthYear);
                }

                function updateChart(salesData) {
                    var aggregatedData = Array.from({
                        length: 12
                    }, () => 0);

                    salesData.forEach(entry => {
                        var monthIndex = getMonthIndex(entry.month);
                        var total = parseFloat(entry.total);
                        aggregatedData[monthIndex - 1] += total;

                        // Set the background color based on whether the month is highlighted or not
                        var backgroundColor = entry.highlighted ? 'rgba(0, 128, 0, 0.5)' :
                            'rgba(169, 169, 169, 0.2)';
                        myChart.data.datasets[0].backgroundColor[monthIndex - 1] = backgroundColor;
                    });

                    myChart.data.datasets[0].data = aggregatedData;
                    myChart.update();
                }

                function initializeChart() {
                    myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                                'September',
                                'October', 'November', 'December'
                            ],
                            datasets: [{
                                label: 'Total Sales Per Month',
                                data: Array(12).fill(0),
                                backgroundColor: Array(12).fill('rgba(169, 169, 169, 0.2)'),
                                borderColor: 'rgba(0, 100, 0, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    anchor: 'end',
                                    align: 'end',
                                    formatter: function(value, context) {
                                        return value;
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    updateChartData(); // This line initiates the update of chart data
                }

                function updateChartData() {
                    var year = $('.MonthYear').val();
                    fetchData(year);
                }

                initializeChart();
            });
        </script>
        <script type="text/javascript">
            document.getElementById('printButton').addEventListener('click', function() {
                // Take the screenshot first and wait for it to complete
                screenshot();
            });

            async function screenshot() {
                html2canvas(document.getElementById('neededscreenshoot')).then(function(canvas) {
                    var base64Image = canvas.toDataURL('image/png');
                    // Emit Livewire event to capture and save the screenshot
                    Livewire.emit('captureScreenshot', base64Image);
                });
            }
        </script>
    @else
        <p>No bookings available. Graph will not be displayed.</p>
    @endif
</div>
