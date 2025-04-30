@extends('layouts.master') @section('css')
    @endsection @section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Keterangan Gaji</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.keterangan_gaji.index') }}">Keterangan Gaji</a>
            </li>
        </ol>
    </div>
    @endsection @section('button')
    <a href="{{ route('admin.keterangan_gaji.create') }}" class="btn btn-primary btn-sm btn-flat">
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
                                <th>Keterangan</th>
                                <th>Debit/Kredit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>                
                        <tbody>
                            @foreach ($keterangan_gaji as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ ucfirst($item->debitkredit) }}</td>
                                    <td>
                                        <a href="{{ route('admin.keterangan_gaji.show', $item->no) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('admin.keterangan_gaji.edit', $item->no) }}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ route('admin.keterangan_gaji.destroy', $item->no) }}" class="btn btn-danger btn-sm btn-flat" onclick="return confirm('Apakah Anda yakin ingin menghapus keterangan gaji ini?');">
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
