<script>
    $(document).ready(function(){
        $(document).on("change", ".checkbox_service", function() {
            showAndHideInput();
    })
    showAndHideInput();

    function showAndHideInput() {
        $(".checkbox_service").each(function() {
            var id= $(this).data("service_id");
            if (!$(this).prop("checked")) {
                $(`.display_${id}`).hide();
            } else {
                $(`.display_${id}`).show();

            }
        })
    }
    })
    
</script>