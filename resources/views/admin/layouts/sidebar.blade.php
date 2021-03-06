<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminTET</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('images/system/user1.png')}}" class="img-circle elevation-2" alt="User Image">
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
            $product = in_array($url, array('manage-product'));
            $formula = in_array($url, array('add-formula', 'manage-formula'));
            $bill = in_array($url, array('online', 'at-table', 'at-counter'));
            $table = in_array($url, array('manage-table'));
            $store = in_array($url, array('store', 'import', 'coupon'));
            $shop = in_array($url, array('revenue', 'expense', 'branch'));
            $sys = in_array($url, array('user', 'role', 'log'));
            $cat = in_array($url, array('category', 'unit'));
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
                            B???n tin
                            <!-- {{Str::limit(app('request')->route()->uri(), 5, '')}} -->
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                @can('pro.view')
                <li class="nav-item {{ $product?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $product?'active':'' }} ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            S???n ph???m
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="{{ route('admin.add-product') }}" class="nav-link {{ $url=='add-product'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Th??m m???i</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{ route('admin.manage-product') }}" class="nav-link {{ $url=='manage-product'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Qu???n l?? s???n ph???m</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('for.view')
                <li class="nav-item {{ $formula?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $formula?'active':'' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            C??ng th???c
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.add-formula') }}" class="nav-link {{ $url=='add-formula'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Th??m m???i</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.manage-formula') }}" class="nav-link {{ $url=='manage-formula'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Qu???n l?? c??ng th???c</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('bil.view')
                <li class="nav-item {{ $bill?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $bill?'active':'' }}">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Ho?? ????n
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.online') }}" class="nav-link {{ $url=='online'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>????n online</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.at-table') }}" class="nav-link {{ $url=='at-table'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>T???i b??n</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.at-counter') }}" class="nav-link {{ $url=='at-counter'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>T???i qu???y</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('tab.view')
                <li class="nav-item {{ $table?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $table?'active':'' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            B??n ?????t
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.table') }}" class="nav-link {{ $url=='manage-table'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Qu???n l?? c??c b??n</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('sto.view')
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
                                <p>Qu???n l?? kho</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.import') }}" class="nav-link {{ $url=='import'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nh???p kho</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.coupon') }}" class="nav-link {{ $url=='coupon'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Phi???u nh???p</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('sho.view')
                <li class="nav-item {{ $shop?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $shop?'active':'' }}">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            C???a h??ng
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
                                <p>Chi ph??</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.branch') }}" class="nav-link {{ $url=='branch'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Chi nh??nh</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('cus.view')
                <li class="nav-item">
                    <a href="{{ route('admin.customer') }}" class="nav-link {{ $url=='customer'?'active':'' }}">
                        <i class="far fa-user nav-icon"></i>
                        <p>Kh??ch h??ng</p>
                    </a>
                </li>
                @endcan
                <li class="nav-item {{ $cat?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $cat?'active':'' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Danh m???c
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category') }}" class="nav-link {{ $url=='category'?'active':'' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lo???i - K??ch th?????c</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.unit') }}" class="nav-link {{ $url=='unit'?'active':'' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>????n v??? t??nh</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @can('acc.view')
                <li class="nav-item {{ $sys?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $sys?'active':'' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            H??? th???ng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user') }}" class="nav-link {{ $url=='user'?'active':'' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ng?????i d??ng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.role') }}" class="nav-link {{ $url=='role'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ch???c v???</p>
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
                @endcan
                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Th??ng tin t??i kho???n</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
