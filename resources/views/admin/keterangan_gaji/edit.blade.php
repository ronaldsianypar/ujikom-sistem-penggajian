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
                <a href="javascript:void(0);">Edit</a>
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
                    <h1>Edit Keterangan Gaji</h1>
                    <form action="{{ route('admin.keterangan_gaji.update', $keterangan_gaji->no) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan <span style="color: red;">*</span></label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $keterangan_gaji->keterangan }}" placeholder="Masukkan Keterangan Gaji" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="debitkredit">Debit/Kredit <span style="color: red;">*</span></label>
                            <select class="form-control" id="debitkredit" name="debitkredit" required>
                                <option value="debit" {{ $keterangan_gaji->debitkredit == 'debit' ? 'selected' : '' }}>Debit</option>
                                <option value="kredit" {{ $keterangan_gaji->debitkredit == 'kredit' ? 'selected' : '' }}>Kredit</option>
                            </select>
                        </div>
    
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        <a href="{{ route('admin.keterangan_gaji.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
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