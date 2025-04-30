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
                    <h1>Tambah Keterangan Gaji</h1>
                    <form action="{{ route('admin.keterangan_gaji.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan <span style="color: red;">*</span></label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukkan Keterangan Gaji" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="debitkredit">Debit/Kredit <span style="color: red;">*</span></label>
                            <select class="form-control" id="debitkredit" name="debitkredit" required>
                                <option value="" selected disabled>Pilih Tipe</option>
                                <option value="debit">Debit</option>
                                <option value="kredit">Kredit</option>
                            </select>
                        </div>
    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.keterangan_gaji.index') }}" class="btn btn-secondary">Batal</a>
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