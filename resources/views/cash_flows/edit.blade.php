@extends('layouts.app')

@section('page_level_styles')
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
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
                <span class="caption-subject bold uppercase">Sửa thu/chi</span>
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
            <form role="form" action="{{ route('cash_flow.update', $cashFlow->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input id="cash_flow_id" type="hidden" value="{{ $cashFlow->id }}">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group form-md-line-input">
                                <div class="input-group date form_datetime">
                                    <input type="text" readonly size="16" class="form-control" name="datetime" value="{{ $cashFlow->datetime->format('d-m-Y H:i') }}">
                                    <label for="category">Ngày phát sinh</label>

                                    <span class="input-group-btn">
                                    <button class="btn default date-reset" type="button"><i
                                                class="fa fa-times"></i></button>
                                    <button class="btn default date-set" type="button"><i
                                                class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input">
                                <input type="checkbox" name="type" class="make-switch" @if($cashFlow->type) checked @endif data-on-text="Chi"
                                       data-off-text="Thu" data-on-color="danger" data-off-color="info">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="content" name="content" value="{{ $cashFlow->content }}"
                                       placeholder="Nội dung">
                                <label for=content>Nội dung</label>
                                <span class="help-block">Nội dung thu/chi</span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group form-md-line-input">
                                <input type="number" class="form-control" id="value" name="value" value="{{ $cashFlow->value }}"
                                       placeholder="Số tiền" min="500">
                                <label for="value">Số tiền</label>
                                <span class="help-block">Số tiền</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                        <textarea class="form-control" name="note" id="note"
                                                  placeholder="Ghi chú">{{ $cashFlow->note }}</textarea>
                                <span class="help-block">Ghi chú</span>
                                <label for="note"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-2">
                            <div class="form-actions noborder pull-right">
                                <button type="submit" class="btn blue">Cập nhật</button>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div id="destroy_cash" class="form-actions noborder pull-left">
                                <a onclick="destroyCash();" class="btn btn-circle btn-icon-only red">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
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
        jQuery(document).ready(function () {
            handleDatetimePicker();
        });

        function handleDatetimePicker() {
            if (!jQuery().datetimepicker) {
                return;
            }
            $(".form_datetime").datetimepicker({
                autoclose: true,
                format: "dd-mm-yyyy hh:ii",
                pickerPosition: "bottom-left",
                todayBtn: true,
                useCurrent: false
            });
            var now = new Date();
            var currentHours = now.getHours();
            var currentMins = now.getMinutes();

            if (currentHours < 10)  currentHours = '0' + currentHours;
            if (currentMins < 10)  currentMins = '0' + currentMins;

            $(".form_datetime input[type=text]").val(
                    now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear() + ' ' +
                    currentHours + ':' + currentMins
            );
        }

        function destroyCash() {
            swal({
                title: 'Xóa cái này?',
                text: "Xóa một phát là mất luôn.. ",
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
                    url:"/ajax/cash_flow/" + $("#cash_flow_id").val(),
                    type: "DELETE",
                    success:function(data) {
                        swal(
                                'Đã xóa!',
                                'Cái này đã được xóa',
                                'success'
                        ).then(function () {
                            location.href = '/cash_flow';
                        });
                    },
                    error: function(xhr,status,error) {
                        swal(
                                'Đệt, có lỗi',
                                'Lỗi cmnr!',
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
        }
    </script>
@endsection