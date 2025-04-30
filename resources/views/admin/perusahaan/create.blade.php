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
                    <form action="{{ route('admin.perusahaan.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama">Nama Perusahaan</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Perusahaan" required>
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Masukkan Alamat Perusahaan" required></textarea>
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="no_telpon">No Telepon</label>
                            <input type="text" name="no_telpon" id="no_telpon" class="form-control" placeholder="Masukkan No Telepon Perusahaan" required>
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email Perusahaan" required>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.perusahaan.index') }}" class="btn btn-secondary">Batal</a>
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