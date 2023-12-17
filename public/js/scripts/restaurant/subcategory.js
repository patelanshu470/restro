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
});
