@extends('layouts.app')

@section('page_level_styles')
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css"
          href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
@endsection

@section('page_content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light bordered">
        @if (Session::has('success'))
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>
                    {{ Session::get('success') }}
                </strong>
            </div>
        @endif
        <div class="portlet-title">
            <div class="caption font-red-sunglo">
                <i class="icon-settings font-red-sunglo"></i>
                <span class="caption-subject bold uppercase"> Cập nhật sản phẩm</span>
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
            <form role="form" action="{{ route('item.update', ['id' => $item->id]) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input has-info">
                                <select class="form-control" id="category" name="category_id">
                                    @foreach ($categories as $category)
                                        @if ($category->id == $item->category_id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="category">Loại hàng</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="product_name" name="name"
                                       placeholder="Nhập vào tên sản phẩm" value="{{ $item->name }}">
                                <label for="product_name">Mặt hàng</label>
                                <span class="help-block">Nhập tên sản phẩm</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="unit" name="unit"
                                       placeholder="Đvt" value="{{ $item->unit }}">
                                <label for=unit>Đơn vị tính</label>
                                <span class="help-block">Đơn vị tính của sản phẩm</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group form-md-line-input">
                                <input type="number" class="form-control" id="price_in_hint" name="price_in_hint"
                                       placeholder="Giá nhập hàng" value="{{ $item->price_in_hint }}">
                                <label for="price_in_hint">Giá nhập vào</label>
                                <span class="help-block">Có thể bỏ qua</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group form-md-line-input">
                                <input type="number" class="form-control" id="price_out_hint" name="price_out_hint"
                                       placeholder="Giá bán ra" value="{{ $item->price_out_hint }}">
                                <label for="price_out_hint">Giá bán ra</label>
                                <span class="help-block">Có thể bỏ qua</span>
                            </div>
                        </div>
                        {{--<div class="col-md-2">--}}

                            {{--<div class="form-group form-md-line-input">--}}
                                {{--<input type="number" class="form-control" id="in_stock" name="in_stock"--}}
                                       {{--placeholder="SL tồn kho"--}}
                                       {{--@if($item->check_in_stock) value="{{ $item->in_stock }}" @endif>--}}
                                {{--<label for="in_stock">Tồn kho</label>--}}
                                {{--<span class="help-block">SL tồn kho</span>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                        <div class="col-md-2">
                            <div class="md-checkbox md-checkbox-inline">
                                <input type="checkbox" id="check_in_stock" name="check_in_stock" class="md-check"
                                       @if ($item->check_in_stock) checked disabled @endif>
                                <label for="check_in_stock">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Tính tồn kho?</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn blue">Cập nhật</button>
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
@endsection

@section('my_scripts')
    <script>
        jQuery(document).ready(function () {
            showHideInStockField();
            $('#check_in_stock').click(function () {
                showHideInStockField();
            });
        });
        function showHideInStockField() {
            if ($('#check_in_stock').is(":checked")) {
                $('#in_stock').parent('div').slideDown(300);
            } else {
                $('#in_stock').parent('div').slideUp(300);
            }
        }
    </script>
@endsection