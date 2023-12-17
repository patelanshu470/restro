jQuery(document).ready(function() {
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
                searching: true,
                ajax: {
                url: subcategorylistindex,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (d){
                    d.subcategory = $('#subcategory').val(),
                    d.search = $('input[type="search"]').val(),
                    d.category = $('#category').val()
                    d.status = $('#status').val()
                }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'status', name: 'status'},
                    {

                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
        });
        $("#subcategory").keyup(function () {
            Ot.draw();
        });
        $("#category").click(function () {
            Ot.draw();
        });
        $("#status").click(function () {
            Ot.draw();
        });
    }
    jQuery(document).on('change', '.status', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var subcategory_id = $(this).data('id');

        toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };

        $.ajax({
            type: "GET",
            dataType: "json",
            url: subcategorystatus,
            data: {'status': status, 'subcategory_id': subcategory_id},
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

$('#validation').validate({
    rules: {
        name: {
          required: true
        },
        category_id: {
            required: true
          },

    },
    messages: {
      name: {
          required: "This name field is required",
      },
      category_id: {
        required: "This Category field is required",
    },

    }
});
