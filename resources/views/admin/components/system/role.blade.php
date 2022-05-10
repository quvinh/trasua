@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chức vụ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Chức vụ</li>
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
                            <h3 class="card-title">Thêm <small>Chức vụ mới</small></h3>
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
                                    <div class="alert alert-success" style="text-align: center;">
                                        <p>{{ session()->get('success') }}</p>
                                    </div>
                                </div>
                                <script>
                                    function timedOut() {
                                        document.getElementById("alert-success").innerHTML = "";
                                    }
                                    // set a timer
                                    setTimeout( timedOut , 2000 );
                                </script>
                            @endif
                            <form action="{{ route('admin.add-role') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="text" name="role" class="form-control" id="role"
                                                placeholder="Nhập chức vụ mới">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Thêm mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách <small>Chức vụ</small></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">STT</th>
                                        <th>ID</th>
                                        <th style="width: 60%;">Chức vụ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->id }}</td>
                                            <td><span class="badge badge-primary" style="font-size: 18px;">{{ $item->name }}</span></td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="{{ route('admin.get-role', $item->id) }}"><i class="fas fa-eye"></i>
                                                    Xem</a>
                                                @if($item->name != 'Administrator')
                                                    <a href="{{ route('admin.delete-role', $item->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                                        Xoá</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 5px;">STT</th>
                                        <th>ID</th>
                                        <th style="width: 60%;">Chức vụ</th>
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

@section('script')
    <script type="text/javascript">
    </script>
@endsection
