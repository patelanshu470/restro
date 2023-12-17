jQuery(document).ready(function() {
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                // filter: true,
                searching: true,
                ajax: {
                url: categorylistindex,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (d){
                    d.category = $('#category').val(),
                    d.search = $('input[type="search"]').val(),
                    d.status = $('#status').val()
                }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {

                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
        });
        $("#category").keyup(function () {
            Ot.draw();
        });
        $("#status").click(function () {
            Ot.draw();
        });
    }
    jQuery(document).on('change', '.status', function() {
        // alert("d");
        var status = $(this).prop('checked') == true ? 1 : 0;
        var category_id = $(this).data('id');

        toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };

        $.ajax({
            type: "GET",
            dataType: "json",
            url: categorystatus,
            data: {'status': status, 'category_id': category_id},
            success: function(data){
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                    // // return false;
                    // test();
                }
            }
        });
    });
});


