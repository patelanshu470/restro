jQuery(document).ready(function() {
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
                searching: true,
                ajax: {
                url: statelistindex,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'country_id', name: 'country_id'},
                    {

                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
        });
    }
});
$("#add_state").validate({
        rules: {
            name: {
                required: true,
            },
            country_id: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This Name field is required",
            },
            country_id: {
                required: "This Country field is required",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
});


