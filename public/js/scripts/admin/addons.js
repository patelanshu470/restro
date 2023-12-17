jQuery(document).ready(function() {
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
                searching: true,
                ajax: {
                url: addonslistindex,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (d){
                    d.restaurant_id = $('#restaurant_id').val()
                    d.status = $('#status').val()
                    d.name = $('#name').val()
                }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    // {data: 'restaurant_id', name: 'restaurant_id'},
                    {data: 'price', name: 'price'},
                    {data: 'cost_price', name: 'cost_price'},
                    {data: 'status', name: 'status'},
                    {

                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
        });
        $("#restaurant_id").change(function () {
            Ot.draw();
        });
        $("#status").click(function () {
            Ot.draw();
        });
        $("#name").keyup(function () {
            Ot.draw();
        });
    }
    jQuery(document).on('change', '.status', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var addons_id = $(this).data('id');

        toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };

        $.ajax({
            type: "GET",
            dataType: "json",
            url: addonsstatus,
            data: {'status': status, 'addons_id': addons_id},
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
        restaurant_id: {
            required: true
        },
        price: {
            required: true
        },
        cost_price: {
            required: true
        },

        },
        messages: {
        name: {
            required: "This name field is required",
        },
        restaurant_id: {
            required: "This restaurant field is required",
        },
        price: {
            required: "This price field is required",
        },
        cost_price: {
            required: "This cost price field is required",
        },

    }
});
