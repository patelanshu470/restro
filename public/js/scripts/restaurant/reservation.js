jQuery(document).ready(function() {
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
                searching: true,
                ajax: {
                url: reservationlistindex,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'guest_number', name: 'guest_number'},
                    {data: 'res_date', name: 'res_date'},
                    {data: 'from_time', name: 'from_time'},
                    {data: 'to_time', name: 'to_time'},
                    {data: 'table_id', name: 'table_id'},
                    {data: 'status', name: 'status',
                        orderable: true,
                        searchable: true
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: true,
                    //     searchable: true
                    // },

                ]
        });
    }
    jQuery(document).on('change', '.selectpicker', function() {
        var status = $(this).val();
        var reservation_id = $(this).data('id');
        var reservation_status_url = $(this).data('href');

        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };
        if (status === "approve") {
            $('#exampleModalCenter' + reservation_id).modal('show');
        }
        if (status === "reject") {
            $('#RejectexampleModalCenter' + reservation_id).modal('show');
        }
        // $.ajax({
        //     type: "GET",
        //     dataType: "json",
        //     url: reservation_status_url,
        //     data: {'status': status, 'reservation_id': reservation_id},
        //     success: function(data){
        //         if (data.success) {
        //             toastr.success(data.success);
        //         }
        //         if (data.error) {
        //             toastr.error(data.error);
        //         }
        //     }
        // });
        if (status === "visited") {
            Swal.fire({
                title: "Are you sure?",
                text: "Change status is Visited",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085D6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, did it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: reservation_status_url,
                    data: {'status': status, 'reservation_id': reservation_id},
                    success: function(data){
                        if (data.success) {
                            toastr.success(data.success);
                        }
                        if (data.error) {
                            toastr.error(data.error);
                        }
                    }
                });
                } else
                    return false;
            });
        }
    });

});




