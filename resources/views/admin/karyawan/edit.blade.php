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
                    <h1>Edit Karyawan</h1>
                    <form action="{{ route('admin.karyawan.update', $karyawan->kode_karyawan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="nama">Nama Karyawan <span style="color: red;">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $karyawan->nama }}" placeholder="Masukkan Nama Karyawan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat <span style="color: red;">*</span></label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Masukkan Alamat Karyawan" required>{{ $karyawan->alamat }}</textarea>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="jabatan">Jabatan <span style="color: red;">*</span></label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ $karyawan->jabatan }}" placeholder="Masukkan Jabatan Karyawan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="no_telp">No Telepon <span style="color: red;">*</span></label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ $karyawan->no_telp }}" placeholder="Masukkan No Telepon Karyawan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="email">Email <span style="color: red;">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $karyawan->email }}" placeholder="Masukkan Email Karyawan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="no_rekening">No Rekening <span style="color: red;">*</span></label>
                            <input type="text" name="no_rekening" id="no_rekening" class="form-control" value="{{ $karyawan->no_rekening }}" placeholder="Masukkan No Rekening Karyawan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="rek_bank">Bank <span style="color: red;">*</span></label>
                            <input type="text" name="rek_bank" id="rek_bank" class="form-control" value="{{ $karyawan->rek_bank }}" placeholder="Masukkan Nama Bank" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="id_perusahaan">Perusahaan <span style="color: red;">*</span></label>
                            <select class="form-control" id="id_perusahaan" name="id_perusahaan" required>
                                <option value="" selected disabled>Pilih Perusahaan</option>
                                @foreach ($perusahaan as $item)
                                    <option value="{{ $item->id }}" {{ $karyawan->id_perusahaan == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Batal</a>
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