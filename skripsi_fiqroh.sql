-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 27 Jul 2020 pada 08.33
-- Versi Server: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_fiqroh`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat_pengambilan`
--

CREATE TABLE `alamat_pengambilan` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `nama_barang` varchar(225) NOT NULL,
  `alamat` text NOT NULL,
  `status` int(11) NOT NULL,
  `langtitude` varchar(225) NOT NULL,
  `longtitiud` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alamat_pengambilan`
--

INSERT INTO `alamat_pengambilan` (`id`, `nama`, `nama_barang`, `alamat`, `status`, `langtitude`, `longtitiud`) VALUES
(20, 'test', '', 'test', 1, '-6.536344127907798', '106.57179409647122'),
(21, 'cbd', 'cbd', 'cbd', 1, '-6.223113476221565', '106.70900502671168'),
(22, 'tedi', 'tedi', 'test', 1, '-6.222726039488582', '106.78523356104031');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `hasil` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id`, `hasil`, `user_id`) VALUES
(72, '[{\"jalur\":\"1,20,21\",\"jarak\":167363,\"next\":[{\"jalur\":\"1,20,21,22\",\"jarak\":177594,\"next\":null}]},{\"jalur\":\"1,20,22\",\"jarak\":160008,\"next\":[{\"jalur\":\"1,20,22,21\",\"jarak\":170910,\"next\":null}]}]', 1),
(73, '[{\"jalur\":\"1,20,21,22\",\"jarak\":177594,\"next\":null}]', 1),
(74, '[{\"jalur\":\"1,20,22,21\",\"jarak\":170910,\"next\":null}]', 1),
(75, '[{\"jalur\":\"1,21,20\",\"jarak\":76811,\"next\":[{\"jalur\":\"1,21,20,22\",\"jarak\":164353,\"next\":null}]},{\"jalur\":\"1,21,22\",\"jarak\":14783,\"next\":[{\"jalur\":\"1,21,22,20\",\"jarak\":104311,\"next\":null}]}]', 1),
(76, '[{\"jalur\":\"1,21,20,22\",\"jarak\":164353,\"next\":null}]', 1),
(77, '[{\"jalur\":\"1,21,22,20\",\"jarak\":104311,\"next\":null}]', 1),
(78, '[{\"jalur\":\"1,22,20\",\"jarak\":106089,\"next\":[{\"jalur\":\"1,22,20,21\",\"jarak\":200986,\"next\":null}]},{\"jalur\":\"1,22,21\",\"jarak\":27463,\"next\":[{\"jalur\":\"1,22,21,20\",\"jarak\":99722,\"next\":null}]}]', 1),
(79, '[{\"jalur\":\"1,22,20,21\",\"jarak\":200986,\"next\":null}]', 1),
(80, '[{\"jalur\":\"1,22,21,20\",\"jarak\":99722,\"next\":null}]', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pick_up`
--

CREATE TABLE `pick_up` (
  `pick_up_id` int(11) NOT NULL,
  `id_pengambilan` int(11) NOT NULL,
  `kurir` int(11) NOT NULL,
  `titik_awal` int(11) NOT NULL,
  `titik_akhir` int(11) NOT NULL,
  `jarak` bigint(11) NOT NULL,
  `jalur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pick_up`
--

INSERT INTO `pick_up` (`pick_up_id`, `id_pengambilan`, `kurir`, `titik_awal`, `titik_akhir`, `jarak`, `jalur`) VALUES
(431, 1, 1, 1, 1, 0, 0),
(432, 20, 1, 1, 20, 72466, 0),
(433, 20, 1, 20, 20, 0, 0),
(434, 21, 1, 20, 21, 94897, 0),
(435, 22, 1, 20, 22, 87542, 0),
(436, 22, 1, 20, 1, 73112, 0),
(437, 21, 1, 1, 21, 4552, 1),
(438, 20, 1, 21, 20, 72259, 0),
(439, 21, 1, 21, 21, 0, 0),
(440, 22, 1, 21, 22, 10231, 0),
(441, 22, 1, 21, 1, 5362, 0),
(442, 22, 1, 1, 22, 16561, 2),
(443, 20, 1, 22, 20, 89528, 0),
(444, 21, 1, 22, 21, 10902, 0),
(445, 22, 1, 22, 22, 0, 0),
(446, 22, 1, 22, 1, 15588, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `hak_akses` int(11) NOT NULL COMMENT '0=user , 1=driver, 2=admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `hak_akses`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 3),
(2, 'driver', 'e2d45d57c7e2941b65c6ccd64af4223e', 1),
(3, 'amil', '5ba6a6bf3ffda3d2c1a308dbe9d3b986', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_detail`
--

CREATE TABLE `user_detail` (
  `user_deetail_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(225) NOT NULL,
  `address` text NOT NULL,
  `no_hp` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_detail`
--

INSERT INTO `user_detail` (`user_deetail_id`, `user_id`, `fullname`, `address`, `no_hp`) VALUES
(1, 1, 'admin', 'neroktog', '082125555031');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat_pengambilan`
--
ALTER TABLE `alamat_pengambilan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pick_up`
--
ALTER TABLE `pick_up`
  ADD PRIMARY KEY (`pick_up_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`user_deetail_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamat_pengambilan`
--
ALTER TABLE `alamat_pengambilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `pick_up`
--
ALTER TABLE `pick_up`
  MODIFY `pick_up_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `user_deetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
