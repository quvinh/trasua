@extends('user.layouts.master')

@section('title')
Thông tin
@endsection

@section('all')
<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- breadcrumb-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li aria-current="page" class="breadcrumb-item active">Người dùng</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <!--
              *** CUSTOMER MENU ***
              _________________________________________________________
              -->
                    <div class="card sidebar-menu">
                        <div class="card-header">
                            <h3 class="h4 card-title">Người dùng</h3>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <a href="{{ route('orders-history') }}" class="nav-link @if(app('request')->route()->uri() == 'khach-hang') {{'active'}} @endif"><i class="fa fa-list"></i> Lịch sử đặt hàng</a>
                                <a href="{{ route('customer-account') }}" class="nav-link @if(app('request')->route()->uri() == 'tai-khoan') {{'active'}} @endif"><i class="fa fa-user"></i> Tài khoản</a>
                                <a href="{{ route('logout') }}" class="nav-link"><i class="fa fa-sign-out"></i> Đăng xuất</a>
                            </ul>
                            <hr>
                            <div style="text-align:center;">
                                <img src="{{ asset('images/system/tet.gif') }}" alt="GIF" width="100%">
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-3-->
                    <!-- *** CUSTOMER MENU END ***-->
                </div>
                @yield('customer-content')
            </div>
        </div>
    </div>
</div>
@endsection