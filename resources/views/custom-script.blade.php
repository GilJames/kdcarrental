{{-- adding a jquery script here to control date picker from picking disabled dates and display booked dates --}}
<script>
    var bookk = {!! json_encode($bookings) !!}; //array of bookings from the database

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
            if (!isNaN(daysDifference)) {
                if (pickupDateStr === dropoffDateStr) {
                    $('.daytripInput').val(daysDifference + 1);
                } else {
                    $('.daytripInput').val(daysDifference);
                }

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


    $(document).ready(function() {

        // Combine event handlers for pickup and drop-off date inputs
        $('.pickupdateInput, .dropoffdateInput').change(function() {
            daysofTrip();
            totalPayment();
        });

        // Set the min attribute of the date input to today's date
        $('.dateInput').attr('min', getTodayDate());

        // Initialize an array to store the disabled date ranges
        const disabledDateRanges = [];

        // Populate disabledDateRanges array from the bookk variable
        bookk.forEach(function(booking) {
            var startDate = moment(booking.pickupdate);
            var endDate = moment(booking.dropoffdate);

            // Add a condition to consider only 'confirm' and 'pending' bookings
            if (booking.status === 'confirm' || booking.status === 'pending' || booking.status ===
                'To_pay') {
                disabledDateRanges.push({
                    start: startDate,
                    end: endDate
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
                    status: booking.status
                });

                startDate.add(1, 'days');
            }
        });

        // console.log(events);

        var calendar = $('.calendar').fullCalendar({
            editable: false, // Make it false to disable drag and drop
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
            events: events,
            eventRender: function(event, element) {
                if (event.status === 'confirm' || event.status === 'pending' || event.status ===
                    'To_pay') {
                    element.find('.fc-title').text('Booked');
                    element.find('.fc-content').css('text-align', 'center');
                    element.css('background-color', 'red');
                    element.css('color', 'white');
                    element.addClass('booked-event');
                } else {
                    return false;
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Check if the URL contains the hash '#bookingForm'
        if (window.location.hash === '.bookingFormwrapper') {
            // Scroll down to the form
            $('html, body').animate({
                scrollTop: $('.bookingFormwrapper').offset().top
            }, 'slow');
        }
    });
</script>
