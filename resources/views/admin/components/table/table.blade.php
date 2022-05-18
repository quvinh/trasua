@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bàn đặt</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Bàn đặt</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="pt-2 px-3"><h3 class="card-title"><i class="fas fa-table"></i></h3></li>
                    <li class="nav-item">
                      <a class="nav-link active" id="tab-table" data-toggle="pill" href="#tab-table1" role="tab" aria-controls="tab-table1" aria-selected="true">Bàn đặt</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="tab-table-config" data-toggle="pill" href="#tab-table2" role="tab" aria-controls="tab-table2" aria-selected="false">Thiết lập</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade show active" id="tab-table1" role="tabpanel" aria-labelledby="tab-table">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <a class="small-box bg-light">
                                    <div class="inner">
                                        <h3>Bàn 1</h3>
                                        <p>Số chỗ</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-table">1</i>
                                    </div>
                                    <div class="small-box-footer" style="color:black;">Trống <i class="fas fa-arrow-circle-right"></i></div>
                                </a>
                            </div>
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
                                <label>(*) Thêm bàn</label>
                                <ul id="error-store"></ul>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Nhập tên bàn">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="number" min="0" max="20" name="amount" class="form-control" id="amount"
                                                placeholder="Số chỗ">
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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-danger">Bạn muốn xoá sản phẩm '<span id="del-name-table" style="font-weight:bold;"></span>' chứ ?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- <div class="modal-body">
            </div> -->
            <input type="hidden" id="del-id-table">
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
              <button type="button" class="confirm-delete-table btn btn-primary">Xoá</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">SP</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <label>Bàn</label>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <input type="text" name="edit-name-table" class="form-control" id="edit-name-table"
                                placeholder="Tên bàn">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label>Số chỗ</label>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <input type="number" min="1" name="edit-amount-table" class="form-control" id="edit-amount-table"
                                placeholder="Số chỗ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
    @include('admin.layouts.scriptDataTable')
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        // $(function() {
        //     $("#table2").DataTable({
        //         "responsive": true, "lengthChange": false, "autoWidth": false,
        //         "buttons": ["colvis"]
        //     }).buttons().container().appendTo('#table2_wrapper .col-md-6:eq(0)');
        // })

        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            fetchData();
            function fetchData() {
                $.ajax({
                    type: 'GET',
                    url: '/admin/get-table',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function(res) {
                        $("#table2").DataTable().destroy();
                        $('tbody').html("");
                        $.each(res.table, function(index, item) {
                            $('tbody').append(
                                '<tr>\
                                    <td>'+parseInt(index+1)+'</td>\
                                    <td>'+item.id_table+'</td>\
                                    <td><a type="button" class="edit-table"><i>'+item.name+'</i></a></td>\
                                    <td>'+item.amount+'</td>\
                                    <td>\
                                        <button type="button" class="edit-table btn btn-warning btn-sm" value="'+item.id_table+'"><i class="fas fa-edit"></i> Xem</button>\
                                        <button type="button" class="delete-table btn btn-danger btn-sm" value="'+item.id_table+'|`|'+item.name+'"><i class="fas fa-trash"></i> Xoá</button>\
                                    </td>\
                                </tr>'
                            )
                        });

                        $("#table2").DataTable({
                            "responsive": true, "lengthChange": false, "autoWidth": false,
                            "buttons": ["colvis"]
                        }).buttons().container().appendTo('#table2_wrapper .col-md-6:eq(0)');
                    }
                })
            }
            $('#button-store').on('click', function(event) {
                event.preventDefault();

                var data = {
                    name: $('input[name=name]').val(),
                    amount: $('input[name=amount]').val(),
                }

                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.store-table") }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    dataType: 'json',
                    success: function(res) {
                        if(res.status == 400) {
                            $('#error-store').empty();
                            $('#error-store').html();
                            $('#error-store').addClass('alert alert-danger');
                            $.each(res.errors, function(key, err) {
                                $('#error-store').append('<li>'+err+'</li>');
                            })
                            setTimeout( function(){
                                $('#error-store').empty();
                                $('#error-store').removeClass('alert alert-danger');
                            } , 3000 );
                        } else {
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            })
                            $('#name').val('');
                            $('#amount').val('');
                            $("#table2").DataTable().destroy();
                            fetchData();
                        }
                    }
                })
            });
            $(document).on('click', '.delete-table', function(event) {
                event.preventDefault();
                var val = ($(this).val()).split('|`|');
                $('#del-id-table').val(val[0]);
                $('#del-name-table').text(val[1]);
                $('#modal-default').modal('show');
            });

            $(document).on('click', '.confirm-delete-table', function(event) {
                event.preventDefault();
                var id_table = $('#del-id-table').val();
                $.ajax({
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/admin/delete-table/'+id_table,
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

            $(document).on('click', '.edit-table', function(event) {
                event.preventDefault();

                $('#modal-lg').modal('show');
            })
        });
    </script>
@endsection
