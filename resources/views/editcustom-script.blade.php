<script>
    function totalPayment() {
        if ($('.daytripInput').val() !== '') {
            var price = parseInt($('.carPriceVal').val());
            var days = parseInt($('.daytripInput').val());

            $('.totalPayment').text(price * days);
            $('.inputtotalPayment').val(price * days);
        }
    }

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
            // if (!isNaN(daysDifference)) {
            //     $('.daytripInput').val(daysDifference);
            // }
            if (pickupDateStr === dropoffDateStr) {
                $('.daytripInput').val(daysDifference + 1);
            } else {
                $('.daytripInput').val(daysDifference);
            }
        }
    }

    // disable date in date picker
    function getTodayDate() {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Month is 0-based
        const day = String(today.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize FullCalendar
        var calendar = $('.calendar').fullCalendar({
            // FullCalendar configuration options
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            // Add other FullCalendar options as needed

            // Fetch booked dates using AJAX
            events: function(start, end, timezone, callback) {
                // Get the selected carList ID and bk_id
                var selectedCarId = $('#carList').val();
                var bk_id = $('#carList').data('bk_id');

                // Make AJAX request to get booked dates for the selected carList
                $.ajax({
                    url: '/getBookingById', // Replace with your actual endpoint
                    type: 'GET',
                    data: {
                        id: selectedCarId,
                        bk_id: bk_id
                    },
                    success: function(response) {
                        console.log(response);
                        // Process the response and format it for FullCalendar
                        var events = [];

                        response.bookings.forEach(function(booking) {
                            // Check if the status is confirm, pending, or To_pay
                            if (booking.status === 'confirm' || booking
                                .status === 'pending' || booking.status ===
                                'To_pay') {
                                // Get the start and end dates
                                var startDate = moment(booking.pickupdate);
                                var endDate = moment(booking.dropoffdate);

                                // Add separate events for each day in the range
                                while (startDate.isSameOrBefore(endDate,
                                        'day')) {
                                    // Check if the event for this day already exists
                                    var existingEvent = events.find(function(
                                        event) {
                                        return moment(event.start)
                                            .isSame(startDate, 'day');
                                    });

                                    // Add the event only if it doesn't exist for this day
                                    if (!existingEvent) {
                                        events.push({
                                            title: 'Booked',
                                            start: startDate.format(
                                                'YYYY-MM-DD'),
                                            color: 'red' // Red background
                                            // You can add more properties based on your needs
                                        });
                                    }

                                    // Move to the next day
                                    startDate.add(1, 'day');
                                }
                            }
                        });

                        // Call FullCalendar callback with the formatted events
                        callback(events);
                    }
                });
            }
        });

        // Trigger the events function when the carList selection changes
        $('#carList').on('change', function() {
            daysofTrip();
            totalPayment();
            $('.totalPayment').text('--------');
            $('.dateInput').val('');
            $('.daytripInput').val(0);
            calendar.fullCalendar('refetchEvents');
        });

        $('.dateInput').on('input', function() {
            daysofTrip();
            totalPayment();
            const selectedDate = moment($(this).val());
            const bookedDates = calendar.fullCalendar('clientEvents', function(event) {
                return event.title === 'Booked';
            }).map(function(event) {
                return moment(event.start).format('YYYY-MM-DD');
            });

            for (const bookedDate of bookedDates) {
                if (selectedDate.isSame(bookedDate)) {
                    $(this).val('');
                    alert('Already booked.');
                    break;
                }
            }
        });
    });
</script>
