@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đơn vị tính</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Đơn vị tính</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
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
                    <!-- jquery validation -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Đơn vị tính</small></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <form action="{{ route('admin.add-unit') }}" method="post">
                                @csrf
                                <label for="" style="color:blue"><i>Thêm đơn vị tính</i></label>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Nhập đơn vị tính" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-success" type="submit"><i class="fas fa-plus-circle"></i></button>
                                    </div>
                                </div>
                            </form>
                            <label for="" style="color:blue"><i>Danh sách</i></label>
                            <table id="tableUnit" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">STT</th>
                                        <th>ID</th>
                                        <th style="width: 60%;">Đơn vị tính</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($unit as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ str_pad($item->id_unit, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td><b style="color:rgb(6, 6, 119);">{{ $item->name }}</b></td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                                    Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 5px;">STT</th>
                                        <th>ID</th>
                                        <th style="width: 60%;">Đơn vị tính</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-2"></div>
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
    <script>
        $(function() {
            $('#tableUnit').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
    </script>
@endsection
