@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm công thức</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Thêm công thức</li>
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
                            <h3 class="card-title">Thêm <small>công thức</small></h3>
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
                                <div style="text-align: right;">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tạo công thức</button>
                                </div>
                                <div class="form-group">
                                    <label for="">Nhập tên công thức</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Tên công thức sản phẩm" required>
                                </div>
                                <label for="">Nhập các thành phẩm<span class="text-danger" id="match-password" style="font-style: italic;"></span></label>
                                @for($i = 1; $i <= 20; $i++)
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="name[]" class="form-control" placeholder="Tên thành phẩm {{$i}}">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="capacity[]" class="form-control" placeholder="Dung tích {{$i}}">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="id_unit[]" class="form-control" placeholder="ĐVT {{$i}}">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="id_size[]" class="form-control" placeholder="Loại {{$i}}">
                                        </div>
                                    </div>
                                </div>    
                                @endfor
                            </form>
                        </div>
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

</script>
@endsection