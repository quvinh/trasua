@extends('admin.layouts.app')

@section('css')
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

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
                            setTimeout(timedOut, 3000);
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
                                        <th>Ảnh</th>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Hiển thị</th>
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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-danger">Bạn muốn xoá sản phẩm '<span id="del-name-product" style="font-weight:bold;"></span>' chứ ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <div class="modal-body">
            </div> -->
                <input type="hidden" id="del-id-product">
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="confirm-delete-product btn btn-primary">Xoá</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @php
        $category = DB::table('categories')->get();
        $size = DB::table('sizes')->get();
        $unit = DB::table('units')->get();
    @endphp
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tuỳ chỉnh sản phẩm: <span class="badge badge-primary">id = <span id="title-product"></span></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Ảnh</label>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Sản phẩm</span>
                                            </div>
                                            <input type="text" class="form-control float-right" name="edit-name-product" id="edit-name-product" placeholder="Tên sản phẩm">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control select2bs4" style="width: 100%;" name="unit">
                                            <option>--ĐVT--</option>
                                            @foreach($unit as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control select2bs4" style="width: 100%;" name="id_category">
                                            <option>--Loại--</option>
                                            @foreach($category as $item)
                                                <option value="{{ $item->id_category }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control select2bs4" style="width: 100%;" name="id_category">
                                            <option>--Kích thước--</option>
                                            @foreach($size as $item)
                                                <option value="{{ $item->id_size }}">{{ $item->name }} - {{ $item->capacity }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Giá thực</span>
                                            </div>
                                            <input type="text" class="form-control float-right" name="edit-price-product" id="edit-price-product" placeholder="Tên sản phẩm">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Giá km</span>
                                            </div>
                                            <input type="text" class="form-control float-right" name="edit-promotional-product" id="edit-promotional-product" placeholder="Khuyến mãi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Ghi chú</span>
                                            </div>
                                            <textarea type="text" class="form-control float-right" cols="2" rows="2" name="edit-description-product" id="edit-description-product" placeholder="Ghi chus"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="update-product btn btn-primary" value="">Lưu thay đổi</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
@include('admin.layouts.scriptDataTable')
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(function() {
        $("#tableProduct").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tableProduct_wrapper .col-md-6:eq(0)');
    })
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
                url: 'get-product',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(res) {
                    $('#tableProduct').DataTable().destroy();
                    $('tbody').html('');
                    $.each(res.product, function(index, item) {
                        var check = item.visible == 1 ? 'checked' : '';
                        var img = 'system/No_image_available.png';
                        if (item.image != '') img = 'product/' + item.image;
                        $('tbody').append(
                            '<tr>\
                                    <td>' + parseInt(index + 1) + '</td>\
                                    <td>' + item.id_product + '</td>\
                                    <td><img src="/images/' + img + '" alt="IMAGE" width="32"></td>\
                                    <td><a type="button" class="edit-product" value="' + item.id_product + '"><i>' + item.name + '</i></a></td>\
                                    <td>' + (item.price).toLocaleString() + '</td>\
                                    <td>\
                                        <div class="custom-control custom-switch custom-switch-off-secondary custom-switch-on-success">\
                                            <input type="checkbox" class="custom-control-input" id="customSwitch' + item.id_product + '" ' + check + ' value="' + item.id_product + '">\
                                            <label class="custom-control-label" for="customSwitch' + item.id_product + '"></label>\
                                        </div>\
                                    </td>\
                                    <td>\
                                        <button type="button" class="edit-product btn btn-warning btn-sm" value="' + item.id_product + '"><i class="fas fa-edit"></i> Xem</button>\
                                        <button type="button" class="delete-product btn btn-danger btn-sm" value="' + item.id_product + '|`|' + item.name + '"><i class="fas fa-trash"></i> Xoá</button>\
                                    </td>\
                                </tr>'
                        )
                    })
                }
            })
        }

        $(document).on('change', '.custom-control-input', function(event) {
            event.preventDefault();
            var check = $(this).is(':checked');
            var id_product = $(this).val();
            var data = {
                visible: check ? 1 : 0
            }
            $.ajax({
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'update-visible/' + id_product,
                dataType: 'json',
                data: data,
                success: function(res) {
                    Toast.fire({
                        icon: res.status,
                        title: res.message,
                    });
                    fetchData();
                },
                error: function(error) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Lỗi hệ thống!',
                    });
                }
            });
        });
        $(document).on('click', '.delete-product', function(event) {
            event.preventDefault();
            var val = ($(this).val()).split('|`|');
            $('#del-id-product').val(val[0]);
            $('#del-name-product').text(val[1]);
            $('#modal-default').modal('show');
        });
        $(document).on('click', '.confirm-delete-product', function(event) {
            event.preventDefault();
            var id_product = $('#del-id-product').val();
            $.ajax({
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/admin/delete-product/' + id_product,
                dataType: 'json',
                success: function(res) {
                    Toast.fire({
                        icon: res.status,
                        title: res.message
                    });
                    $('#modal-default').modal('hide');
                    fetchData();
                }
            })
        });
        $(document).on('click', '.edit-product', function(event) {
            event.preventDefault();
            var id_product = $(this).attr('value');
            $.ajax({
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/admin/edit-product/' + id_product,
                dataType: 'json',
                success: function(res) {
                    $('#title-product').text(res.product.id_product);
                    $('#edit-name-product').val(res.product.name);
                    $('#edit-amount-product').val(res.product.amount);
                    $('.update-product').attr('value', res.product.id_product);
                    $('#modal-lg').modal('show');
                },
                error: function(error) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Lỗi hệ thống!',
                    });
                }
            })
        })
    })
</script>
@endsection