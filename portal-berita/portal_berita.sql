-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2025 at 10:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_berita`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$EZPpfY4n3tBH9aw82CFqruVTXeUNjQckayHsX.wMzBzamqbea4tpi');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal_publikasi` datetime DEFAULT current_timestamp(),
  `penulis` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `is_recommended` tinyint(1) DEFAULT 0,
  `kategori` enum('pendidikan','teknologi','ekonomi','olahraga','kesehatan') DEFAULT 'pendidikan',
  `is_populer` tinyint(1) DEFAULT 0,
  `is_rekomendasi` tinyint(1) DEFAULT 0,
  `status` enum('published','draft') DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `tanggal_publikasi`, `penulis`, `views`, `is_recommended`, `kategori`, `is_populer`, `is_rekomendasi`, `status`) VALUES
(2, 'Pembukaan Gedung Rumah Sakit', 'Pemerintah kota hari ini meresmikan gedung sekolah baru yang dibangun untuk menampung siswa yang semakin bertambah. Gedung ini dilengkapi dengan fasilitas modern seperti laboratorium komputer dan perpustakaan digital.', 'img_68910c9fb170f.jpg', '2023-10-15 09:00:00', 'Reporter Pendidikan', 1250, 0, 'pendidikan', 1, 0, 'draft'),
(3, 'Festival Budaya Daerah 2023', 'Festival budaya tahunan kembali digelar dengan peserta dari 15 daerah berbeda. Acara ini menampilkan tarian tradisional, musik daerah, dan kuliner khas masing-masing wilayah.', 'img_68910d0f521eb.png', '2023-10-12 14:30:00', 'Tim Budaya', 980, 0, 'pendidikan', 0, 0, 'draft'),
(4, 'Inovasi Teknologi Terkini', 'Startup lokal meluncurkan produk terbaru yang revolusioner di bidang industri kreatif. Produk ini diklaim dapat meningkatkan produktivitas hingga 40%.', 'img_68910d2d47e70.jpg', '2023-10-10 11:15:00', 'Wartawan Tekno', 1560, 1, 'pendidikan', 0, 0, 'draft'),
(5, 'Peningkatan Ekonomi di Triwulan Ketiga', 'Badan Pusat Statistik melaporkan pertumbuhan ekonomi sebesar 5.2% pada triwulan ketiga tahun ini, lebih tinggi dari proyeksi awal.', 'ekonomi.jpg', '2023-10-08 08:45:00', 'Tim Ekonomi', 750, 0, 'pendidikan', 0, 0, 'draft'),
(6, 'Kejuaraan Olahraga Nasional', 'Atlet dari provinsi Jawa Barat meraih medali emas dalam cabang renang di Kejuaraan Olahraga Nasional tahun ini.', 'olahraga.jpg', '2023-10-05 16:20:00', 'Reporter Olahraga', 1120, 1, 'pendidikan', 1, 0, 'draft'),
(7, 'Seminar Kesehatan Mental', 'Universitas ternama mengadakan seminar nasional tentang pentingnya kesehatan mental bagi generasi muda di era digital.', 'kesehatan.jpg', '2023-10-03 13:10:00', 'Tim Kesehatan', 890, 0, 'pendidikan', 0, 0, 'draft'),
(8, 'Pembukaan Gedung Sekolah Baru', 'Pemerintah kota hari ini meresmikan gedung sekolah baru yang dibangun untuk menampung siswa yang semakin bertambah. Gedung ini dilengkapi dengan fasilitas modern seperti laboratorium komputer dan perpustakaan digital.', 'img_68910cf9ee6fa.png', '2023-10-15 09:00:00', 'Reporter Pendidikan', 1250, 0, 'pendidikan', 1, 0, 'published'),
(9, 'Festival Budaya Daerah 2023', 'Festival budaya tahunan kembali digelar dengan peserta dari 15 daerah berbeda. Acara ini menampilkan tarian tradisional, musik daerah, dan kuliner khas masing-masing wilayah.', 'festival.jpg', '2023-10-12 14:30:00', 'Tim Budaya', 980, 1, 'pendidikan', 0, 0, 'draft'),
(10, 'Inovasi Teknologi Terkini', 'Startup lokal meluncurkan produk terbaru yang revolusioner di bidang industri kreatif. Produk ini diklaim dapat meningkatkan produktivitas hingga 40%.', 'teknologi.jpg', '2023-10-10 11:15:00', 'Wartawan Tekno', 1560, 0, 'pendidikan', 0, 0, 'draft'),
(11, 'Peningkatan Ekonomi di Triwulan Ketiga', 'Badan Pusat Statistik melaporkan pertumbuhan ekonomi sebesar 5.2% pada triwulan ketiga tahun ini, lebih tinggi dari proyeksi awal.', 'ekonomi.jpg', '2023-10-08 08:45:00', 'Tim Ekonomi', 750, 0, 'pendidikan', 0, 0, 'draft'),
(12, 'Kejuaraan Olahraga Nasional', 'Atlet dari provinsi Jawa Barat meraih medali emas dalam cabang renang di Kejuaraan Olahraga Nasional tahun ini.', 'olahraga.jpg', '2023-10-05 16:20:00', 'Reporter Olahraga', 1120, 1, 'pendidikan', 0, 0, 'draft'),
(13, 'Seminar Kesehatan Mental', 'Universitas ternama mengadakan seminar nasional tentang pentingnya kesehatan mental bagi generasi muda di era digital.', 'kesehatan.jpg', '2023-10-03 13:10:00', 'Tim Kesehatan', 890, 0, 'pendidikan', 0, 0, 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `slug`, `deskripsi`) VALUES
(1, 'Pendidikan', 'pendidikan', 'Berita seputar dunia pendidikan'),
(2, 'Teknologi', 'teknologi', 'Berita perkembangan teknologi terbaru'),
(3, 'Ekonomi', 'ekonomi', 'Berita ekonomi dan bisnis'),
(4, 'Olahraga', 'olahraga', 'Berita olahraga terkini'),
(5, 'Kesehatan', 'kesehatan', 'Berita kesehatan dan gaya hidup'),
(6, 'Politik', 'politik', 'Berita politik dalam dan luar negeri'),
(7, 'Hiburan', 'hiburan', 'Berita selebriti dan hiburan');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `id_berita` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `isi` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_berita` (`id_berita`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
