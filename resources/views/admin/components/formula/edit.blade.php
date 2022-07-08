@extends('admin.layouts.app')

@section('css')
@include('admin.layouts.css')
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
                    <h1>Sửa công thức</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.manage-formula') }}">Quản lý công thức</a></li>
                        <li class="breadcrumb-item active">Sửa công thức</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="text-center" style="margin-bottom: 10px;">
        <a href="{{ route('admin.manage-formula') }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-list"></i> Danh sách công thức</a>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sửa <small>công thức</small></h3>
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
                            <form action="{{ route('admin.update-formula', $formula->id_formula) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div style="text-align: right;">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                                </div>
                                <div class="form-group">
                                    <label for="">Tên công thức</label>
                                    @php
                                    $category = DB::table('categories')->get();
                                    $size = DB::table('sizes')->get();
                                    $unit = DB::table('units')->get();
                                    $id = $formula->id_formula;
                                    $structure = DB::table('structures')
                                    ->join('formula_structures', 'structures.id_structure', '=', 'formula_structures.id_structure')
                                    ->select('structures.*')
                                    ->where('formula_structures.id_formula', '=', $id)
                                    ->get();
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input type="text" name="nameFormula" class="form-control" id="nameFormula" placeholder="Tên công thức sản phẩm" value="{{ $formula->name }}" required>
                                        </div>
                                        <div class="col-md-3" style="text-align: center;">
                                            <select class="form-control select2bs4" style="width: 100%;" name="id_category">
                                                <option value="">--Loại--</option>
                                                @foreach($category as $item)
                                                <option value="{{ $item->id_category }}" @if($item->id_category == $formula->id_category) selected="selected" @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <label for="">Nhập các thành phẩm<span class="text-danger" style="font-style: italic;"></span></label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control select2bs4" style="width: 100%;" name="id_size">
                                                <option value="">--Size--</option>
                                                @foreach($size as $item)
                                                <option value="{{ $item->id_size }}" @if($item->id_size == $structure[0]->id_size) selected="selected" @endif>{{ $item->name }} - {{
                                                    $item->capacity
                                                    }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="list-structure">
                                    @php
                                    $rowStructure = count($structure);
                                    @endphp
                                    @foreach($structure as $key => $item)
                                    <div class="form-group">
                                        <div class="structure-row row">
                                            <div class="col-md-1 text-center">
                                                <button class="btn-remove-structure btn btn-secondary" type="button" value="{{ $item->id_structure }}" title="Xóa"><i class="fas fa-times"></i></button>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="id_structure[]" class="form-control" placeholder="Tên thành phẩm {{$key+1}}" value="{{ $item->id_structure }}" hidden>
                                                <input type="text" name="name[]" class="form-control" placeholder="Tên thành phẩm {{$key+1}}" value="{{ $item->name }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="capacity[]" class="form-control" placeholder="Dung tích {{$key+1}}" value="{{ $item->capacity }}">
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control select2bs4" style="width: 100%;" name="id_unit[]">
                                                    <option value="">--ĐVT {{$key+1}}--</option>
                                                    @foreach($unit as $value)
                                                    <option value="{{ $value->id_unit }}" @if($value->id_unit == $item->id_unit) selected="selected" @endif>{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div style="text-align: center;">
                                    <button type="button" id="btn-add-structure" class="btn btn-secondary"><i class="fas fa-plus-circle"></i> Thêm dòng</button>
                                </div>
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
@include('admin.layouts.script')
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
        var num = <?= json_encode($rowStructure) ?>;
        $('#btn-add-structure').on('click', function() {
            num += 1;
            $('#list-structure').append(
                '<div class="form-group"><div class="row">\
                <div class="col-md-1"></div>\
                <div class="col-md-5">\
                    <input type="text" name="name[]" class="form-control" placeholder="Tên thành phẩm ' + num + '">\
                </div>\
                <div class="col-md-3">\
                    <input type="number" name="capacity[]" class="form-control" placeholder="Dung tích ' + num + '">\
                </div>\
                <div class="col-md-3">\
                    <select class="form-control select2bs4" style="width: 100%;" name="id_unit[]">\
                        <option>--ĐVT ' + num + '--</option>\
                        @foreach($unit as $item)\
                        <option value="{{ $item->id_unit }}">{{ $item->name }}</option>\
                        @endforeach\
                    </select>\
                </div></div></div>'
            );
        })

        $('.btn-remove-structure').on('click', function(e) {
            e.preventDefault();
            var id = $(this).val();
            $(this).parent().parent().hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/admin/remove-structure/' + id,
                success: function(res) {
                    Toast.fire({
                        icon: res.status,
                        title: res.message,
                    });
                },
                error: function(error) {
                    Toast.fire({
                        icon: 'error',
                        title: 'ERROR!',
                    });
                }
            })
        })
    })
</script>
@endsection