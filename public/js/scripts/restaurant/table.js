jQuery(document).ready(function() {
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
                searching: true,
                ajax: {
                url: tablelistindex,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'guest_number', name: 'guest_number'},
                    {data: 'status', name: 'status'},
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
$('#validation').validate({
    rules: {
        name: {
          required: true
        },
        guest_number: {
            required: true
        },
        status: {
            required: true
        },
        location: {
            required: true
        },
        quantity: {
            required: true
        },
    },
    messages: {
        name: {
            required: "This table name field is required",
        },
        guest_number: {
            required: "This guest number field is required",
        },
        status: {
            required: "This status field is required",
        },
        location: {
            required: "This location field is required",
        },
        quantity: {
            required: "This quantity field is required",
        },

    }
});
