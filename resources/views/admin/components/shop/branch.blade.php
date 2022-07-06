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
                            @if(session()->has('success'))
                            <div id="alert-success">
                                <div class="alert alert-success" style="text-align: center; font-size: 20px; font-weight: bold;">
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
                            <form action="{{ route('admin.add-user') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tên đăng nhập</label>
                                            <input type="text" name="username" class="form-control" id="username" placeholder="Tên đăng nhập" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mật khẩu
                                                @if($errors->has('password'))
                                                <span class="text-danger" id="error-password" style="font-style: italic;">(*) {{ $errors->first('password')
                                                    }}</span>
                                                <script>
                                                    function timedOut() {
                                                        document.getElementById("error-password").innerHTML = "";
                                                    }
                                                    setTimeout(timedOut, 5000);
                                                </script>
                                                @endif
                                            </label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Mật khẩu" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Xác nhận mật khẩu<span class="text-danger" id="match-password" style="font-style: italic;"></span></label>
                                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Xác nhận mật khẩu" required onchange="checkMatch();">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Nhập email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Họ và tên</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Họ và tên" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">SĐT</label>
                                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Số điện thoại" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Địa chỉ</label>
                                            <input type="text" name="address" class="form-control" id="address" placeholder="Địa chỉ">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Chọn ảnh</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image" id="image">
                                                    <label class="custom-file-label" for="image">Chọn
                                                        ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Giới tính</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="checkbox" name="gender" id="gender" checked data-bootstrap-switch data-off-color="success" data-on-color="primary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tạo người dùng</button>
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
                            <table id="tableUser" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">STT</th>
                                        <th>ID</th>
                                        <th>Ảnh</th>
                                        <th>Tên đăng nhập</th>
                                        <th>Chức vụ</th>
                                        <th>Họ và tên</th>
                                        <th>SĐT</th>
                                        <th>Địa chỉ</th>
                                        <th style="max-width: fit-content;">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            @if($item->image=='')
                                            <img src="{{ asset('images/system/user1.png') }}" alt="IMAGE" srcset="" width="32">
                                            @else
                                            <img src="{{ asset('images/user/'.$item->image) }}" alt="IMAGE" srcset="" width="32">
                                            @endif
                                        </td>
                                        <td><b>{{ $item->username }}</b></td>
                                        <td>
                                            @if($item->role != null)
                                            @php
                                            $role_name = DB::table('roles')->where('id', $item->role)->first()->name;
                                            @endphp
                                            <span class="badge badge-primary">{{ $role_name }}</span>
                                            @else
                                            <span class="badge badge-secondary">Chưa phân quyền</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone==''?'Chưa cập nhật':$item->phone }}</td>
                                        <td>{{ $item->address==''?'Chưa cập nhật':$item->address }}</td>
                                        <td>
                                            <!-- <button class="btn btn-success btn-sm"><i class="fas fa-eye"></i></button> -->
                                            <a class="btn btn-warning btn-sm" href="{{ route('admin.get-user', $item->id) }}"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" href="{{ route('admin.delete-user', $item->id) }}"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID</th>
                                        <th>Ảnh</th>
                                        <th>Tên đăng nhập</th>
                                        <th>Chức vụ</th>
                                        <th>Họ và tên</th>
                                        <th>SĐT</th>
                                        <th style="width: 30%;">Địa chỉ</th>
                                        <th style="max-width: fit-content;">Thao tác</th>
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

@section('script')
@include('admin.layouts.scriptDataTable')
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
        $("#tableUser").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tableUser_wrapper .col-md-6:eq(0)');
    });

    function checkMatch() {
        if (document.getElementById('password_confirmation').value !== document.getElementById('password').value) {
            document.getElementById('match-password').textContent = ' (*) Xác nhận mật khẩu không đúng';
            document.getElementById('password_confirmation').focus();
        } else {
            document.getElementById('match-password').textContent = '';
        }
    }

    $("[data-card-widget='collapse']").click();
</script>
@endsection