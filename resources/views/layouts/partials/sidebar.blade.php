<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="heading">
                <h3 class="uppercase">Bảng quản lý Admin</h3>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Thống kê</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('order.index') }}">
                            Bán hàng</a>
                    </li>
                    <li>
                        <a href="{{ route('purchase.index') }}">
                            Nhập hàng</a>
                    </li>
                    <li>
                        <a href="{{ route('item.stock') }}">
                            Kho hàng</a>
                    </li>
                    <li>
                        <a href="{{ route('cash_flow.index') }}">
                            Dòng tiền</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-briefcase"></i>
                    <span class="title">Quản lý</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('category.index') }}">
                            Các loại mặt hàng</a>
                    </li>
                    <li>
                        <a href="{{ route('item.index') }}">
                            Sản phẩm</a>
                    </li>
                    <li>
                        <a href="{{ route('item.create') }}">
                            Thêm sản phẩm mới</a>
                    </li>
                </ul>
            </li>

            <li class="heading">
                <h3 class="uppercase">Tác vụ cho member</h3>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Mua/bán</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('order.create') }}">
                            <span class="badge badge-roundless badge-danger">new</span>Bán hàng</a>
                    </li>
                    <li>
                        <a href="{{ route('purchase.create') }}">
                            <span class="badge badge-roundless badge-danger">new</span>Nhập hàng</a>
                    </li>
                    <li>
                        <a href="{{ route('cash_flow.create') }}">
                            Phát sinh thu/chi</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="icon-user"></i>
                    <span class="title">Khách hàng/Nơi nhập</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('customer.index') }}">
                            Khách hàng<br>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('supplier.index') }}">
                            Nhà cung cấp<br>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>