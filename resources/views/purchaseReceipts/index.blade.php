@extends('layouts.app')

@section('page_level_styles')
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <link rel="stylesheet" type="text/css"
          href="../../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="../../assets/global/plugins/datatables/media/css/jquery.dataTables.min.css"/>
@endsection

@section('page_content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-shopping-cart"></i> Listing
            </div>
            <div class="actions">
                <a href="javascript:;" class="btn default yellow-stripe">
                    <i class="fa fa-plus"></i>
								<span class="hidden-480">
								New Purchase </span>
                </a>
                <div class="btn-group">
                    <a class="btn default yellow-stripe" href="javascript:;" data-toggle="dropdown">
                        <i class="fa fa-share"></i>
									<span class="hidden-480">
									Tools </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:;">
                                Export to Excel </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                Export to CSV </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                Export to XML </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a href="javascript:;">
                                Print Invoices </a>
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
                        <th width="10%">
                            Mã
                        </th>
                        <th width="25%">
                            Khách hàng
                        </th>
                        <th width="15%">
                            Ngày hóa đơn
                        </th>
                        <th width="5%">
                            CP khác
                        </th>
                        <th width="5%">
                            Giảm giá
                        </th>
                        <th width="3%">
                            VAT?
                        </th>
                        <th width="20%">
                            Tổng cộng
                        </th>
                        <th width="10%">
                            Ghi chú
                        </th>
                        <th>Tools</th>
                    </tr>
                    <tr role="row" class="filter">
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="purchase_receipt_id">
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="supplier_name">
                        </td>
                        <td>
                            <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                <input type="text" class="form-control form-filter input-sm" readonly name="purchase_date_from" placeholder="From">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
                            </div>
                            <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                <input type="text" class="form-control form-filter input-sm" readonly name="purchase_date_to" placeholder="To">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
                            </div>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div id="all_total">
                                <strong></strong>
                            </div>
                        </td>
                        <td></td>
                        <td>
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
@endsection

@section('my_scripts')
    <script>
        jQuery(document).ready(function() {
            PurchaseTableAjax.init();
        });
    </script>
@endsection