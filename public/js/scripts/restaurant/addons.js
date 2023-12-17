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
                    d.name = $('#name').val()
                    d.status = $('#status').val()
                }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'status', name: 'status'},

                ]
        });
        $("#name").keyup(function () {
            Ot.draw();
        });
        $("#status").click(function () {
            Ot.draw();
        });
    }
});
