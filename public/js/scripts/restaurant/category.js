jQuery(document).ready(function() {
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
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

                ]
        });
        $("#category").keyup(function () {
            Ot.draw();
        });
        $("#status").click(function () {
            Ot.draw();
        });
    }
});
