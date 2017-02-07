@extends('layouts.app')

@section('page_level_styles')
    <link rel="stylesheet" type="text/css" href=" {{ asset('/assets/global/plugins/select2/select2.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <link rel="stylesheet" type="text/css"
          href="../../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>

@endsection

@section('page_content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light bordered">
        @if (count($errors) > 0)
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="portlet-title">
            <div class="caption font-red-sunglo">
                <i class="icon-settings font-red-sunglo"></i>
                <span class="caption-subject bold uppercase"> Tạo đơn hàng mới</span>
            </div>
            <div class="actions">
                <div class="btn-group">
                    <a class="btn btn-sm green dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                        Actions <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-pencil"></i> Edit </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-trash-o"></i> Delete </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-ban"></i> Ban </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="i"></i> Make admin </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="portlet-body form">
            <form id="createNewOrderForm" role="form" action="{{ route('order.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-body" id="create-order-form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input">
                                <div class="input-group date form_datetime">
                                    <input type="text" readonly size="16" class="form-control" name="datetime">
                                    <label for="category">Ngày hóa đơn</label>

                                    <span class="input-group-btn">
                                    <button class="btn default date-reset" type="button"><i
                                                class="fa fa-times"></i></button>
                                    <button class="btn default date-set" type="button"><i
                                                class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group form-md-line-input">
                                        <select class="form-control select2me" id="customer_id" name="customer_id">
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">
                                                    <b>{{ $customer->name }}</b> --- {{ $customer->company }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="category">Khách hàng</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-md-line-input">
                                        <div class="md-checkbox md-checkbox-inline">
                                            <input onchange="calculateTotal();" type="checkbox" id="vat" name="vat" class="md-check">
                                            <label for="vat">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span>
                                                Tính VAT?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="alert alert-info text-center" id="total">
                                        <strong>Thành Tiền!!</strong>
                                        <input type="hidden" name="total">
                                    </div>
                                </div>
                                <div class="col-md-5 group-tools">
                                    <a onclick="showHideOrderNote();" class="btn btn-circle btn-icon-only btn-default"
                                       href="javascript:;">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="order-note-field" hidden>
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <input onblur="calculateTotal();" type="text"
                                           class="form-control my-currency"
                                           id="other_cost"
                                           name="other_cost"
                                           placeholder="Chi phí khác trên đơn hàng">
                                    <span class="help-block">Chi phí khác trên đơn hàng</span>
                                            <span class="input-group-addon">
                                                <i class="fa fa-usd"></i>
                                            </span>
                                    <label for="other_cost"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <input onblur="calculateTotal();" type="text"
                                           class="form-control my-currency"
                                           id="reduction"
                                           name="reduction"
                                           placeholder="Giảm giá trên đơn hàng">
                                    <span class="help-block">Giảm giá trên đơn hàng</span>
                                            <span class="input-group-addon">
                                                <i class="fa fa-usd"></i>
                                            </span>
                                    <label for="reduction"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                        <textarea class="form-control" name="note" id="note"
                                                  placeholder="Ghi chú của đơn hàng"></textarea>
                                <span class="help-block">Ghi chú của đơn hàng</span>
                                <label for="note"></label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row section">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group form-md-line-input has-info">
                                        <select onchange="getItems(this);" class="form-control" id="category_id"
                                                name="category_id[]">
                                            <option value="0">--Select category--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        {{--<label for="category_id">Loại hàng</label>--}}
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group form-md-line-input">
                                        <select onchange="selectItem(this);" class="form-control list-items"
                                                id="item_id"
                                                name="item_id[]">
                                        </select>
                                        {{--<label for="item_id">Mặt hàng</label>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 number-field">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <div class="input-group">
                                            <input onblur="calculateSum(this);" type="text"
                                                   class="form-control my-currency" id="price"
                                                   name="price[]" placeholder="Đơn giá">
                                            <span class="help-block">Đơn giá</span>
                                            <label for="price"></label>
                                            <span class="input-group-addon">
											    <i class="fa fa-usd"></i>
											</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <div class="input-group right-addon">
                                            <input onchange="calculateSum(this);" type="number" min="1"
                                                   class="form-control"
                                                   id="quantity"
                                                   name="quantity[]" placehoder="SL">
                                            <label for=""></label>
                                            <span class="help-block">SL</span>
                                            <span class="input-group-addon unit"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group form-md-line-input">
                                        <div class="input-group">
                                            <input type="text" min="0" readonly disabled
                                                   class="form-control my-currency" id="sum"
                                                   name="sum[]"
                                                   placeholder="Tổng">
                                            <label for="sum">Tổng</label>
                                            <span class="input-group-addon">
                                                <i class="fa fa-usd"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 group-tools">
                                    <a onclick="showHideNote(this);" class="btn btn-circle btn-icon-only btn-default"
                                       href="javascript:;">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </a>
                                    <a onclick="deleteField(this); "
                                       class="btn btn-circle btn-icon-only btn-default remove"
                                       href="javascript:;">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 note-field" hidden>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-md-line-input">
                                        <div class="input-group">
                                            <input onblur="calculateSum(this);" type="text"
                                                   class="form-control my-currency"
                                                   id="other_cost_on_item"
                                                   name="other_cost_on_item[]"
                                                   placeholder="Chi phí khác">
                                            <span class="help-block">Chi phí khác</span>
                                            <span class="input-group-addon">
                                                <i class="fa fa-usd"></i>
                                            </span>
                                            <label for="other_cost_on_item"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-md-line-input">
                                        <div class="input-group">
                                            <input onblur="calculateSum(this);" type="text"
                                                   class="form-control my-currency"
                                                   id="reduction_on_item"
                                                   name="reduction_on_item[]"
                                                   placeholder="Giảm giá">
                                            <span class="help-block">Giảm giá</span>
                                            <span class="input-group-addon">
                                                <i class="fa fa-usd"></i>
                                            </span>
                                            <label for="reduction_on_item"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-md-line-input">
                                        <textarea class="form-control" name="note_on_item[]" id="note_on_item"
                                                  placeholder="Ghi chú"></textarea>
                                        <span class="help-block">Ghi chú</span>
                                        <label for="note_on_item"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <div id="addsection" class="form-actions noborder pull-right">
                            <a class="btn disabled btn-circle btn-icon-only blue addsection">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-actions noborder">
                            <button id="createNewOrder" class="btn yellow">
                                Tạo mới
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection

@section('page_level_plugins')
    <script type="text/javascript" src="{{ asset('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript"
            src=" {{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

@endsection

@section('my_scripts')
    <script>
        var itemsByCategory = [];

        function showHideNote(el) {
            $(el).closest('.section').find('.note-field').toggle("slide");
        }

        function showHideOrderNote() {
            $('#order-note-field').toggle("slide");
        }

        function deleteField(el) {
            $(el).closest('.section').fadeOut(300, function () {
                //remove parent element (main section)
                $(this).empty();
                calculateTotal();
                $('#addsection .addsection').removeClass("disabled");
                return false;
            });
            return false;
        }

        function getItems(el) {
            $.ajax({
                url: '/ajax/category/' + el.value + '/items',
                type: 'GET',
                data: {
                    format: 'json'
                },
                error: function () {
                    alert('Co loi');
                },
                dataType: 'json',
                success: function (data) {
                    itemsByCategory = $.merge(itemsByCategory, data);
                    var itemSelect = $(el).closest('.row').find('.list-items');
                    itemSelect.empty();
                    $.each(data, function (key, value) {
                        itemSelect.append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.name));
                    });
                    $('#addsection .addsection').removeClass("disabled");
                    selectItem(itemSelect[0]);
                }
            });
        }

        function selectItem(el) {
            var selectedItem = $.grep(itemsByCategory, function (e) {
                return e.id == el.value;
            });
            var rowSection = $(el).closest('.row.section');
            rowSection.find("input[name^='price']").val(selectedItem[0].price_out_hint);
            var quantityEl = rowSection.find("input[name^='quantity']");
            quantityEl.val(1);
            quantityEl.parent().find('.unit').text(selectedItem[0].unit);

            calculateSum(el);
        }

        function calculateSum(el) {
            var rowSection = $(el).closest('.row.section');
            var sum = Number(rowSection.find("input[name^='price']").first().unmask())
                    * rowSection.find("input[name^='quantity']").first().val()
                    + Number(rowSection.find("input[name^='other_cost_on_item']").first().unmask())
                    - Number(rowSection.find("input[name^='reduction_on_item']").first().unmask());

            rowSection.find("input[name^='sum']").val(sum).priceFormat({
                prefix: '',
                thousandsSeparator: '.',
                centsLimit: 0,
                suffix: '',
                allowNegative: true
            });

            calculateTotal();
        }

        function calculateTotal() {
            var total = 0;
            $('#create-order-form').find(".row.section input[name^='sum']").each(function () {
                total += Number($(this).unmask());
            });

            var vatRate = $('#vat').is(":checked") ? 110 : 100;
            total = Number((total + Number($('#other_cost').unmask())) * vatRate / 100)
                    - Number($('#reduction').unmask());

            $('#total strong').text(Number(total)).priceFormat({
                prefix: '',
                thousandsSeparator: '.',
                centsLimit: 0,
                suffix: ' đ',
                allowNegative: true
            });

            $("#total input[name^='total']").val(total);
        }
    </script>

    <script>
        jQuery(document).ready(function () {
            CreateOrder.init();
        });
        var currencyEls = $(".row.section, #order-note-field").find('.my-currency');
        currencyEls.each(function () {
            $(this).priceFormat({
                prefix: '',
                thousandsSeparator: '.',
                suffix: '',
                centsLimit: 0
            });
        });

        $('#createNewOrder').click(function (e) {
            e.preventDefault();
            swal({
                title: 'Tạo đơn hàng này ?',
                text: "Hãy chắc chắn các thông tin nhập vào là đúng",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok tạo mới!',
                cancelButtonText: 'Chờ tí, để xem lại',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-cancel',
                buttonsStyling: false
            }).then(function () {
                var form = $("#createNewOrderForm");
                var rowData = [];
                form.find('.row.section').each(function() {
                    var itemId = $(this).find("select[name^='item_id']").val();
                    if (!itemId) {
                        return true;
                    }
                    rowData.push({
                        "item_id": $(this).find("select[name^='item_id']").val(),
                        "price": Number($(this).find("input[name^='price']").unmask()),
                        "quantity": $(this).find("input[name^='quantity']").val(),
                        "other_cost_on_item": Number($(this).find("input[name^='other_cost_on_item']").unmask()),
                        "reduction_on_item": Number($(this).find("input[name^='reduction_on_item']").unmask()),
                        "note_on_item": $(this).find("textarea[name^='note_on_item']").val(),
                        "sum": Number($(this).find("input[name^='sum']").unmask())
                    });
                });

                var data = {
                    "datetime": form.find("input[name='datetime']").val(),
                    "customer_id": form.find("select[name='customer_id']").val(),
                    "vat": form.find("input[name='vat']").is(':checked') ? 1 : 0,
                    "total": form.find("input[name='total']").val(),
                    "other_cost": Number(form.find("input[name='other_cost']").unmask()),
                    "reduction": Number(form.find("input[name='reduction']").unmask()),
                    "note": form.find("textarea[name='note']").val(),
                    "items": rowData
                };

                $.ajax({
                    url:"/ajax/order/store",
                    data: data,
                    type: "POST",
                    success:function(data) {
                        swal(
                                'Đã tạo mới!',
                                'Đơn hàng này đã được tạo thành công',
                                'success'
                        ).then(function () {
                            location.reload();
                        })
                    },
                    error: function(xhr,status,error) {
                        var errors = xhr.responseJSON;
                        var errorsString = '';
                        $.each( errors, function( key, value ) {
                            errorsString += '<li>' + value[0] + '</li>'; //showing only the first error.
                        });
                        swal(
                                'Đệt, có lỗi',
                                errorsString,
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

    </script>
@endsection