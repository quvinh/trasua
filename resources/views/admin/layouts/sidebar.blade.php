<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        @php
            $url = substr(app('request')->route()->uri(), 6);
            $product = in_array($url, array('add-product', 'manage-product'));
            $formula = in_array($url, array('add-formula', 'manage-formula'));
            $bill = in_array($url, array('online', 'at-table', 'at-counter'));
            $table = in_array($url, array('manage-table'));
            $store = in_array($url, array('store', 'import', 'coupon'));
            $shop = in_array($url, array('revenue', 'expense'));
            $sys = in_array($url, array('user', 'role', 'log'));
        @endphp
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
            <!-- <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> -->
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item menu-open">
                    <a href="{{ url('/admin') }}" class="nav-link {{ $url==''?'active':'' }} ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Bản tin
                            <!-- {{Str::limit(app('request')->route()->uri(), 5, '')}} -->
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ $product?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $product?'active':'' }} ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Sản phẩm
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.add-product') }}" class="nav-link {{ $url=='add-product'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.manage-product') }}" class="nav-link {{ $url=='manage-product'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ $formula?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $formula?'active':'' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Công thức
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.add-formula') }}" class="nav-link {{ $url=='add-formula'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.manage-formula') }}" class="nav-link {{ $url=='manage-formula'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý công thức</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ $bill?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $bill?'active':'' }}">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Hoá đơn
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.online') }}" class="nav-link {{ $url=='online'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đơn online</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.at-table') }}" class="nav-link {{ $url=='at-table'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tại bàn</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.at-counter') }}" class="nav-link {{ $url=='at-counter'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tại quầy</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ $table?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $table?'active':'' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Bàn đặt
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.table') }}" class="nav-link {{ $url=='manage-table'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý các bàn</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ $store?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $store?'active':'' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Kho
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.store') }}" class="nav-link {{ $url=='store'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý kho</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.import') }}" class="nav-link {{ $url=='import'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nhập kho</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.coupon') }}" class="nav-link {{ $url=='coupon'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Phiếu nhập</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ $shop?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $shop?'active':'' }}">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Cửa hàng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.revenue') }}" class="nav-link {{ $url=='revenue'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Doanh thu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.expense') }}" class="nav-link {{ $url=='expense'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Chi phí</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.customer') }}" class="nav-link {{ $url=='customer'?'active':'' }}">
                        <i class="far fa-user nav-icon"></i>
                        <p>Khách hàng</p>
                    </a>
                </li>
                <li class="nav-item {{ $sys?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $sys?'active':'' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Hệ thống
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user') }}" class="nav-link {{ $url=='user'?'active':'' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Người dùng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.role') }}" class="nav-link {{ $url=='role'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Chức vụ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.log') }}" class="nav-link {{ $url=='log'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Logs</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Thông tin tài khoản</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
