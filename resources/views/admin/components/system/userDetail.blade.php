@extends('admin.layouts.app')

@section('css')
    @include('admin.layouts.css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Người dùng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Người dùng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin <small>Người dùng</small></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            @if(session()->has('success'))
                            <div id="alert-success">
                                <div class="alert alert-success"
                                    style="text-align: center; font-size: 20px; font-weight: bold;">
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                            <script>
                                function timedOut() {
                                    document.getElementById("alert-success").innerHTML = "";
                                }
                                // set a timer
                                setTimeout(timedOut, 3000);
                            </script>
                            @endif
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <label style="color:rgb(42, 42, 248);"><i>Tuỳ chỉnh chức vụ</i></label>
                                    <form action="{{ route('admin.role-user', $user->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    @php
                                                        $role_name = 'Chưa phân quyền';
                                                        $roles = DB::table('roles')->get();
                                                        if($role) {
                                                            $role_name = $role->name;
                                                            $roles = DB::table('roles')->whereNotIn('name', [$role_name])->get();
                                                        }
                                                    @endphp
                                                    <select class="form-control select2bs4" style="width: 100%;" name="role_user">
                                                        <option selected="selected">{{ $role_name }}</option>
                                                        @foreach($roles as $item)
                                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-success" type="submit">Lưu chức vụ</button>
                                            </div>
                                        </div>
                                    </form>
                                    <label style="color:rgb(42, 42, 248);"><i>Thông tin người dùng</i></label>
                                    <ul class="list-group list-group-unbordered mb-12">
                                        <li class="list-group-item">
                                            <b>Tên đăng nhập</b> <a class="float-right"><b>{{ $user->username }}</b></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Họ và tên</b> <a class="float-right"><b>{{ $user->name }}</b></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="float-right"><b>{{ $user->email }}</b></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Địa chỉ</b> <a class="float-right"><b>{{ $user->address }}</b></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Số điện thoại</b> <a class="float-right"><b>{{ $user->phone }}</b></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Giới tính</b> <a class="float-right"><b>@if($user->gender == 1){{ 'Nam' }}@else{{ 'Nữ' }}@endif</b></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('script')
@include('admin.layouts.script')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection
