<style>
    /* Define a container to hold the rows and columns */
    .container {
        width: 100%;
        max-width: 1200px;
        /* Optional: Set a maximum width for the container */
        margin: 0 auto;
        /* Center the container on the page */
    }

    /* Define a class for rows */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: -15px;
        /* Optional: Negative margin to counteract column padding */
    }

    /* Define a class for columns */
    .col {
        flex: 0 0 100%;
        /* Default to full width */
        padding: 15px;
        /* Add padding to the columns */
        box-sizing: border-box;
        /* Include padding and border in the column's total width */
    }

    /* Customize col-6 to take up half the width */
    .col-6 {
        flex: 0 0 50%;
    }

    .col-12 {
        flex: 0 0 100%;
    }
</style>