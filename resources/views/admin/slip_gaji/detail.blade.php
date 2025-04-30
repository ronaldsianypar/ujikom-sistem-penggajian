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
                    <h1>Detail Slip Gaji</h1>
    
                    <!-- Informasi Slip Gaji -->
                    <table class="table table-borderless" style="width: 50%;">
                        <tr>
                            <th>No Referensi</th>
                            <th>:</th>
                            <td>{{ $slip_gaji->no_ref }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <th>:</th>
                            <td>{{ $slip_gaji->tgl }}</td>
                        </tr>
                        <tr>
                            <th>Total Gaji</th>
                            <th>:</th>
                            <td>{{ number_format($slip_gaji->total_gaji, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Nama Karyawan</th>
                            <th>:</th>
                            <td>{{ $slip_gaji->karyawan->nama }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <th>:</th>
                            <td>{{ $slip_gaji->karyawan->jabatan }}</td>
                        </tr>
                    </table>
    
                    <!-- Detail Gaji -->
                    <h3>Detail Gaji</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Debit/Kredit</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slip_gaji->detailGaji as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->keteranganGaji->keterangan }}</td>
                                    <td>{{ ucfirst($detail->keteranganGaji->debitkredit) }}</td>
                                    <td>{{ number_format($detail->nominal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    
                    <a href="{{ route('admin.slip_gaji.index') }}" class="btn btn-secondary">Kembali</a>
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