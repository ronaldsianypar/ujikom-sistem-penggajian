@extends('layouts.master') @section('css')
    @endsection @section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Karyawan</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.karyawan.index') }}">Karyawan</a>
            </li>
        </ol>
    </div>
    @endsection @section('button')
    <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary btn-sm btn-flat">
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Alamat</th>
                                <th>Jabatan</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>                
                        <tbody>
                            @foreach ($karyawan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.karyawan.show', $item->kode_karyawan) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('admin.karyawan.edit', $item->kode_karyawan) }}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ route('admin.karyawan.destroy', $item->kode_karyawan) }}" class="btn btn-danger btn-sm btn-flat" onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?');">
                                            <i class="fa fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- end col --></div>
@endsection
