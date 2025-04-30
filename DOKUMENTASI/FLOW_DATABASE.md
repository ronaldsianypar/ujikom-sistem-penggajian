# Database Flow Documentation

1. Tabel `perusahaan`
- Menyimpan data perusahaan.
- Setiap perusahaan memiliki `id` unik.
- Data perusahaan menjadi referensi untuk tabel `karyawan`.

2. Tabel `karyawan`
- Menyimpan data karyawan.
- Setiap karyawan memiliki `kode_karyawan` unik.
- Kolom `id_perusahaan` adalah foreign key (FK) yang mengacu ke kolom `id` di tabel `perusahaan`.
- Setiap karyawan terhubung ke satu perusahaan tertentu.

3. Tabel `keterangan_gaji`
- Menyimpan daftar keterangan terkait gaji (debit/kredit).
- Setiap keterangan memiliki `no` unik.
- Kolom `debitkredit` menunjukkan apakah keterangan tersebut adalah debit (pengurangan) atau kredit (penambahan).

4. Tabel `slip_gaji`
- Menyimpan data slip gaji untuk karyawan.
- Setiap slip gaji memiliki `no_ref` unik.
- Kolom `kode_karyawan` adalah foreign key (FK) yang mengacu ke kolom `kode_karyawan` di tabel `karyawan`.
- Setiap slip gaji terhubung ke satu karyawan tertentu.

5. Tabel `detail_gaji`
- Menyimpan rincian gaji berdasarkan keterangan tertentu.
- Kolom `no` adalah foreign key (FK) yang mengacu ke kolom `no` di tabel `keterangan_gaji`.
- Kolom `no_ref` adalah foreign key (FK) yang mengacu ke kolom `no_ref` di tabel `slip_gaji`.
- Setiap detail gaji terhubung ke satu slip gaji dan satu keterangan gaji.

Alur Data
1. Perusahaan → Karyawan: Perusahaan memiliki banyak karyawan.
2. Karyawan → Slip Gaji: Setiap karyawan memiliki slip gaji.
3. Slip Gaji → Detail Gaji: Slip gaji memiliki rincian gaji.
4. Detail Gaji → Keterangan Gaji: Rincian gaji memiliki keterangan (debit/kredit).

Contoh Alur
- Perusahaan "ABC" memiliki karyawan "John".
- "John" memiliki slip gaji untuk bulan tertentu.
- Slip gaji tersebut memiliki rincian gaji, seperti gaji pokok (kredit) dan potongan pajak (debit).
- Rincian gaji ini mengacu pada keterangan gaji yang menjelaskan jenis debit/kredit.