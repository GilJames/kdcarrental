{{-- adding a jQuery script here to control date picker from picking disabled dates and display booked dates --}}
<script>
    var bookk = {!! json_encode($bookings) !!}; // array of bookings from the database
    var calendar; // Initialize calendar variable

    updateCalendarAndDateInputs(bookk);

    function daysofTrip() {
        // Retrieve the values from the input fields
        var pickupDateStr = $(".pickupdateInput").val();
        var dropoffDateStr = $(".dropoffdateInput").val();

        console.log(pickupDateStr);
        console.log(dropoffDateStr);

        // Convert date strings to Date objects
        var pickupDate = new Date(pickupDateStr);
        var dropoffDate = new Date(dropoffDateStr);

        // Check if both dates are valid
        if (!isNaN(pickupDate) && !isNaN(dropoffDate)) {
            // Calculate the difference in days
            var daysDifference = Math.floor((dropoffDate - pickupDate) / (1000 * 60 * 60 * 24));

            // Display the result
            if (!isNaN(daysDifference)) {
                $('.daytripInput').val(daysDifference + 1);
            }
        }
    }

    function totalPayment() {
        if ($('.daytripInput').val() !== '') {
            var price = parseInt($('.carPriceVal').val());
            var days = parseInt($('.daytripInput').val());

            $('.totalPayment').text(price * days);
            $('.inputtotalPayment').val(price * days);
        }
    }


    function updateCalendarAndDateInputs(bookk) {


        // disable date in date picker
        function getTodayDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0'); // Month is 0-based
            const day = String(today.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        $('.dateInput').attr('min', getTodayDate());

        const disabledDateRanges = [];

        disabledDateRanges.length = 0;

        bookk.forEach(function(booking) {
            var startDate = moment(booking.pickupdate);
            var endDate = moment(booking.dropoffdate);

            // Add a condition to consider only 'confirm', 'pending', and 'To_pay' bookings
            if (
                booking.status === 'confirm' ||
                booking.status === 'pending' ||
                booking.status === 'To_pay'
            ) {
                disabledDateRanges.push({
                    start: startDate,
                    end: endDate,
                });
            }
        });

        console.log(disabledDateRanges);

        // Disable the specified date ranges
        $('.dateInput').on('input', function() {
            const selectedDate = moment($(this).val());
            for (const range of disabledDateRanges) {
                if (selectedDate.isBetween(range.start, range.end, null, '[]')) {
                    $(this).val('');
                    alert('Already booked.');
                    break;
                }
            }
        });

        // Style the disabled dates
        $('.dateInput').on('focus', function() {
            const allDates = $(this).parent().find('input[type="date"]');
            allDates.each(function() {
                const currentDate = moment($(this).val());
                for (const range of disabledDateRanges) {
                    if (currentDate.isBetween(range.start, range.end, null, '[]')) {
                        $(this).addClass('disabled-date');
                        break;
                    } else {
                        $(this).removeClass('disabled-date');
                    }
                }
            });
        });

        if (calendar) {
            calendar.fullCalendar('destroy');
        }

        // end here

        var events = [];

        bookk.forEach(function(booking) {
            var startDate = moment(booking.pickupdate);
            var endDate = moment(booking.dropoffdate);

            while (startDate <= endDate) {
                events.push({
                    id: booking.id,
                    title: 'Booked',
                    start: startDate.format('YYYY-MM-DD'),
                    status: booking.status,
                });

                startDate.add(1, 'days');
            }
        });

        // Initialize the fullCalendar instance
        calendar = $('.calendar').fullCalendar({
            editable: false,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month',
            },
            events: events,
            eventRender: function(event, element) {
                if (
                    event.status === 'confirm' ||
                    event.status === 'pending' ||
                    event.status === 'To_pay'
                ) {
                    element.find('.fc-title').text('Booked');
                    element.find('.fc-content').css('text-align', 'center');
                    element.css('background-color', 'red');
                    element.css('color', 'white');
                    element.addClass('booked-event');
                } else {
                    return false;
                }
            },
        });
    }

    $(document).ready(function() {
        $('#carList').on('change', function() {
            // Get the selected value from the dropdown
            var selectedValue = $(this).val();
            var bk_id = $(this).data('bk_id');


            $(`.date_picker`).val('');

            // Use jQuery AJAX to get the data from the server
            $.ajax({
                type: 'get',
                url: '/getBookingById',
                data: {
                    id: selectedValue,
                    bk_id: bk_id,
                },
                success: function(response) {
                    // Update the 'bookk' array with the received data
                    bookk = response.bookings;

                    // Call the function to update the calendar and date inputs
                    updateCalendarAndDateInputs(bookk);

                    // Do something with the updated array, if needed
                    console.log('Data updated successfully:', bookk);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                },
            });
        });

        // Combine event handlers for pickup and drop-off date inputs
        $('.pickupdateInput, .dropoffdateInput').change(function() {
            daysofTrip();
            totalPayment();
        });

        // Set the min attribute of the date input to today's date

        // Initialize an array to store the disabled date ranges
    });
</script>
<script>
    $(document).ready(function() {
        // Check if the URL contains the hash '#bookingForm'
        if (window.location.hash === '.bookingFormwrapper') {
            // Scroll down to the form
            $('html, body').animate({
                    scrollTop: $('.bookingFormwrapper').offset().top,
                },
                'slow'
            );
        }
    });
</script>
