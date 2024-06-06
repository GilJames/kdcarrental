<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0') }}"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" type="{{ asset('new_admin/image/x-icon" href="new_admin/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/https://cdn.oesmith.co.uk/morris-0.5.1.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> 
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>


    <style>
        .container {
            margin: auto;
            margin-right: 5rem;
            margin-top: 5rem;
            max-width: 1200px;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-wrapper .btn {
            float: right;
            color: #333;
            background-color: #fff;
            border-radius: 3px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-wrapper .btn:hover {
            color: #333;
            background: #f2f2f2;
        }

        .table-wrapper .btn.btn-primary {
            color: #fff;
            background: #03A9F4;
        }

        .table-wrapper .btn.btn-primary:hover {
            background: #03a3e7;
        }

        .table-title .btn {
            font-size: 13px;
            border: none;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        .table-title {
            color: #fff;
            background: #4b5366;
            padding: 16px 25px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .show-entries select.form-control {
            width: 60px;
            margin: 0 5px;
        }

        .table-filter .filter-group {
            float: right;
            margin-left: 15px;
        }

        .table-filter input,
        .table-filter select {
            height: 34px;
            border-radius: 3px;
            border-color: #ddd;
            box-shadow: none;
        }

        .table-filter {
            padding: 5px 0 15px;
            border-bottom: 1px solid #e9e9e9;
            margin-bottom: 5px;
        }

        .table-filter .btn {
            height: 34px;
        }

        .table-filter label {
            font-weight: normal;
            margin-left: 10px;
        }

        .table-filter select,
        .table-filter input {
            display: inline-block;
            margin-left: 5px;
        }

        .table-filter input {
            width: 200px;
            display: inline-block;
        }

        .filter-group select.form-control {
            width: 110px;
        }

        .filter-icon {
            float: right;
            margin-top: 7px;
        }

        .filter-icon i {
            font-size: 18px;
            opacity: 0.7;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 80px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.view {
            width: 30px;
            height: 30px;
            color: #2196F3;
            border: 2px solid;
            border-radius: 30px;
            text-align: center;
        }

        table.table td a.view i {
            font-size: 22px;
            margin: 2px 0 0 1px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .status {
            font-size: 30px;
            margin: 2px 2px 0 0;
            display: inline-block;
            vertical-align: middle;
            line-height: 10px;
        }

        .text-success {
            color: #10c469;
        }

        .text-info {
            color: #62c9e8;
        }

        .text-warning {
            color: #FFC107;
        }

        .text-danger {
            color: #ff5b5b;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @livewireStyles
    @stack('scripts')
</head>

<body>


    <!-- heading -->
    @include('admin.header')
    <!-- end heading -->

    <!-- leftbar -->
    @include('admin.leftbar')
    <!-- end leftbar -->

    <br>




    <div>
        {{ $slot }}
    </div>


    {{-- <script src="{{ asset('new_admin/assets/js/jquery-3.5.1.min.js') }}"></script> --}}
    <script src="{{ asset('new_admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('new_admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('new_admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('new_admin/assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('new_admin/assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('new_admin/assets/js/chart.morris.js') }}"></script>
    <script src="{{ asset('new_admin/assets/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- <script>
        function toUpper(data) {
            string = data;
            newString = string[0].toUpperCase() + string.slice(1);
            return newString;
        }
        $(document).ready(function() {
            $('.monthValue').change(function() {
                // if (val === '') {
                //     console.log('empty');
                // }

                var val = $('.monthValue').val();

                var date = new Date(val);

                // Check if the date is valid
                if (isNaN(date.getTime())) {
                    console.error('Invalid date value:', val);
                    return;
                }

                var options = {
                    year: 'numeric',
                    month: 'long'
                };
                var outputDate = new Intl.DateTimeFormat('en-US', options).format(date);

                $('.monthAndYear').text(outputDate);

                $.ajax({
                    url: '{{ route('getmonth_and_completed_status') }}',
                    type: 'POST',
                    data: {
                        month: val,
                    },
                    success: function(response) {
                        $('#tableBody').empty();
                        var totalPayment = 0;

                        $.each(response.data, function(index, booking) {
                            var key = index + 1;
                            var row = '<tr>' +
                                '<td>' + key + '</td>' +
                                '<td>' + toUpper(booking.user.name) + '</td>' +
                                '<td>' + toUpper(booking.admincar.carname) + '</td>' +
                                '<td>' + booking.pickupdate + '</td>' +
                                '<td>' + booking.dropoffdate + '</td>' +
                                '<td>' + booking.status + '</td>' +
                                '<td>' + (booking.status === 'completed' ? 'N/A' : (
                                    booking.status === 'rejected' ? booking
                                    .reject_reason : (booking.status ===
                                        'cancelled' ? booking.cancelled_reason : '')
                                    )) + '</td>';

                            '</tr>';

                            totalPayment += parseFloat(booking.total_payment || 0);

                            $('#tableBody').append(row);
                        });

                        $('.total_sales').text(totalPayment);
                        if (response.data.length === 0) {
                            var noDataRow =
                                '<tr><td colspan="6" class="text-center text-danger">No data found</td></tr>';
                            $('#tableBody').append(noDataRow);
                        }
                    },
                    error: function(error) {
                        // Handle error, if needed
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <script>
        var currentYear = new Date().getFullYear();


        $('#yearInput').val(currentYear);


        var ctx = $('#realtimeChart')[0].getContext('2d');
        var myChart;


        function fetchData(year) {

            $.ajax({
                url: '/gettotalsales',
                method: 'GET',
                data: {
                    'year': year,
                },
                success: function(data) {

                    updateChart(data);
                    console.log(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }


        function updateChart(data) {

            var aggregatedData = Array.from({
                length: 12
            }, () => 0);

            data.salesData.forEach(entry => {

                var monthIndex = getMonthIndex(entry.month);


                var total = parseInt(entry.total, 10);


                aggregatedData[monthIndex - 1] += total;
            });


            myChart.data.datasets[0].data = aggregatedData;
            myChart.update();
        }


        function getMonthIndex(monthName) {
            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
                'November', 'December'
            ];
            return months.indexOf(monthName) + 1;
        }


        function initializeChart() {
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ],
                    datasets: [{
                        label: 'Total Sales Per Month',
                        data: Array(12).fill(0),
                        backgroundColor: 'rgba(0, 128, 0, 0.2)', // Green background
                        borderColor: 'rgba(0, 100, 0, 1)', // Dark green border
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


            updateChartData();
        }


        function updateChartData() {

            var year = $('#yearInput').val();


            fetchData(year);
        }


        $('#yearInput').on('change', function() {
            updateChartData();
        });


        initializeChart();
    </script> --}}
    @livewireScripts



</body>

</html>
