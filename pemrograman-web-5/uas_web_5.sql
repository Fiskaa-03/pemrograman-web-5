-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2023 at 05:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_web_5`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` enum('POLITIC','ECONOMY','SPORT') NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publicationDate` date NOT NULL,
  `authorID` int(11) NOT NULL,
  `status` enum('VISIBLE','UNVISIBLE') NOT NULL DEFAULT 'UNVISIBLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `category`, `image`, `content`, `publicationDate`, `authorID`, `status`) VALUES
(1, 'Politik Indonesia 2023', 'POLITIC', 'politic.jpg', 'Indonesia memasuki fase persiapan intensif menjelang Pemilihan Umum (Pemilu) 2024, dengan dinamika politik yang semakin meningkat. Masyarakat dan kandidat politik tengah mempersiapkan diri untuk menghadapi proses demokrasi yang diharapkan menjadi cermin keinginan dan aspirasi rakyat.\r\n\r\nSejumlah partai politik telah memulai langkah-langkah strategis mereka, baik dalam merumuskan platform politik maupun menggalang dukungan publik. Kandidat potensial untuk berbagai posisi mulai bermunculan, menggambarkan keberagaman pemimpin yang akan bersaing dalam kontes demokrasi mendatang.\r\n\r\nDi tengah persaingan yang semakin ketat, tema-tema sentral seperti ekonomi, pendidikan, lingkungan, dan kesehatan menjadi fokus perdebatan dan presentasi visi dari para kandidat. Elektabilitas, rekam jejak, dan program kerja menjadi pertimbangan utama bagi pemilih yang semakin cerdas dan kritis.', '2023-12-29', 1, 'VISIBLE'),
(2, 'Ekonomi Indonesia 2023', 'ECONOMY', 'economy.jpg', 'Pada kuartal kedua tahun ini, Indonesia mencatat pertumbuhan ekonomi yang menggembirakan, menunjukkan ketahanan dan adaptabilitas ekonomi di tengah ketidakpastian global. Data terbaru dari Badan Pusat Statistik (BPS) menunjukkan pertumbuhan ekonomi sebesar 5,2%, melampaui proyeksi sebelumnya dan memberikan sinyal positif bagi pemulihan ekonomi nasional.\r\n\r\nBeberapa sektor yang menjadi pendorong pertumbuhan adalah industri manufaktur, ekspor, dan investasi. Kinerja ekspor non-migas, terutama komoditas pertanian dan produk manufaktur, mengalami kenaikan yang signifikan. Selain itu, investasi dalam proyek-proyek infrastruktur besar terus mendukung pertumbuhan ekonomi, menciptakan lapangan kerja baru dan meningkatkan produktivitas.\r\n\r\nMeskipun pencapaian ini memberikan optimisme, tantangan global seperti kenaikan harga energi dan ketidakpastian perdagangan masih menjadi perhatian. Pemerintah tetap berkomitmen untuk menjaga stabilitas ekonomi dengan kebijakan fiskal yang hati-hati dan terukur.', '2023-12-29', 2, 'VISIBLE'),
(3, 'Pemenang Piala Dunia', 'SPORT', 'sport.jpg', 'Tim sepak bola nasional hari ini mencatatkan kemenangan gemilang dalam pertandingan di turnamen internasional yang digelar di Jakarta. Dalam pertandingan sengit melawan lawan tangguh, tim berhasil mengatasi tekanan dan meraih kemenangan dengan skor 3-2.\r\n\r\nPertandingan dimulai dengan penuh semangat dari kedua tim, namun tim tuan rumah berhasil unggul lebih dulu dengan gol yang dicetak pada menit ke-20 oleh striker andalan, Ahmad Surya. Lawan tidak tinggal diam dan memberikan perlawanan sengit, menyamakan skor menjadi 1-1 menjelang akhir babak pertama.\r\n\r\nPada babak kedua, pertandingan semakin memanas. Gairah dan semangat para pemain terlihat dari setiap aksi di lapangan. Kapten tim, Budi Utomo, memberikan kontribusi besar dengan mencetak gol melalui tendangan bebas yang indah. Skor menjadi 2-1 untuk tim tuan rumah.', '2023-12-28', 3, 'VISIBLE'),
(5, 'Ekonomi Indonesia dan Malaysia 2024', 'ECONOMY', 'filtered.jpg', 'Indonesia memasuki fase persiapan intensif menjelang Pemilihan Umum (Pemilu) 2024, dengan dinamika politik yang semakin meningkat. Masyarakat dan kandidat politik tengah mempersiapkan diri untuk menghadapi proses demokrasi yang diharapkan menjadi cermin keinginan dan aspirasi rakyat.\r\n\r\nSejumlah partai politik telah memulai langkah-langkah strategis mereka, baik dalam merumuskan platform politik maupun menggalang dukungan publik. Kandidat potensial untuk berbagai posisi mulai bermunculan, menggambarkan keberagaman pemimpin yang akan bersaing dalam kontes demokrasi mendatang.\r\n\r\nDi tengah persaingan yang semakin ketat, tema-tema sentral seperti ekonomi, pendidikan, lingkungan, dan kesehatan menjadi fokus perdebatan dan presentasi visi dari para kandidat. Elektabilitas, rekam jejak, dan program kerja menjadi pertimbangan utama bagi pemilih yang semakin cerdas dan kritis.', '2024-01-01', 5, 'VISIBLE');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('ADMIN','USER') NOT NULL,
  `profile` varchar(255) NOT NULL,
  `status` enum('ACTIVE','WAITING') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `profile`, `status`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$LrYgtogFQx7FhlTmA76kn.6kHy76zSAB9qR9RnVvrUKj5398TQhMO', 'ADMIN', 'type.png', 'ACTIVE'),
(2, 'User', 'user@example.com', '$2y$10$Qbh6X5dpwgq1RRUhUCsCMeXW9s5j0vbvPHLxvV6eVx3a3lkZtyi/m', 'USER', 'sql-injection-attack.jpg', 'ACTIVE'),
(3, 'dom', 'dom@gmail.com', '$2y$10$/QVy0zIV5SFmezbHLYxz1O2TYcGkECEcEeC7VUPduhv5ItvsE57vK', 'USER', 'University _ COVER YOUTUBE PMC.png', 'ACTIVE'),
(4, 'nanda', 'nanda@gmail.com', '$2y$10$mxY4Hofn8gMM3SHD3sM/Deooec2SFY2NxBfRm3aI9vIORHbgruf4W', 'USER', 'sql-injection-attack.jpg', 'ACTIVE'),
(5, 'bhisma', 'bhisma@gmail.com', '$2y$10$xkeb2MJN1GBsQFwHfcc3quMHO4KB5NjdrLSH1I5KZ0uPtKBK22cgq', 'USER', '', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_ibfk_1` (`authorID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`authorID`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
