@extends('admin.layouts.app')

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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm <small>người dùng</small></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <form id="quickForm" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tên đăng nhập</label>
                                            <input type="text" name="username" class="form-control" id=""
                                                placeholder="Tên đăng nhập">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mật khẩu</label>
                                            <input type="password" name="password" class="form-control" id=""
                                                placeholder="Mật khẩu">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" id=""
                                                placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="">SĐT</label>
                                            <input type="text" name="phone" class="form-control" id=""
                                                placeholder="Số điện thoại">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Họ và tên</label>
                                            <input type="text" name="name" class="form-control" id=""
                                                placeholder="Họ và tên">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Địa chỉ</label>
                                            <input type="text" name="address" class="form-control" id=""
                                                placeholder="Địa chỉ">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Chọn ảnh</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="">
                                                    <label class="custom-file-label" for="">Chọn
                                                        ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Giới tính</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">STT</th>
                                        <th>ID</th>
                                        <th>Họ và tên</th>
                                        <th>Tên đăng nhập</th>
                                        <th>SĐT</th>
                                        <th>Chức vụ</th>
                                        <th style="max-width: fit-content;">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->phone==''?'Chưa cập nhật':$item->phone }}</td>
                                            <td><span class="badge badge-primary">Label</span></td>
                                            <td>
                                                <button class="btn btn-success btn-sm"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 10%;">STT</th>
                                        <th>ID</th>
                                        <th>Họ và tên</th>
                                        <th>Tên đăng nhập</th>
                                        <th>SĐT</th>
                                        <th>Chức vụ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
