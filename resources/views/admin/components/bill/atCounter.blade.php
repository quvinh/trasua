@extends('admin.layouts.app')

@section('css')
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gallery</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Gallery</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-around" style="margin-bottom:2px;">
                <h5><span class="badge badge-primary">Sản phẩm chờ: <b class="badge badge-secondary" style="font-size:16px;">10</b></span></h5>
                <h5><span class="badge badge-warning">Chưa thanh toán: <b class="badge badge-secondary" style="font-size:16px;">10</b></span></h5>
                <h5><span class="badge badge-success">Bán ra: <b class="badge badge-secondary" style="font-size:16px;">10</b></span></h5>
            </div>
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                        <li class="pt-2 px-3">
                            <h3 class="card-title"><i class="fas fa-table"></i></h3>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-table" data-toggle="pill" href="#tab-table1" role="tab" aria-controls="tab-table1" aria-selected="true">Danh sách</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-table-config" data-toggle="pill" href="#tab-table2" role="tab" aria-controls="tab-table2" aria-selected="false">
                                Thiết lập
                                <!-- <span class="badge badge-danger" style="position:absolute;">10</span> -->
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-two-tabContent">
                        <div class="tab-pane fade show active" id="tab-table1" role="tabpanel" aria-labelledby="tab-table">
                            <div id="list-product" class="row">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-table2" role="tabpanel" aria-labelledby="tab-table-config">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Danh sách <small>Sản phẩm</small></h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <label>(*) Thêm bàn</label>
                                    <ul id="error-store"></ul>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên bàn">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="number" min="0" max="20" name="amount" class="form-control" id="amount" placeholder="Số chỗ">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" id="button-store" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Thêm mới</button>
                                        </div>
                                    </div>
                                    <label>- Danh sách</label>
                                    <table id="table2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 5px;">STT</th>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Số chỗ</th>
                                                <th>Hiển thị</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 5px;">STT</th>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Số chỗ</th>
                                                <th>Hiển thị</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
@endsection

@section('script')
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        fetchData();

        function fetchData() {
            $.ajax({
                type: 'GET',
                url: '/admin/order-product',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                datatype: 'json',
                success: function(res) {
                    $('#list-product').html('');
                    $.each(res.product, function(index, item) {
                        let img = 'system/No_image_available.png';
                        if(item.image != '') img = 'product/'+item.image;
                        $('#list-product').append(
                            '<div class="col-lg-3 col-6">\
                                <div class="small-box bg-info">\
                                    <div class="inner">\
                                        <img src="/images/'+img+'" alt="Ảnh <3" width="100%" style="border-radius: 4px;">\
                                    </div>\
                                    <div style="text-align: center;">\
                                        <div class="d-flex flex-column">\
                                            <div style="font-size: 20px;">'+item.name+'</div>\
                                            <div><b>'+(item.price).toLocaleString('it-IT', {style : 'currency', currency : 'VND'})+'</b></div>\
                                        </div>\
                                    </div>\
                                    <div class="small-box-footer">\
                                        <button class="btn btn-light"><i class="fas fa-minus"></i></button>\
                                        <input type="number" class="btn btn-light" readonly style="width: 50%;">\
                                        <button class="btn btn-light"><i class="fas fa-plus"></i></button>\
                                    </div>\
                                </div>\
                            </div>'
                        );
                    });
                }
            })
        }
    })
</script>

@endsection