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
                {data: "price_in_hint"},
                {data: "price_out_hint"},
                {data: "in_stock"},
                {data: "edit", orderable: false, searchable: false},
                {data: "delete", orderable: false, searchable: false}
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
            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            var itemId = oTable.fnGetData(nRow).id;
            $.ajax({
                type: "DELETE",
                url: "/ajax/item/" + itemId,
                success: function(msg) { 
                    alert("Deleted");
                    oTable.fnDeleteRow(nRow);
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi');
                }
            });
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