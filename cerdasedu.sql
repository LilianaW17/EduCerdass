-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jun 2024 pada 21.56
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
(4, 3, 'PHP Dasar', 'Memperkenalkan apa itu PHP'),
(8, 3, 'HTML Part 2', 'setelah part 1, terbitlah part 2, skuy'),
(9, 2, 'CSS Part 2', 'karena sudah rame, maka itu mari kita lanjut ke part 2 nya.'),
(10, 1, 'PHP Part 2', 'kuat-kuatin pokoknya kalo lihat error, mari kita lanjut~');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `nilai_id` int(11) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `pelajar_id` int(11) DEFAULT NULL,
  `nilai_quiz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`nilai_id`, `quiz_id`, `pelajar_id`, `nilai_quiz`) VALUES
(1, 1, 1, 61),
(2, 1, 2, 60),
(3, 1, 3, 65),
(4, 1, 4, 96),
(5, 2, 1, 86),
(6, 2, 2, 93),
(7, 2, 3, 55),
(8, 2, 4, 99),
(9, 3, 1, 81),
(10, 3, 2, 58),
(11, 3, 3, 99),
(12, 3, 4, 70),
(13, 4, 1, 52),
(14, 4, 2, 52),
(15, 4, 3, 53),
(16, 4, 4, 60),
(17, 5, 1, 90),
(18, 5, 2, 73),
(19, 5, 3, 96),
(20, 5, 4, 60),
(21, 6, 1, 63),
(22, 6, 2, 83),
(23, 6, 3, 80),
(24, 6, 4, 50),
(25, 7, 1, 59),
(26, 7, 2, 98),
(27, 7, 3, 63),
(28, 7, 4, 72),
(29, 8, 1, 72),
(30, 8, 2, 93),
(31, 8, 3, 99),
(32, 8, 4, 69);

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
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `foto_profil` varchar(255) DEFAULT 'path/to/default-profile-picture.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelajar`
--

INSERT INTO `pelajar` (`pelajar_id`, `email_pelajar`, `username`, `password`, `nama_depan`, `nama_belakang`, `jenis_kelamin`, `foto_profil`) VALUES
(1, 'wulan@gmail.com', 'wulandari', 'aae79912250d18756900f742270de7e1', 'Ajeng', 'Wulandari', 'Wanita', 'C:\\xampp\\htdocs\\Edu\\EduCerdass\\foto_profil\\example_wulandari.jpeg'),
(2, 'budi@gmail.com', 'budi', '53b9480d3d7be11b6634301d0b01d36d', 'Budi', 'Vincent', 'Pria', 'path/to/default-profile-picture.jpg'),
(3, 'justin@gmail.com', 'justin', '8134b84030cca5285ed0e0b31ba06f10', 'Justin', 'William', 'Pria', 'uploads/example_justin.jpeg'),
(4, 'gerald@gmail.com', 'gerald', '98302eb9727009d08199b25b7b72b1cb', 'Gerald', 'Frendy', 'Pria', 'uploads/442cecba-15f0-470a-a10e-a94d6d972d01.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `nama_quiz` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `nama_quiz`) VALUES
(1, 'Checkpoint 1 HTML'),
(2, 'Checkpoint 1 JavaScript'),
(3, 'Checkpoint 1 CSS'),
(4, 'Checkpoint 1 PHP'),
(5, 'Checkpoint 2 HTML'),
(6, 'Checkpoint 2 JavaScript'),
(7, 'Checkpoint 2 CSS'),
(8, 'Checkpoint 2 PHP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tutors`
--

CREATE TABLE `tutors` (
  `tutor_id` int(11) NOT NULL,
  `email_tutor` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  `foto_profil` varchar(255) DEFAULT 'path/to/default-profile-picture.jpg',
  `nama_depan` varchar(255) DEFAULT NULL,
  `nama_belakang` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `bidang_ahli` text DEFAULT NULL,
  `jenis_kelamin` enum('Pria','Wanita') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tutors`
--

INSERT INTO `tutors` (`tutor_id`, `email_tutor`, `username`, `password`, `foto_profil`, `nama_depan`, `nama_belakang`, `nomor_telepon`, `alamat`, `bidang_ahli`, `jenis_kelamin`) VALUES
(1, 'ajeng@gmail.com', 'ajeng', '8c74343b00f618a7fea4ca0c3e5955e9', 'path/to/default-profile-picture.jpg', 'Ajeng', 'Sakinah', '897654321', 'Jalan Jalan', 'Back-end And Databases', ''),
(2, 'adit@gmail.com', 'adietya', '486b6c6b267bc61677367eb6b6458764', 'path/to/default-profile-picture.jpg', 'Adietya', 'Eka', '88234567', 'Jalan Tanpa Nama', 'Front-end Design', 'Pria'),
(3, 'winarti@gmail.com', 'wina', 'eae222a47e887fcc8c7aae8a92282f35', 'path/to/default-profile-picture.jpg', 'Winarti', 'Solehani', '89878685', 'Jalan Status Gak Jelas', 'UI UX Design', 'Wanita'),
(4, 'windah@gmail.com', 'windahs', '$2y$10$SAPPT9URWWbFSWpMdQdHPeyk1', 'path/to/default-profile-picture.jpg', 'Windah', 'Basudara', '12435687', 'Jalan Bokem', 'JavaScript Animation', 'Pria');

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
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`nilai_id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `pelajar_id` (`pelajar_id`);

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
  ADD PRIMARY KEY (`quiz_id`);

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
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `pelajar`
--
ALTER TABLE `pelajar`
  MODIFY `pelajar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tutors`
--
ALTER TABLE `tutors`
  MODIFY `tutor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`tutor_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`pelajar_id`) REFERENCES `pelajar` (`pelajar_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
