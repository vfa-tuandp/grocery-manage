@extends('layouts.app')

@section('page_level_styles')
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
@endsection

@section('page_content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box blue-madison">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>Responsive Table With Expandable details
            </div>
            <div class="tools">
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_3">
                <thead>
                <tr>
                    <th>
                        Loại hàng
                    </th>
                    <th>
                        Mặt hàng
                    </th>
                    <th>
                        Đvt
                    </th>
                    <th>
                        Giá nhập
                    </th>
                    <th>
                        Giá bán
                    </th>
                    <th>
                        Tồn kho
                    </th>
                    <th>
                        Sửa
                    </th>
                    <th>
                        Xóa
                    </th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection

@section('page_level_plugins')
    <script type="text/javascript" src="{{ asset('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
@endsection

@section('my_scripts')
    <script>
        jQuery(document).ready(function() {
            TableAdvanced.init();
        });
    </script>
@endsection