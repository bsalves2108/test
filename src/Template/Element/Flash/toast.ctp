<script>
    function displayMessage(message, title = 'Calendario') {
        toastr.success(message, title);
    }
    function displayErrorMessage(message, title = 'Calendario') {
        toastr.error(message, title);
    }
</script>
