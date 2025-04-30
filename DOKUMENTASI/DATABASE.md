-- Membuat database
CREATE DATABASE ronald_ujikom_penggajian;
USE ronald_ujikom_penggajian;

-- Tabel perusahaan
CREATE TABLE perusahaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    alamat TEXT NOT NULL,
    no_telpon VARCHAR(15),
    email VARCHAR(255)
);

-- Tabel karyawan
CREATE TABLE karyawan (
    kode_karyawan INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    alamat TEXT NOT NULL,
    jabatan VARCHAR(100),
    no_telp VARCHAR(15),
    email VARCHAR(255),
    no_rekening VARCHAR(50),
    rek_bank VARCHAR(100),
    id_perusahaan INT,
    FOREIGN KEY (id_perusahaan) REFERENCES perusahaan(id)
);

-- Tabel keterangan_gaji
CREATE TABLE keterangan_gaji (
    no INT AUTO_INCREMENT PRIMARY KEY,
    keterangan VARCHAR(255) NOT NULL,
    debitkredit ENUM('debit', 'kredit') NOT NULL
);

-- Tabel slip_gaji
CREATE TABLE slip_gaji (
    no_ref INT AUTO_INCREMENT PRIMARY KEY,
    tgl DATE NOT NULL,
    total_gaji DECIMAL(15, 2) NOT NULL,
    kode_karyawan INT,
    FOREIGN KEY (kode_karyawan) REFERENCES karyawan(kode_karyawan)
);

-- Tabel detail_gaji
CREATE TABLE detail_gaji (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no INT,
    no_ref INT,
    nominal DECIMAL(15, 2) NOT NULL,
    FOREIGN KEY (no) REFERENCES keterangan_gaji(no),
    FOREIGN KEY (no_ref) REFERENCES slip_gaji(no_ref)
);