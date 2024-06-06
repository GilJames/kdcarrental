<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <title>{{ config('app.name') }}</title> -->
    <title>Reports</title>


    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
        * {
            * {
                padding: 0%;
                margin: .5%;
            }

        }

        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
            background: rgb(13, 168, 28);
            background: linear-gradient(90deg, rgba(13, 168, 28, 1) 0%, rgba(200, 254, 252, 1) 50%, rgba(92, 166, 181, 1) 100%);
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;

        }

        .invoice-box {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 10px;
            line-height: 20px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        #h1 {
            text-align: center;
        }

        th {
            padding: 10px;
        }

        .data {
            padding: 5px;
        }

        .tble,
        .head,
        .data {

            border: 1px solid #000;
            border-collapse: collapse;
            padding: 15px;

        }

        .title,
        h1,
        h3 {
            text-align: center
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
</head>

<body>




    <div class="title">
        <h1>K & D CAR RENTAL SERVICES</h1>
        <h3>Purok Anahawon, Maramag, <br>Bukidnon</h3>
    </div>

    <br>

    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/assets/images/samples/car.png'))) }}">
                            </td>
                            <td>

                                <span>Date: January 1, 2023</span><br />
                                <!-- <span>Due: February 1, 2023</span> -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Owner Number: <b> 0955801167</b> <br>
                                Owner Name: <b>Gil James A. Ledda </b> <br>
                                Owner Address: <b> Purok Anahawon, Maramag, Bukidnon</b>
                            </td>

                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="2" style="text-align:center;"> Sales Reports</td>

            </tr>
            <br>


        </table>
        <br>
        <br>
        <div class="container">

            <table class="tble">
                <tr>
                    <th class="head">Or #</th>
                    <th>Booker</th>
                    <th class="head">Vehicle Name</th>
                    <th class="head">Vehicle Model</th>
                    <th class="head">Pickup Date</th>
                    <th class="head">Dropoff Date</th>
                    <th class="head">Rental Days</th>
                    <th class="head">Rental Total</th>
                </tr>

                @foreach ($bookings as $key => $book)
                    <tr>
                        <td class="data">{{ $book->confirmed_OR ?? 'N/A' }}</td>
                        <td class="data" style="text-align:center;">{{ ucfirst($book->user->name) }}</td>
                        <td class="data" style="text-align:center;">{{ ucfirst($book->admincar->carname) }}</td>
                        <td class="data">{{ ucfirst($book->admincar->carmodel) }}</td>
                        <td class="data">{{ \Carbon\Carbon::parse($book->pickupdate)->format('F d, Y') }}</td>
                        <td class="data">{{ \Carbon\Carbon::parse($book->dropoffdate)->format('F d, Y') }}</td>
                        <td class="data">{{ $book->daytrip }}</td>
                        <td class="data">{{ $book->total_payment }}</td>
                    </tr>
                @endforeach


            </table>
        </div>
        <div style="page-break-before: always;"></div>
        <div >
            @if ($imagePath)
                <?php
                    $imageData = file_get_contents(storage_path('app/'.$imagePath));
                    $base64Image = 'data:image/png;base64,' . base64_encode($imageData);
                ?>
                 <div style="display: flex; align-items: center; justify-content: center; height: 100vh;">
                    <img id="graph" style="max-width: 100%; height: auto;" src="{{ $base64Image }}" alt="Image">
                </div>
            @else
                <p>No image available</p>
            @endif
        </div>
        
    </div> 
    

</body>

</html>
