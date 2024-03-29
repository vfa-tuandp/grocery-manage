@extends('layouts.app')

@section('page_level_styles')
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <link rel="stylesheet" type="text/css"
          href="../../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="../../assets/global/plugins/datatables/media/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="../../assets/global/plugins/icheck/skins/all.css"/>
@endsection

@section('page_content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-shopping-cart"></i>Thống kê kho
            </div>
            <div class="actions">
                <div class="btn-group">
                    <a class="btn default yellow-stripe" href="javascript:;" data-toggle="dropdown">
                        <i class="fa fa-share"></i>
									<span class="hidden-480">
									Công cụ</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="/order/create">
                                Bán hàng</a>
                        </li>
                        <li>
                            <a href="/purchase/create">
                                Nhập hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <div class="table-actions-wrapper">
									<span>
									</span>
                    <select class="table-group-action-input form-control input-inline input-small input-sm">
                        <option value="">Select...</option>
                        <option value="Cancel">Cancel</option>
                        <option value="Cancel">Hold</option>
                        <option value="Cancel">On Hold</option>
                        <option value="Close">Close</option>
                    </select>
                    <button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
                </div>
                <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                    <thead>
                    <tr role="row" class="heading">
                        <th width="15%">
                            Ngày phát sinh
                        </th>
                        <th width="15%">
                            Danh mục
                        </th>
                        <th width="15%">
                            Sản phẩm
                        </th>
                        <th width="15%">
                            Số lượng
                        </th>
                        <th width="10%">
                            Loại
                        </th>
                        <th width="15%">
                            Khách hàng/Người cung cấp
                        </th>
                        <th width="10%">Tools</th>
                    </tr>
                    <tr role="row" class="filter">
                        <td>
                            <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                <input type="text" class="form-control form-filter input-sm" readonly name="date_from" placeholder="From">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
                            </div>
                            <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                <input type="text" class="form-control form-filter input-sm" readonly name="date_to" placeholder="To">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
                            </div>
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="category_name">
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="item_name">
                        </td>
                        <td class="dt-center">
                            <div id="quantity_count">
                                <p><strong></strong></p>
                                <p><strong></strong></p>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="icheck-list">
                                        <label>
                                            <input type="checkbox" name="kind[]" checked value="1" class="form-control form-filter chck-filter-submit">
                                            Nhập
                                        </label>
                                        <label>
                                            <input type="checkbox" name="kind[]" checked value="2" class="form-control form-filter chck-filter-submit">
                                            Bán
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="target_name">
                        </td>
                        <td class="dt-center">
                            <div class="margin-bottom-5">
                                <button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                            </div>
                            <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection

@section('page_level_plugins')
    <script type="text/javascript" src="{{ asset('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript"
    src=" {{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/global/plugins/icheck/icheck.min.js') }}"></script>
@endsection

@section('my_scripts')
    <script>
        jQuery(document).ready(function() {
            StockTableAjax.init();
        });
    </script>
@endsection