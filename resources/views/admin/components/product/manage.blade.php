@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div style="text-align: center;">
                        <a href="{{ route('admin.add-product') }}" class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i> Thêm sản phẩm</a>
                    </div>
                    <br>
                </div>
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách <small>Sản phẩm</small></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
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
                                setTimeout( timedOut , 3000 );
                            </script>
                        @endif
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableProduct" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">STT</th>
                                        <th>ID</th>
                                        <th>Ảnh</th>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ str_pad($item->id_product, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>
                                                @if($item->image != null)
                                                    <img src="{{ asset('images/product/'.$item->image) }}" alt="IMAGE" width="32">
                                                @else
                                                <img src="{{ asset('images/system/No_image_available.png') }}" alt="IMAGE" width="32">
                                                @endif
                                            </td>
                                            <td><a href="{{ route('admin.edit-product', $item->id_product) }}"><i>{{ $item->name }}</i></a></td>
                                            <td>{{ number_format($item->price, 0, '', ','); }}</td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="{{ route('admin.edit-product', $item->id_product) }}"><i class="fas fa-eye"></i>
                                                    Xem</a>
                                                <a href="{{ route('admin.delete-product', $item->id_product) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                                    Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 5px;">STT</th>
                                        <th>ID</th>
                                        <th>Ảnh</th>
                                        <th>Tên</th>
                                        <th>Giá</th>
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
    @include('admin.layouts.scriptDataTable')
    <script>
        $(function() {
            // $('#tableProduct').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //     "responsive": true,
            // });
            $("#tableProduct").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tableProduct_wrapper .col-md-6:eq(0)');
        })
    </script>
@endsection
