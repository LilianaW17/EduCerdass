-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jun 2024 pada 04.31
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
-- Database: `cerdasedu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `pass_admin` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `email_admin`, `nama_admin`, `pass_admin`) VALUES
(1, 'admin@gmail.com', 'admin', '03f7f7198958ffbda01db956d15f134a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `tutor_id` int(11) DEFAULT NULL,
  `nama_materi` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id_materi`, `tutor_id`, `nama_materi`, `deskripsi`) VALUES
(1, 1, 'Basic PHP', 'Ini materi awal untuk mempelajari PHP'),
(2, 3, 'Basic Javascript', 'Ini materi awal untuk mempelajari Javascript'),
(3, 2, 'Basic CSS', 'Ini materi awal untuk mempelajari CSS'),
(4, 1, 'PHP Dasar', 'Memperkenalkan apa itu PHP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelajar`
--

CREATE TABLE `pelajar` (
  `pelajar_id` int(11) NOT NULL,
  `email_pelajar` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelajar`
--

INSERT INTO `pelajar` (`pelajar_id`, `email_pelajar`, `username`, `password`, `nama_depan`, `nama_belakang`, `jenis_kelamin`) VALUES
(1, 'wulan@gmail.com', 'wulandari', 'aae79912250d18756900f742270de7e1', 'Ajeng', 'Wulandari', ''),
(2, 'budi@gmail.com', 'budi', '53b9480d3d7be11b6634301d0b01d36d', 'Budi', 'Vincent', 'Pria'),
(3, 'justin@gmail.com', 'justin', '8134b84030cca5285ed0e0b31ba06f10', 'Justin', 'William', 'Pria'),
(4, 'gerald@gmail.com', 'gerald', '98302eb9727009d08199b25b7b72b1cb', 'Gerald', 'Frendy', 'Pria');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `nama_quiz` varchar(255) NOT NULL,
  `pelajar_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tutors`
--

CREATE TABLE `tutors` (
  `tutor_id` int(11) NOT NULL,
  `email_tutor` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tutors`
--

INSERT INTO `tutors` (`tutor_id`, `email_tutor`, `username`, `password`) VALUES
(1, 'ajeng@gmail.com', 'ajeng', '8c74343b00f618a7fea4ca0c3e5955e9'),
(2, 'adit@gmail.com', 'adietya', '486b6c6b267bc61677367eb6b6458764'),
(3, 'winarti@gmail.com', 'wina', 'eae222a47e887fcc8c7aae8a92282f35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email_admin` (`email_admin`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indeks untuk tabel `pelajar`
--
ALTER TABLE `pelajar`
  ADD PRIMARY KEY (`pelajar_id`),
  ADD UNIQUE KEY `email_pelajar` (`email_pelajar`);

--
-- Indeks untuk tabel `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `fk_pelajar` (`pelajar_id`);

--
-- Indeks untuk tabel `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`tutor_id`),
  ADD UNIQUE KEY `email_tutor` (`email_tutor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pelajar`
--
ALTER TABLE `pelajar`
  MODIFY `pelajar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tutors`
--
ALTER TABLE `tutors`
  MODIFY `tutor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`tutor_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `fk_pelajar` FOREIGN KEY (`pelajar_id`) REFERENCES `pelajar` (`pelajar_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
