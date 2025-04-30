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
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Create</a>
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
                    <h1>Tambah Karyawan</h1>
                    <form action="{{ route('admin.karyawan.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama">Nama Karyawan <span style="color: red;">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Karyawan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat <span style="color: red;">*</span></label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Masukkan Alamat Karyawan" required></textarea>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="jabatan">Jabatan <span style="color: red;">*</span></label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Masukkan Jabatan Karyawan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="no_telp">No Telepon <span style="color: red;">*</span></label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Masukkan No Telepon Karyawan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="email">Email <span style="color: red;">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email Karyawan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="no_rekening">No Rekening <span style="color: red;">*</span></label>
                            <input type="text" name="no_rekening" id="no_rekening" class="form-control" placeholder="Masukkan No Rekening Karyawan" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="rek_bank">Bank <span style="color: red;">*</span></label>
                            <input type="text" name="rek_bank" id="rek_bank" class="form-control" placeholder="Masukkan Nama Bank" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="id_perusahaan">Perusahaan <span style="color: red;">*</span></label>
                            <select class="form-control" id="id_perusahaan" name="id_perusahaan" required>
                                <option value="" selected disabled>Pilih Perusahaan</option>
                                @foreach ($perusahaan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- end col --></div>
@endsection

@section('script-bottom')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Inisialisasi peta
        const map = L.map("map").setView([3.585242, 98.675598], 10); // Koordinat Sumatera Utara (Medan sebagai pusat)

        // Tambahkan layer OpenStreetMap
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
        }).addTo(map);

        // Marker untuk menunjukkan lokasi yang dipilih
        let marker;

        // Event klik pada peta
        map.on("click", function (e) {
            const { lat, lng } = e.latlng;

            // Jika marker sudah ada, pindahkan marker
            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                // Tambahkan marker baru
                marker = L.marker(e.latlng).addTo(map);
            }

            // Isi input dengan koordinat lokasi
            document.getElementById("map_location").value = `${lat}, ${lng}`;
        });
    });
</script>
@endsection