@extends('admin.layouts.app')

@section('css')
<!-- SweetAlert2 -->
<!-- <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> -->
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý công thức</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý công thức</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Expandable Table</h3>
                        </div>
                        <!-- ./card-header -->
                        <style>
                            .expandable-body {
                                background-color: #e6f5ff;
                            }
                        </style>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" style="border-radius: 4px;">
                                <thead>
                                    <tr style="background-color: #4db8ff;">
                                        <th>STT</th>
                                        <th>Công thức</th>
                                        <th>Loại</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody style="background-color: #80ccff;">
                                    @foreach($formula as $key => $item)
                                    @php
                                    $id = $item->id_formula;
                                    $structure = DB::table('structures')
                                        ->join('formula_structures', 'structures.id_structure', '=', 'formula_structures.id_structure')
                                        ->join('sizes', 'structures.id_size', '=', 'sizes.id_size')
                                        ->join('units', 'structures.id_unit', '=', 'units.id_unit')
                                        ->select('structures.name as name', 'structures.capacity as capacity', 'sizes.name as size', 'units.name as unit')
                                        ->where('formula_structures.id_formula', '=', $id)
                                        ->get();
                                    @endphp
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>
                                            <a type="button" class="btn btn-sm btn-warning" href="{{ route('admin.edit-formula', $item->id_formula) }}"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="alert('ok');"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="expandable-body">
                                        <td colspan="4">
                                            <p>
                                                @foreach($structure as $index => $value)
                                                <span>{{ $key+1 }}.{{ $index+1 }}, <b>{{ $value->name }} - </b>{{ $value->capacity }} {{ $value->unit }} ({{ $value->size }})</span><br>
                                                @endforeach
                                            </p>
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
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endsection