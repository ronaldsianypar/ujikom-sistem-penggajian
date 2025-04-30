SEKARANG BUATKAN MODEL app > Models > Perusahaan.php 

INI CONTOH MODEL Jabatan.php 
class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';

    protected $fillable = [
        'nama_jabatan',
        'status_aktif',
        'user_created_id',
        'deleted_at',
        'user_deleted_id',
    ];

    public function userCreated()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }

}

============================BATAS===========================================
SEKARANG BUATKAN CREATE perusahaan > create.blade.php

INI CONTOH CREATE jabatan > create.blade.php:
<form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
        <label for="nama">Nama Guru</label>
        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Guru" required>
    </div>

    <div class="form-group mb-3">
        <label for="nip">NIP</label>
        <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP Guru" required>
    </div>

    <div class="form-group">
        <label for="jabatan_id">Jabatan <span style="color: red;">*</span></label>
        <select class="form-control" id="jabatan_id" name="jabatan_id" required>
            <option value="" selected disabled>Pilih Jabatan</option>
            @foreach ($jabatan as $key)
                <option value="{{ $key->id }}">{{ $key->nama_jabatan }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="pendidikan">Pendidikan <span style="color: red;">*</span></label>
        <select class="form-control" id="pendidikan" name="pendidikan" required>
            <option value="" selected disabled>Pilih Status</option>
            <option value="SD">SD</option>
            <option value="SMP">SMP</option>
            <option value="SMP">SMP</option>
            <option value="SMA/SMK">SMA/SMK</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="tempat_lahir">Tempat Lahir <span style="color: red;">*</span></label>
        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir" required>
    </div>
    
    <div class="form-group mb-3">
        <label for="tanggal_lahir">Tempat Lahir <span style="color: red;">*</span></label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir" required>
    </div>

    <div class="form-group">
        <label for="agama">Agama <span style="color: red;">*</span></label>
        <select class="form-control" id="agama" name="agama" required>
            <option value="" selected disabled>Pilih Status</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Kalotik">Kalotik</option>
            <option value="Hindu">Hindu</option>
            <option value="Budha">Budha</option>
            <option value="Konghucu">Konghucu</option>
        </select>
    </div>
    
    <div class="form-group mb-3">
        <label for="telepon">Telepon <span style="color: red;">*</span></label>
        <input type="text" name="telepon" id="telepon" class="form-control" placeholder="Masukkan Telepon" required>
    </div>

    <div class="form-group mb-3">
        <label for="foto">Foto Guru <span style="color: red;">*</span></label>
        <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
    </div>

    <div class="form-group mb-3">
        <label for="alamat">Alamat <span style="color: red;">*</span></label>
        <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Masukkan Alamat" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Batal</a>
</form>

============================BATAS===========================================
SEKARANG BUATKAN FUNC store app > Http > Controllers > PerusahaanController.php

INI CONTOH FUNC store app > Http > Controllers > JabatanController.php:
public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_jabatan' => 'required|string|max:50',
    ]);

    // Simpan data ke database
    Jabatan::create([
        'nama_jabatan' => $request->nama_jabatan,
        'status_aktif' => 1,
        'user_created_id' => Auth::user()->id,
    ]);

    flash()->success('Success', 'Jabatan Berhasil Disimpan!');
    return redirect()->route('admin.jabatan.index');
}

============================BATAS===========================================
SAYA SUDAH MEMBUAT FUNC show di controller > PerusahaanController.php
public function show()
{
    return view('admin.perusahaan.detail')->with(['perusahaan'=> Perusahaan::all()]);
}

SEKARANG BUATKAN SAYA detail.blade.php

INI CONTOH DARI jabatan > detail.blade.php:
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1>Detail Guru</h1>

                <table class="table table-borderless" style="width: 20%;">
                    <tr>
                        <th>Nama Guru</th>
                        <th>:</th>
                        <td>{{ $guru->nama }}</td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <th>:</th>
                        <td>{{ $guru->nip }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <th>:</th>
                        <td>{{ $guru->nama_jabatan ? $guru->nama_jabatan : 'Tidak ada Jabatan' }}</td>
                    </tr>
                    <tr>
                        <th>Pendidikan</th>
                        <th>:</th>
                        <td>{{ $guru->pendidikan }}</td>
                    </tr>
                    <tr>
                        <th>Tempat Lahir</th>
                        <th>:</th>
                        <td>{{ $guru->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <th>:</th>
                        <td>{{ \Carbon\Carbon::parse($guru->tanggal_lahir)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <th>:</th>
                        <td>{{ $guru->agama }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <th>:</th>
                        <td>{{ $guru->telepon }}</td>
                    </tr>
                    <tr>
                        <th>Foto Guru</th>
                        <th>:</th>
                        <td>
                            @if ($guru->foto_path)
                                <img src="{{ asset('storage/' . $guru->foto_path) }}" alt="Foto Guru" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td>{{ $guru->alamat }}</td>
                    </tr>
                </table>    

                <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>


============================BATAS===========================================
SEKARANG BUATKAN EDIT perusahaan > edit.blade.php

INI CONTOH CREATE jabatan > edit.blade.php:
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1>Edit Guru</h1>
                <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="nama">Nama Guru <span style="color: red;">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $guru->nama }}" placeholder="Masukkan Nama Guru" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nip">NIP <span style="color: red;">*</span></label>
                        <input type="text" name="nip" id="nip" class="form-control" value="{{ $guru->nip }}" placeholder="Masukkan NIP Guru" required>
                    </div>
                
                    <div class="form-group">
                        <label for="jabatan_id">Jabatan <span style="color: red;">*</span></label>
                        <select class="form-control" id="jabatan_id" name="jabatan_id" required>
                            <option value="" selected disabled {{ $guru->jabatan_id ? '' : 'selected' }}>Pilih Jabatan</option>
                            @foreach ($jabatan as $key)
                                <option value="{{ $key->id }}" {{ $guru->jabatan_id == $key->id ? 'selected' : '' }}>{{ $key->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="pendidikan">Pendidikan <span style="color: red;">*</span></label>
                        <select class="form-control" id="pendidikan" name="pendidikan" required>
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="SD" {{ $guru->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ $guru->pendidikan == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMP" {{ $guru->pendidikan == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA/SMK" {{ $guru->pendidikan == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="S1" {{ $guru->pendidikan == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ $guru->pendidikan == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ $guru->pendidikan == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                    </div>
                
                    <div class="form-group mb-3">
                        <label for="tempat_lahir">Tempat Lahir <span style="color: red;">*</span></label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ $guru->tempat_lahir }}" placeholder="Masukkan Tempat Lahir" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="tanggal_lahir">Tempat Lahir <span style="color: red;">*</span></label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $guru->tanggal_lahir }}" placeholder="Masukkan Tanggal Lahir" required>
                    </div>

                    <div class="form-group">
                        <label for="agama">Agama <span style="color: red;">*</span></label>
                        <select class="form-control" id="agama" name="agama" required>
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="Islam" {{ $guru->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ $guru->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Kalotik" {{ $guru->agama == 'Kalotik' ? 'selected' : '' }}>Kalotik</option>
                            <option value="Hindu" {{ $guru->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Budha" {{ $guru->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                            <option value="Konghucu" {{ $guru->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="telepon">Telepon <span style="color: red;">*</span></label>
                        <input type="text" name="telepon" id="telepon" class="form-control" value="{{ $guru->telepon }}" placeholder="Masukkan Telepon" required>
                    </div>
            
                    <div class="form-group mb-3">
                        <label for="foto">Foto Guru</label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                        @if ($guru->foto_path)
                            <p class="mt-2">Foto saat ini:</p>
                            <img src="{{ asset('storage/' . $guru->foto_path) }}" alt="Foto Guru" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat">Alamat <span style="color: red;">*</span></label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="4" required>{{ $guru->alamat }}</textarea>
                    </div>
            
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Batal</a>
                </form>                                                             
            </div>
        </div>
    </div>
</div>


============================BATAS===========================================
SEKARANG BUATKAN FUNC update app > Http > Controllers > PerusahaanController.php

INI CONTOH FUNC update app > Http > Controllers > JabatanController.php:
// Fungsi Update (untuk menyimpan perubahan)
public function update(Request $request, $id)
{
    $request->validate([
        'nama_jabatan' => 'required|string|max:50',
        'status_aktif' => 'required|string',
    ]);

    $jabatan = Jabatan::findOrFail($id);

    // Update data
    $jabatan->nama_jabatan = $request->nama_jabatan;
    $jabatan->status_aktif = $request->status_aktif;
    $jabatan->save();
    
    flash()->success('Success', 'Jabatan Berhasil Diperbarui!');
    return redirect()->route('admin.jabatan.index');
}