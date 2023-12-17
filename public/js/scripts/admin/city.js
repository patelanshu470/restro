jQuery(document).ready(function() {
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
                searching: true,
                ajax: {
                url: citylistindex,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'state_id', name: 'state_id'},
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
$("#validation").validate({
    rules: {
        name: {
            required: true,
        },
        state_id: {
            required: true,
        },
    },
    messages: {
        name: {
            required: "This Name field is required",
        },
        state_id: {
            required: "This state field is required",
        },
    },
    submitHandler: function(form) {
        form.submit();
    }
});
