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
            <form role="form" action="{{ route('item.store') }}" method="POST">
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
                            <div class="form-group form-md-line-input">
                                <select class="form-control select2me" id="customer_id" name="customer_id">
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            <b>{{ $customer->name }}</b> ------------ {{ $customer->company }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="category">Khách hàng</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group form-md-line-input">
                                <div class="md-checkbox md-checkbox-inline">
                                    <input type="checkbox" id="vat" name="vat" class="md-check">
                                    <label for="vat">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>
                                        Tính VAT?</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row section">
                        <div class="col-md-4">
                            <div class="form-group form-md-line-input has-info">
                                <select class="form-control" id="category_id" name="category_id[]">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <label for="category">Loại hàng</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-md-line-input">
                                <select class="form-control" id="item_id" name="item_id[]">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <label for="product_name">Mặt hàng</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group form-md-line-input">
                                <input type="number" class="form-control" id="price_out" name="price_out[]"
                                       placeholder="Giá bán ra">
                                <label for="price_out_hint">Giá bán</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group form-md-line-input">
                                <input type="text" disabled class="form-control" id="unit" name="unit"
                                       placeholder="Đvt">
                                <label for=unit>Đơn vị tính</label>
                                <span class="help-block">Đơn vị tính của sản phẩm</span>
                            </div>
                            <a class="btn btn-circle btn-icon-only red" href="javascript:;">
                                <i class="icon-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="addsection" class="form-actions noborder">
                    <a class="btn blue addsection">Thêm</a>
                </div>
                <div class="form-actions noborder">
                    <button type="submit" class="btn blue">Tạo mới</button>
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
    {{--<script>--}}
    {{--$(function () {--}}
    {{--var dateNow = new Date();--}}
    {{--$('#datetimepicker').datetimepicker({--}}
    {{--defaultDate:dateNow--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
    {{--<script>--}}
    {{--jQuery(document).ready(function () {--}}
    {{--showHideInStockField();--}}
    {{--$('#check_in_stock').click(function () {--}}
    {{--showHideInStockField();--}}
    {{--});--}}
    {{--});--}}
    {{--function showHideInStockField() {--}}
    {{--if ($('#check_in_stock').is(":checked")) {--}}
    {{--$('#in_stock').parent('div').slideDown(300);--}}
    {{--} else {--}}
    {{--$('#in_stock').parent('div').slideUp(300);--}}
    {{--}--}}
    {{--}--}}
    {{--</script>--}}

    <script>
        jQuery(document).ready(function () {
            CreateOrder.init();
        });
    </script>
@endsection