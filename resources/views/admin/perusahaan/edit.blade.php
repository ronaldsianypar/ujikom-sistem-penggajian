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
                    <h1>Edit Perusahaan</h1>
                    <form action="{{ route('admin.perusahaan.update', $perusahaan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="nama">Nama Perusahaan <span style="color: red;">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $perusahaan->nama }}" placeholder="Masukkan Nama Perusahaan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat <span style="color: red;">*</span></label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Masukkan Alamat Perusahaan" required>{{ $perusahaan->alamat }}</textarea>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="no_telpon">No Telepon <span style="color: red;">*</span></label>
                            <input type="text" name="no_telpon" id="no_telpon" class="form-control" value="{{ $perusahaan->no_telpon }}" placeholder="Masukkan No Telepon Perusahaan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="email">Email <span style="color: red;">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $perusahaan->email }}" placeholder="Masukkan Email Perusahaan" required>
                        </div>
    
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        <a href="{{ route('admin.perusahaan.index') }}" class="btn btn-secondary">Batal</a>
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