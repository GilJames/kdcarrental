
<script>
    $(document).ready(function() {
        $('#selectDrive').change(function() {
            var val = $(this).val();

            // Hide all elements with IDs that don't match the selected option
            $('[id$="tableParentClass"]').addClass('d-none');

            // Show the element corresponding to the selected option
            $(`#${val}tableParentClass`).removeClass('d-none');

            // Update the session variable when the dropdown changes
            $.post('/update-session', { selectedOption: val });
        });
    });
</script>
