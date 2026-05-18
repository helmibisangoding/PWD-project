-- setup_database.sql
-- Database HN Amanah Travel dengan login admin, form pendaftaran publik, dan CRUD paket, testimoni, serta pendaftaran.
-- Import file ini melalui phpMyAdmin.

CREATE DATABASE IF NOT EXISTS sacred_journey;
USE sacred_journey;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

INSERT INTO users (nama_lengkap, username, email, password) VALUES
('Administrator', 'admin', 'admin@sacredjourney.com', 'admin123');

DROP TABLE IF EXISTS paket;
CREATE TABLE paket (
    id_paket INT AUTO_INCREMENT PRIMARY KEY,
    nama_paket VARCHAR(100) NOT NULL,
    jenis_paket VARCHAR(50) NOT NULL,
    harga INT NOT NULL,
    durasi VARCHAR(50) NOT NULL,
    fasilitas TEXT NOT NULL,
    deskripsi TEXT NOT NULL
);

INSERT INTO paket (nama_paket, jenis_paket, harga, durasi, fasilitas, deskripsi) VALUES
('Umroh Reguler', 'Umroh', 29900000, '9 Hari', 'Hotel, visa, manasik, muthawif, transportasi AC', 'Program umroh reguler dengan layanan nyaman untuk keluarga dan jamaah umum.'),
('Umroh VVIP', 'Umroh', 42500000, '12 Hari', 'Hotel bintang 5, makan menu Indonesia, rombongan terbatas, handling prioritas', 'Perjalanan premium dengan akomodasi terbaik dan pelayanan lebih personal.'),
('Haji Plus', 'Haji', 150000000, '25 Hari', 'Manasik, hotel, transportasi, makan, pendamping ibadah', 'Program haji khusus dengan pendampingan lengkap dari persiapan hingga kepulangan.');

DROP TABLE IF EXISTS testimoni;
CREATE TABLE testimoni (
    id_testimoni INT AUTO_INCREMENT PRIMARY KEY,
    nama_jamaah VARCHAR(100) NOT NULL,
    nama_paket VARCHAR(100) NOT NULL,
    rating INT NOT NULL,
    isi_testimoni TEXT NOT NULL,
    tanggal VARCHAR(50) NOT NULL
);

INSERT INTO testimoni (nama_jamaah, nama_paket, rating, isi_testimoni, tanggal) VALUES
('Bapak H. Ahmad Zainudin', 'Haji Plus', 5, 'Pengalaman spiritual yang tak terlupakan. Pembimbing ibadah sangat berilmu dan fasilitas hotel tepat di depan pelataran Masjidil Haram.', '2023'),
('Ibu Siti Nurhaliza', 'Umroh VVIP', 5, 'Pelayanan dari keberangkatan hingga kepulangan sangat terorganisir. Makanan juga cocok dengan lidah nusantara.', 'Desember 2023'),
('Keluarga Bapak Budi', 'Umroh Reguler', 5, 'Muthawif sangat sabar membimbing kami yang baru pertama kali ke tanah suci. Kajian setiap malam sangat menambah keimanan.', 'Januari 2024');

DROP TABLE IF EXISTS pendaftaran;
CREATE TABLE pendaftaran (
    id_pendaftaran INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(30) NOT NULL,
    paket_diminati VARCHAR(100) NOT NULL,
    tanggal_daftar DATE NOT NULL,
    status VARCHAR(30) NOT NULL,
    catatan TEXT
);

INSERT INTO pendaftaran (nama_lengkap, email, no_hp, paket_diminati, tanggal_daftar, status, catatan) VALUES
('Ahmad Fauzi', 'ahmad@email.com', '081234567890', 'Umroh Reguler', '2024-01-12', 'Baru', 'Mendaftar dari form publik dan ingin konsultasi jadwal keluarga.'),
('Siti Aminah', 'siti@email.com', '082233445566', 'Umroh VVIP', '2024-02-05', 'Diproses', 'Sudah dihubungi admin melalui WhatsApp.'),
('Budi Santoso', 'budi@email.com', '083333333333', 'Haji Plus', '2024-02-18', 'Valid', 'Data sudah dikonfirmasi oleh admin.');
