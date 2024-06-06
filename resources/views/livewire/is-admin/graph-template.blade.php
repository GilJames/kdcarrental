<!-- resources/views/screenshot/capture.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
</head>

<body>

    <div id="neededscreenshoot">
        <h1>Take screenshot of webpage with html2canvas</h1>
        <div class="container" id='container'>
            <h1>Devnote is a tutorial.</h1>
        </div>
    </div>
    <button id='but_screenshot' onclick='screenshot();'>Take screenshot</button><br />

    <!-- Script -->
    <script type='text/javascript'>
        function screenshot() {
            html2canvas(document.getElementById('neededscreenshoot')).then(function (canvas) {
                var base64Image = canvas.toDataURL('image/png');
                saveScreenshot(base64Image);
            });
        }

        function saveScreenshot(image) {
            fetch('/save-screenshot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ image: image })
            }).then(response => response.json())
            .then(data => {
                alert(data.message);
            });
        }
    </script>

</body>

</html>


{{-- <!DOCTYPE html>
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
            border: 2px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
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


            </table>
        </div>
        <div style="width: 50vw; height: 50vh;">

            <canvas id="myChart"></canvas>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        // Sample data for the chart
        var data = {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Sample Chart',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                data: [65, 59, 80, 81, 56],
            }]
        };
    
        // Chart configuration
        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };
    
        // Function to generate PDF
        function generatePDF() {
            // Get the canvas element
            var ctx = document.getElementById('myChart').getContext('2d');
    
            // Create a line chart with onload callback
            var myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: options,
                plugins: [{
                    afterDraw: function(chart) {
                        generatePDFAfterChartRendered(chart);
                    }
                }]
            });
        }
    
        // Function to generate PDF after chart is rendered
        function generatePDFAfterChartRendered(chart) {
            // Use the onrendered callback of html2pdf
            html2pdf(document.body, {
                margin: 10,
                filename: 'report.pdf',
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
                },
                onrendered: function(canvas) {
                    var imgData = canvas.toDataURL('image/jpeg');
                    var doc = new jsPDF('p', 'mm', 'a4');
                    doc.addImage(imgData, 'JPEG', 0, 0, 210, 297);
                    doc.save('report.pdf');
                }
            });
        }
    
        // Call the generatePDF function after the page is fully loaded
        window.onload = function() {
            // Use a timeout to simulate data fetching/rendering delay
            setTimeout(function() {
                generatePDF();
            }, 1000);
        };
    </script>
    

</body>

</html> --}}
