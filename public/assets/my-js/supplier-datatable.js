var TableSupplier = function () {

    var handleTable = function () {
        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i+1], nRow, i+1, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-medium" value="' + aData[2] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-medium" value="' + aData[3] + '">';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '">';
            jqTds[4].innerHTML = '<input type="text" class="form-control input-large" value="' + aData[5] + '">';
            jqTds[5].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[6].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 5, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 6, false);
            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 7, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 5, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 6, false);
            oTable.fnDraw();
        }

        var table = $('#supplier_table');
        var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            "ajax": {
                url : '/ajax/supplier'
            },

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // set the initial value
            "pageLength": 10,

            "ordering": true,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [1]
            }, {
                'visible': false,
                'targets': [0]
            }],
            "order": [
                [0, 'desc']
            ] // set first column as a default sort by asc
        });

        var nEditing = null;
        var nNew = false;

        $('#supplier_table_new').click(function (e) {
            e.preventDefault();

            if (nEditing) {
                if (confirm("Previose row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    // $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    if (nNew) {
                        oTable.fnDeleteRow(nEditing); // cancel
                        nEditing = null;
                        nNew = false;

                        return;
                    }
                    restoreRow(oTable, nEditing);
                }
            }
            oTable.fnSort([[0, "asc"]]);
            var aiNew = oTable.fnAddData(['','','','','','','','']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            var supplierId = oTable.fnGetData(nRow)[0];

            swal({
                title: 'Xóa nhà cung cấp này?',
                text: "Sẽ xóa hết dữ liệu liên quan, không khuyến khích xóa!!",
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
                    url: "/ajax/supplier/" + supplierId,
                    success: function (msg) {
                        swal({
                            allowOutsideClick: false,
                            title: 'Đã xóa!',
                            text: 'Nhà cung cấp đã được xóa',
                            type: 'success'
                        }).then(function () {
                            oTable.fnDeleteRow(nRow);
                        });
                    },
                    error: function (xhr, status, error) {
                        swal(
                            'Đệt, có lỗi',
                            'Lỗi cmnr',
                            'error'
                        )
                    }
                });
            });
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();
            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                if (nNew) {
                    oTable.fnDeleteRow(nEditing);
                    // oTable.fnDraw();
                    editRow(oTable, nRow);
                    nEditing = nRow;
                    nNew = false;
                    return ;
                }
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
                var aData = oTable.fnGetData(nRow);
                if (nNew) {
                    $.ajax({
                        url: "/ajax/supplier",
                        type: "POST",
                        data: {data: aData},
                        error: function(xhr, status, error) {
                            alert('Có lỗi');
                            
                            // location.reload();
                        },
                        success: function (newSupplierId) {
                            oTable.fnUpdate(newSupplierId, nRow, 0, false);
                            nNew = false;
                        }
                    });
                    return ;
                }
                $.ajax({
                    url: "/ajax/supplier/" + aData[0],
                    type: "PUT",
                    data: {data: aData},
                    error: function(xhr, status, error) {
                        alert('Có lỗi');
                        location.reload();
                    },
                    success: function (result) {
                    }
                });
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };

}();