@extends('layouts.master') @section('css')
    @endsection @section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Perusahaan</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.perusahaan.index') }}">Perusahaan</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Detail</a>
            </li>
        </ol>
    </div>
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
                    <h1>Detail Karyawan</h1>
    
                    <table class="table table-borderless" style="width: 50%;">
                        <tr>
                            <th>Nama Karyawan</th>
                            <th>:</th>
                            <td>{{ $karyawan->nama }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <th>:</th>
                            <td>{{ $karyawan->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <th>:</th>
                            <td>{{ $karyawan->jabatan }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <th>:</th>
                            <td>{{ $karyawan->no_telp }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>:</th>
                            <td>{{ $karyawan->email }}</td>
                        </tr>
                        <tr>
                            <th>No Rekening</th>
                            <th>:</th>
                            <td>{{ $karyawan->no_rekening }}</td>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <th>:</th>
                            <td>{{ $karyawan->rek_bank }}</td>
                        </tr>
                        <tr>
                            <th>Perusahaan</th>
                            <th>:</th>
                            <td>{{ $karyawan->perusahaan->nama }}</td>
                        </tr>
                    </table>    
    
                    <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
<script>

</script>
@endsection