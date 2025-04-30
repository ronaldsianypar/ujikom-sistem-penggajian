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
                    <h1>Edit Slip Gaji</h1>
                    <form action="{{ route('admin.slip_gaji.update', $slip_gaji->no_ref) }}" method="POST">
                        @csrf
                        @method('PUT')
    
                        <!-- Input Tanggal -->
                        <div class="form-group mb-3">
                            <label for="tgl">Tanggal <span style="color: red;">*</span></label>
                            <input type="date" name="tgl" id="tgl" class="form-control" value="{{ $slip_gaji->tgl }}" required>
                        </div>
    
                        <!-- Dropdown Karyawan -->
                        <div class="form-group mb-3">
                            <label for="kode_karyawan">Karyawan <span style="color: red;">*</span></label>
                            <select class="form-control" id="kode_karyawan" name="kode_karyawan" required disabled>
                                <option value="" selected disabled>Pilih Karyawan</option>
                                @foreach ($karyawan as $item)
                                    <option value="{{ $item->kode_karyawan }}" {{ $slip_gaji->kode_karyawan == $item->kode_karyawan ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <!-- Detail Gaji -->
                        <h3>Detail Gaji</h3>
                        <div id="detail-gaji-container">
                            @foreach ($slip_gaji->detailGaji as $detail)
                                <div class="detail-gaji-item">
                                    <div class="form-group mb-3">
                                        <label for="keterangan_gaji">Keterangan Gaji <span style="color: red;">*</span></label>
                                        <select class="form-control" name="keterangan_gaji[]" required>
                                            <option value="" selected disabled>Pilih Keterangan</option>
                                            @foreach ($keterangan_gaji as $item)
                                                <option value="{{ $item->no }}" {{ $detail->no == $item->no ? 'selected' : '' }}>{{ $item->keterangan }} ({{ ucfirst($item->debitkredit) }})</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    <div class="form-group mb-3">
                                        <label for="nominal">Nominal <span style="color: red;">*</span></label>
                                        <input type="number" name="nominal[]" class="form-control" value="{{ $detail->nominal }}" placeholder="Masukkan Nominal" required>
                                    </div>
    
                                    <button type="button" class="btn btn-danger remove-detail-gaji">Hapus</button>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
    
                        <button type="button" id="add-detail-gaji" class="btn btn-secondary">Tambah Detail</button>
    
                        <!-- Total Gaji -->
                        <div class="form-group mb-3 mt-3">
                            <label for="total_gaji">Total Gaji <span style="color: red;">*</span></label>
                            <input type="number" name="total_gaji" id="total_gaji" class="form-control" value="{{ $slip_gaji->total_gaji }}" readonly>
                        </div>
    
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        <a href="{{ route('admin.slip_gaji.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
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