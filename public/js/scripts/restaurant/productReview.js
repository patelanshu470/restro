jQuery(document).ready(function() {
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
                searching: true,
                ajax: {
                url: reviewlistindex,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // data: function (d){
                //     d.category = $('#category').val()
                //     d.name = $('#name').val()
                //     d.status = $('#status').val()
                //     d.type = $('#type').val()
                // }
                },
                columns: [
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'product_id', name: 'product_id'},
                    {data: 'user_id', name: 'user_id'},
                    // {data: 'product_id', name: 'product_id'},
                    {data: 'image', name: 'image'},
                    {data: 'description', name: 'description'},
                    {data: 'rating', name: 'rating'},
                    {data: 'status', name: 'status'},

                ]
        });
        // $("#category").click(function () {
        //     Ot.draw();
        // });
        // $("#name").keyup(function () {
        //     Ot.draw();
        // });
        // $("#status").click(function () {
        //     Ot.draw();
        // });
        // $("#type").click(function () {
        //     Ot.draw();
        // });
    }
    jQuery(document).on('change', '.status', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var product_id = $(this).data('id');

        toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };

        $.ajax({
            type: "GET",
            dataType: "json",
            url: restroproductreviewstatus,
            data: {'status': status, 'product_id': product_id},
            success: function(data){
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            }
        });
    });
});
