$(document).ready(function(){
    $('.delete_product').click(function() {
        var pro_id = $(this).attr('delete-product');
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };
        $.ajax({
            type: "GET",
            url: removed_cart_modal,
            data: {
                "_token": "{{ csrf_token() }}",
                "id": pro_id

            },
            success: function(res) {
                $("#exampleModalScrollable").html(res);
            }

        });
    });
});
