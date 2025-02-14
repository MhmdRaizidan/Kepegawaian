-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Feb 2025 pada 17.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kepegawaian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) NOT NULL,
  `nama_departemen` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`id`, `nama_departemen`, `deskripsi`) VALUES
(4, 'Audit Internal', 'Melakukan pemeriksaan keuangan dan operasional untuk memastikan kepatuhan terhadap kebijakan'),
(5, 'Pajak', 'Mengurus kewajiban pajak perusahaan sesuai regulasi yang berlaku'),
(6, 'Manajemen Keuangan', 'Merencanakan, mengelola, dan mengalokasikan sumber daya keuangan perusahaan'),
(7, 'Pembukuan', 'Bertanggung jawab atas pencatatan transaksi keuangan harian perusahaan'),
(8, 'Pelaporan Keuangan', 'Menyusun laporan keuangan bulanan, triwulanan, dan tahunan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `gaji` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `id_departemen`, `gaji`) VALUES
(3, 'Internal Auditor', 4, 17000000.00),
(4, 'Audit Supervisor', 4, 12000000.00),
(5, 'Tax Manager', 5, 13000000.00),
(6, 'Tax Consultant', 5, 15000000.00),
(7, 'Financial Controller', 6, 16000000.00),
(8, 'Finance Planner', 6, 11000000.00),
(9, 'Bookkeeping Manager', 7, 18000000.00),
(10, 'Senior Bookkeeper', 7, 13000000.00),
(11, 'Financial Reporting Manager', 8, 17000000.00),
(12, 'Financial Analyst', 8, 11500000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `gaji` decimal(10,2) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `nip`, `nama`, `id_departemen`, `id_jabatan`, `gaji`, `jenis_kelamin`, `tanggal_masuk`) VALUES
(4, '1023456789', 'Budi Santoso', 4, 3, 17000000.00, 'Laki-laki', '2021-06-15'),
(5, '2098765432', 'Siti Aminah', 4, 4, 12000000.00, 'Perempuan', '2022-08-10'),
(6, '3056789123', 'Rizky Pratama', 5, 5, 13000000.00, 'Laki-laki', '2020-03-20'),
(7, '4092345678', 'Dewi Lestari', 5, 6, 15000000.00, 'Perempuan', '2019-11-05'),
(8, '5087654321', 'Andi Wijaya', 6, 7, 16000000.00, 'Laki-laki', '2023-02-12'),
(9, '6091234567', 'Nina Safitri', 6, 8, 11000000.00, 'Perempuan', '2021-09-28'),
(11, '8098765432', 'Fitri Handayani', 7, 10, 13000000.00, 'Perempuan', '2020-12-03'),
(12, '9056789123', 'Fajar Nugroho', 8, 11, 17000000.00, 'Laki-laki', '2022-05-21'),
(13, '1092345678', 'Aulia Rahma', 8, 12, 11500000.00, 'Perempuan', '2023-10-11'),
(14, '1234567891', 'Manisha Kartika', 5, 5, 13000000.00, 'Perempuan', '2025-02-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$XVumsH1Km4a8qFlxqER7LucYD5mEnew2X/eTN61HtcJ7yFCDU5UBy');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_departemen` (`id_departemen`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `id_departemen` (`id_departemen`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id`);

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id`),
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
