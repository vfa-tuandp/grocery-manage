var TableAdvanced = function () {

    var initTable3 = function () {
        var table = $('#sample_3');

        /*
         * Initialize DataTables, with no sorting on the 'details' column
         */
        var oTable = table.dataTable({

            "ajax": {
                url : '/ajax/item'
            },

            "serverSide": true,
            "processing": true,

            "columns": [
                {data: "category.name"},
                {data: "name"},
                {data: "unit"},
                {data: "price_in_hint", className: "dt-right"},
                {data: "price_out_hint", className: "dt-right"},
                {data: "in_stock", className: "dt-right"},
                {data: "edit", orderable: false, searchable: false, className: "dt-center"},
                {data: "delete", orderable: false, searchable: false, className: "dt-center"}
            ],

            "order": [
                [1, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,
        });
        
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            var itemId = oTable.fnGetData(nRow).id;
            window.location = '/item/' + itemId + '/edit';
        })

        table.on('click', '.delete', function (e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            var itemId = oTable.fnGetData(nRow).id;
            swal({
                title: 'Xóa sản phẩm này?',
                text: "Xóa sp sẽ xóa hết tất cả những thứ liên quan!!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok xóa!',
                cancelButtonText: 'Chờ tí, để xem lại',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-cancel',
                buttonsStyling: false
            }).then(function () {
                $.ajax({
                    type: "DELETE",
                    url: "/ajax/item/" + itemId,
                    success: function(msg) {
                        swal({
                            allowOutsideClick: false,
                            title: 'Đã xóa!',
                            text:  'Sản phẩm đã được xóa',
                            type: 'success'
                        }).then(function () {
                            oTable.fnDeleteRow(nRow);
                        });
                    },
                    error: function(xhr, status, error) {
                        swal(
                            'Đệt, có lỗi',
                            'Lỗi cmnr',
                            'error'
                        )
                    }
                });
            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal(
                        'Ok',
                        'Hãy kiểm tra cẩn thận',
                        'error'
                    )
                }
            })
        });
        
        var tableWrapper = $('#sample_3_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper

        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
    }

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }
            initTable3();
        }

    };

}();