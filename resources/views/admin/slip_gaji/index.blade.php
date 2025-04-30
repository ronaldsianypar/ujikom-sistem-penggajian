@extends('layouts.master') @section('css')
    @endsection @section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Slip Gaji</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.slip_gaji.index') }}">Slip Gaji</a>
            </li>
        </ol>
    </div>
    @endsection @section('button')
    <a href="{{ route('admin.slip_gaji.create') }}" class="btn btn-primary btn-sm btn-flat">
        <i class="mdi mdi-plus mr-2"></i>Tambah </a>
    @endsection 
    @section('content') 
    @include('includes.flash')
    <!--Show Validation Errors here-->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--End showing Validation Errors here-->
    <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>Total Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>                
        <tbody>
            @foreach ($slip_gaji as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['karyawan']['nama'] }}</td>
                    <td>{{ $item['karyawan']['jabatan'] }}</td>
                    <td>{{ number_format($item['total_gaji'], 2) }}</td>
                    <td>
                        <a href="{{ route('admin.slip_gaji.show', $item['no_ref']) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('admin.slip_gaji.edit', $item['no_ref']) }}" class="btn btn-success btn-sm">Edit</a>
                        <a href="{{ route('admin.slip_gaji.destroy', $item['no_ref']) }}" class="btn btn-danger btn-sm btn-flat" onclick="return confirm('Apakah Anda yakin ingin menghapus slip gaji ini?');">
                            <i class="fa fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <!-- end col --></div>
@endsection
