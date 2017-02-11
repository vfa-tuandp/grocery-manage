var CashTableAjax = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            autoclose: true
        });
    }

    var handleRecords = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_ajax"),
            onSuccess: function (grid, response) {
                $('#total strong:first').text('Thu: ' + response.total_in + ' đ');
                $('#total strong:last').text('Chi: ' + response.total_out + ' đ');
            },
            onError: function (grid) {
                grid.clearAjaxParams();
                // execute some code on network or other general error
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": "/ajax/cash_flow", // ajax source
                    "type": "GET"
                },
                "order": [
                    [0, 'desc']
                ],
                stripeClasses:[],
                "columns": [
                    {data: "datetime", orderable: true},
                    {data: "content"},
                    {data: "value", className: "dt-right"},
                    {data: "type", className: "dt-center"},
                    {data: "note"},
                    {data: 'detail', name: 'detail', orderable: false, searchable: false, class: "details-control dt-center"}
                ],
                "createdRow": function( row, data, dataIndex ) {
                    if ( data['type'] == "Thu" ) {
                        $(row).addClass( 'info' );
                    } else {
                        $(row).addClass( 'warning' );
                    }
                }
            }
        });

        // Array to track the ids of the details displayed rows
        var detailRows = [];

        $('#datatable_ajax tbody').on( 'click', 'tr td.details-control .detail', function () {
            var tr = $(this).closest('tr');
            var row = grid.getDataTable().row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {
                tr.removeClass( 'details' );
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice( idx, 1 );
            }
            else {
                var orderDetail = {};
                if (row.data().cashflowable_id) {
                    tr.addClass( 'details' );
                    $.when(getOrderDetail(row.data())).done(function (data) {
                        orderDetail = data;
                        row.child( format( row.data(), orderDetail ) ).show();
                    });


                    // Add to the 'open' array
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }
                } else {
                    location.href = '/cash_flow/' + row.data().id + '/edit';
                }

            }
        });

        $('#datatable_ajax thead').on('click', 'tr td .filter-cancel', function() {
            var set = $('input.form-filter[type="checkbox"]');
            setTimeout(function () {
                $(set).each(function () {
                    $(this).attr("checked", true);
                });
                $.uniform.update(set)
            }, 300);
        });

        function format ( d, orderDetail ) {
            var tbody = '';
             $(orderDetail).each(function (index, value) {
                 tbody += '<tr>' +
                     '<td>' + value.item.name + '</td>' +
                     '<td>' + value.quantity + '</td>' +
                     '<td>' + value.item.unit + '</td>' +
                     '<td>' + value.price + '</td>' +
                     '<td>' + value.other_cost_on_item + '</td>' +
                     '<td>' + value.reduction_on_item + '</td>' +
                     '<td>' + value.sum + '</td>' +
                     '<td>' + value.note_on_item + '</td>' +
                     '</tr>';
             });

            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<thead>' +
                    '<tr>' +
                    '<th>Sản phẩm</th>' +
                    '<th>Số lượng</th>' +
                    '<th>ĐVT</th>' +
                    '<th>Giá</th>' +
                    '<th>CP khác</th>' +
                    '<th>Giảm giá</th>' +
                    '<th>Tổng</th>' +
                    '<th>Ghi chú</th>' +
                    '</tr>' +
                '</thead>' +
                '<tbody>' + tbody + '</tbody>' +
                '</table>';
        }

        function getOrderDetail(params) {
            var url = '';
            if (params.type == 'Chi') {
               url = "/ajax/purchase/" + params.cashflowable_id + "/purchase_detail";
            }

            if (params.type == 'Thu') {
                url = "/ajax/order/" + params.cashflowable_id + "/order_detail";
            }

            return $.ajax({
                url: url,
                type: "GET",
                success:function(data) {
                },
                error: function(xhr,status,error) {
                }
            });
        }

        $('#datatable_ajax tbody').on( 'click', 'tr td.details-control .edit', function () {
            var tr = $(this).closest('tr');
            var row = grid.getDataTable().row( tr );
            location.href = '/category';
        });
    }

    return {

        //main function to initiate the module
        init: function () {

            initPickers();
            handleRecords();
        }

    };

}();