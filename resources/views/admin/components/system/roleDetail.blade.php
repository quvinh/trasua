@extends('admin.layouts.app')

@section('css')
@include('admin.layouts.css')
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết chức vụ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/role') }}">Chức vụ</a></li>
                        <li class="breadcrumb-item active">Chi tiết chức vụ</li>
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
                            <h3 class="card-title">Chi tiết <small>Chức vụ</small></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div>
                                <ul class="list-group list-group-unbordered mb-12">
                                    <li class="list-group-item">
                                        <b>Mã chức vụ</b> <a class="float-right"><b>{{ $role->id }}</b></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tên chức vụ</b> <a class="float-right"><b style="font-size: 20px;">{{ $role->name }}</b></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Số quyền hạn</b> <a class="float-right"><b style="font-size: 20px;"><span id="permission-count">{{ $permission->count() }}</span></b></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Quyền hạn <small>Chức vụ</small></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-success btn-sm" id="save-confirm" data-toggle="modal" data-target="#modal-default"><i class="fas fa-save"></i> Lưu quyền</button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Quyền hạn</th>
                                        <th style="width: 10%; text-align:center;">All</th>
                                        <th style="width: 10%; text-align:center;"><i class="fas fa-eye"></i> Xem</th>
                                        <th style="width: 10%; text-align:center;"><i class="fas fa-plus-circle"></i> Thêm</th>
                                        <th style="width: 10%; text-align:center;"><i class="fas fa-edit"></i> Sửa</th>
                                        <th style="width: 10%; text-align:center;"><i class="fas fa-trash"></i> Xoá</th>
                                        <th style="width: 10%; text-align:center;"><i class="fas fa-chevron-circle-down"></i> Duyệt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($group as $key => $item)
                                        <tr>
                                            <td><i style="color:rgb(0, 85, 141);"><b>{{ $item }}</b></i></td>
                                            <td style="text-align:center;">
                                                <div class="icheck-warning d-inline">
                                                    <input type="checkbox" id="{{ $key }}">
                                                    <label for="{{ $key }}"></label>
                                                </div>
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="icheck-primary d-inline" id="{{ $key.'_check' }}">
                                                    <input type="checkbox" id="{{ $key.'.view' }}"  name="{{ $key.'[]' }}" {{ in_array($key.'.view', $permission->pluck('name')->toArray()) ? 'checked' : '' }}>
                                                    <label for="{{ $key.'.view' }}"></label>
                                                </div>
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="icheck-primary d-inline" id="{{ $key.'_check' }}">
                                                    <input type="checkbox" id="{{ $key.'.add' }}" name="{{ $key.'[]' }}" {{ in_array($key.'.add', $permission->pluck('name')->toArray()) ? 'checked' : '' }}>
                                                    <label for="{{ $key.'.add' }}"></label>
                                                </div>
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="icheck-primary d-inline" id="{{ $key.'_check' }}">
                                                    <input type="checkbox" id="{{ $key.'.edit' }}" name="{{ $key.'[]' }}" {{ in_array($key.'.edit', $permission->pluck('name')->toArray()) ? 'checked' : '' }}>
                                                    <label for="{{ $key.'.edit' }}"></label>
                                                </div>
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="icheck-primary d-inline" id="{{ $key.'_check' }}">
                                                    <input type="checkbox" id="{{ $key.'.delete' }}" name="{{ $key.'[]' }}" {{ in_array($key.'.delete', $permission->pluck('name')->toArray()) ? 'checked' : '' }}>
                                                    <label for="{{ $key.'.delete' }}"></label>
                                                </div>
                                            </td>
                                            <td style="text-align:center;">
                                                <div class="icheck-primary d-inline" id="{{ $key.'_check' }}">
                                                    <input type="checkbox" id="{{ $key.'.confirm' }}" name="{{ $key.'[]' }}" {{ in_array($key.'.confirm', $permission->pluck('name')->toArray()) ? 'checked' : '' }}>
                                                    <label for="{{ $key.'.confirm' }}"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Lưu quyền cho chức vụ <i>{{ $role->name }}</i></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form>
            <div class="modal-body">
                <ul class="list-group list-group-unbordered mb-12">
                    <li class="list-group-item">
                        <b>Mã chức vụ</b> <a class="float-right"><b>{{ $role->id }}</b></a>
                    </li>
                    <li class="list-group-item">
                        <b>Tên chức vụ</b> <a class="float-right"><b style="font-size: 20px;">{{ $role->name }}</b></a>
                    </li>
                    <li class="list-group-item">
                        <b>Số quyền hạn</b> <a class="float-right"><b style="font-size: 20px;"><span id="permission-count-final"></span></b></a>
                    </li>
                </ul>
                <input type="text" id="save-value" name="permission" readonly required hidden>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                <button type="button" id="save-permission" class="btn btn-success" data-dismiss="modal"><i class="fas fa-save"></i> Lưu quyền</button>
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('script')
    @include('admin.layouts.script')
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        const array = ['pro', 'bil', 'cus', 'for', 'sto', 'sho', 'acc', 'tab'];

        $(document).ready(function() {
            function currentPermission() {
                const arrayPermission = [];
                array.forEach(item => {
                    const checkbox = document.getElementsByName(item + '[]');
                    for(var i=0; i<checkbox.length; i++) {
                        checkbox[i].checked && arrayPermission.push(checkbox[i].getAttributeNode('id').value);
                    }
                })
                document.getElementById('permission-count').textContent = arrayPermission.length;
                document.getElementById('permission-count-final').textContent = arrayPermission.length;
                return arrayPermission;
            }

            array.forEach(element => {
                if($('#' + element + '_check > input:checked').length == $('#pro_check > input').length) {
                    $('#' + element).prop('checked',true);
                }

                $('#' + element).on('click', function() {
                    if(this.checked) {
                        $('#' + element + '_check > input').each(function() {
                            this.checked = true;
                        })
                    } else {
                        $('#' + element + '_check > input').each(function() {
                            this.checked = false;
                        })
                    }
                    currentPermission();
                })

                $('#' + element + '_check > input').on('click', function(){
                    if($('#' + element + '_check > input:checked').length == $('#' + element + '_check > input').length){
                        $('#' + element).prop('checked',true);
                    }else{
                        $('#' + element).prop('checked',false);
                    }
                    currentPermission();
                });
            });

            $('#save-confirm').on('click', function() {
                $("#modal-default").modal({backdrop: "static"});
                $("#save-value").val(currentPermission());
            })
        });

        $("#save-permission").click(function(event) {
            event.preventDefault();
            let permission = $("input[name=permission]").val();
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $.ajax({
                url: "{{ route('admin.update-role', $role->id) }}",
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    permission: permission,
                },
                success: function(res) {
                    if(res) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Lưu cập nhật thành công'
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Lưu cập nhật thất bại'
                        })
                    }
                },
                error: function(error) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Lưu cập nhật thất bại'
                    })
                }
            })
        })
    </script>
@endsection
