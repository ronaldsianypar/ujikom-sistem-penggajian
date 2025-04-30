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
                    <h1>Detail Keterangan Gaji</h1>
    
                    <table class="table table-borderless" style="width: 50%;">
                        <tr>
                            <th>Keterangan</th>
                            <th>:</th>
                            <td>{{ $keterangan_gaji->keterangan }}</td>
                        </tr>
                        <tr>
                            <th>Debit/Kredit</th>
                            <th>:</th>
                            <td>{{ ucfirst($keterangan_gaji->debitkredit) }}</td>
                        </tr>
                    </table>    
    
                    <a href="{{ route('admin.keterangan_gaji.index') }}" class="btn btn-secondary">Kembali</a>
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