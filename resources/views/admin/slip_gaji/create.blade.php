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
                    <h1>Tambah Slip Gaji</h1>
                    <form action="{{ route('admin.slip_gaji.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="tgl">Tanggal <span style="color: red;">*</span></label>
                            <input type="date" name="tgl" id="tgl" class="form-control" required>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="kode_karyawan">Karyawan <span style="color: red;">*</span></label>
                            <select class="form-control" id="kode_karyawan" name="kode_karyawan" required>
                                <option value="" selected disabled>Pilih Karyawan</option>
                                @foreach ($karyawan as $item)
                                    <option value="{{ $item->kode_karyawan }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <h3>Detail Gaji</h3>
                        <div id="detail-gaji-container">
                            <div class="detail-gaji-item">
                                <div class="form-group mb-3">
                                    <label for="keterangan_gaji">Keterangan Gaji <span style="color: red;">*</span></label>
                                    <select class="form-control" name="keterangan_gaji[]" required>
                                        <option value="" selected disabled>Pilih Keterangan</option>
                                        @foreach ($keterangan_gaji as $item)
                                            <option value="{{ $item->no }}">{{ $item->keterangan }} ({{ ucfirst($item->debitkredit) }})</option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="form-group mb-3">
                                    <label for="nominal">Nominal <span style="color: red;">*</span></label>
                                    <input type="number" name="nominal[]" class="form-control" placeholder="Masukkan Nominal" required>
                                </div>
    
                                <button type="button" class="btn btn-danger remove-detail-gaji">Hapus</button>
                                <hr>
                            </div>
                        </div>
    
                        <button type="button" id="add-detail-gaji" class="btn btn-secondary">Tambah Detail</button>
    
                        <div class="form-group mb-3 mt-3">
                            <label for="total_gaji">Total Gaji <span style="color: red;">*</span></label>
                            <input type="number" name="total_gaji" id="total_gaji" class="form-control" placeholder="Total Gaji" readonly>
                        </div>
    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.slip_gaji.index') }}" class="btn btn-secondary">Batal</a>
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

<script>
    $(document).ready(function () {
        // Fungsi untuk menghitung total gaji
        function calculateTotalGaji() {
            let total = 0;
            $('.detail-gaji-item').each(function () {
                const nominal = parseFloat($(this).find('input[name="nominal[]"]').val());
                const tipe = $(this).find('select[name="keterangan_gaji[]"] option:selected').text().toLowerCase();

                if (!isNaN(nominal)) {
                    if (tipe.includes('debit')) {
                        total -= nominal; // Kurangi jika tipe debit
                    } else if (tipe.includes('kredit')) {
                        total += nominal; // Tambahkan jika tipe kredit
                    }
                }
            });
            $('#total_gaji').val(total); // Set nilai total gaji
        }

        // Hitung ulang total gaji setiap kali nominal atau keterangan berubah
        $(document).on('input', 'input[name="nominal[]"]', function () {
            calculateTotalGaji();
        });

        $(document).on('change', 'select[name="keterangan_gaji[]"]', function () {
            calculateTotalGaji();
        });

        // Tambahkan detail gaji baru
        $('#add-detail-gaji').click(function () {
            const detailGajiTemplate = `
                <div class="detail-gaji-item">
                    <div class="form-group mb-3">
                        <label for="keterangan_gaji">Keterangan Gaji <span style="color: red;">*</span></label>
                        <select class="form-control" name="keterangan_gaji[]" required>
                            <option value="" selected disabled>Pilih Keterangan</option>
                            @foreach ($keterangan_gaji as $item)
                                <option value="{{ $item->no }}">{{ $item->keterangan }} ({{ ucfirst($item->debitkredit) }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nominal">Nominal <span style="color: red;">*</span></label>
                        <input type="number" name="nominal[]" class="form-control" placeholder="Masukkan Nominal" required>
                    </div>

                    <button type="button" class="btn btn-danger remove-detail-gaji">Hapus</button>
                    <hr>
                </div>
            `;
            $('#detail-gaji-container').append(detailGajiTemplate);
        });

        // Hapus detail gaji
        $(document).on('click', '.remove-detail-gaji', function () {
            $(this).closest('.detail-gaji-item').remove();
            calculateTotalGaji(); // Hitung ulang total gaji setelah detail dihapus
        });
    });
</script>
@endsection