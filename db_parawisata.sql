-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2022 at 07:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_parawisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_handphone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `alamat`, `no_handphone`, `password`) VALUES
(4, 'Admin', 'Makassar', '08654365465', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bukti_pembayaran`
--

CREATE TABLE `tb_bukti_pembayaran` (
  `id_bukti_pembayaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_parawista` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_coment`
--

CREATE TABLE `tb_coment` (
  `id_coment` int(11) NOT NULL,
  `id_parawisata` int(11) NOT NULL,
  `coment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_coment`
--

INSERT INTO `tb_coment` (`id_coment`, `id_parawisata`, `coment`) VALUES
(4, 8, 'Keren Sekali'),
(19, 8, 'Keren Cokk'),
(20, 9, 'Tempatnya Menyenangkan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_parawisata`
--

CREATE TABLE `tb_parawisata` (
  `id_parawisata` int(11) NOT NULL,
  `nama_parawisata` varchar(100) NOT NULL,
  `tempat_parawisata` varchar(200) NOT NULL,
  `tentang` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_parawisata`
--

INSERT INTO `tb_parawisata` (`id_parawisata`, `nama_parawisata`, `tempat_parawisata`, `tentang`, `gambar`, `harga`) VALUES
(8, 'Central Point of Indonesia (CPI)', 'Kota Makassar', 'Pembangunan proyek Central Point of Indonesia (CPI) dilihat dari Pantai Losari, Makassar, Selasa, 20 Oktober 2015. Kawasan dengan luas total 600 hektar ini direncanakan akan dibangun pusat bisnis dan pemerintahan, kawasan hiburan, hotel hotel kelas dunia yang dilengkapi dengan lapangan golf dengan view ke laut lepas. TEMPO/Iqbal Lubis', 'produk1654023914.jpg', '250000'),
(9, 'Permandian Topejawa', 'Kabupaten Takalar', 'Liburan bersama keluarga memang yang paling menyenangkan. Mengunjungi suatu destinasi dengan melakukan banyak aktivitas pasti akan membuat momen berharga tak terlupakan. Sulawesi Selatan miliki destinasi wisata yang sangat cocok untuk menghabiskan waktu liburan bersama keluarga yakni Pantai Topejawa Takalar. Biasanya pada weekend dan libur panjang, pantai yang dikombinasikan dengan wisata modern ini penuh sesak oleh wisatawan lokal maupun dari luar daerah.\r\n\r\nTidak hanya memiliki panorama pantai yang menawan, di Topejawa Takalar juga ada beach waterboom yang dibuat menghadap ke pantai. Anda pun bisa berenang sambil memanjakan mata dengan birunya lautan. Bahkan ada pula seluncuran besar yang semakin menambah asyik aktivitas berenang bersama keluarga atau orang terdekat. Nah, bagi Anda yang belum memiliki rencana liburan bisa simak ulasan berikut untuk jadi inspirasi.', 'produk1654024441.png', '200000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_parawisata` int(11) NOT NULL,
  `nilai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id_penilaian`, `id_parawisata`, `nilai`) VALUES
(3, 9, '90'),
(8, 9, '30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_parawisata` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_pesan` int(20) NOT NULL,
  `tanggal_pesanan` date NOT NULL,
  `total_harga` int(20) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id_pesanan`, `id_parawisata`, `id_user`, `jumlah_pesan`, `tanggal_pesanan`, `total_harga`, `status`) VALUES
(9, 8, 1, 2, '2022-06-19', 500000, '1'),
(10, 9, 1, 1, '2022-06-19', 200000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_handphone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `alamat`, `no_handphone`, `password`) VALUES
(1, 'Panglima', 'Makassar', '085444343987', 'panglima');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_bukti_pembayaran`
--
ALTER TABLE `tb_bukti_pembayaran`
  ADD PRIMARY KEY (`id_bukti_pembayaran`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_parawista` (`id_parawista`);

--
-- Indexes for table `tb_coment`
--
ALTER TABLE `tb_coment`
  ADD PRIMARY KEY (`id_coment`),
  ADD KEY `id_parawisata` (`id_parawisata`);

--
-- Indexes for table `tb_parawisata`
--
ALTER TABLE `tb_parawisata`
  ADD PRIMARY KEY (`id_parawisata`);

--
-- Indexes for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_parawisata` (`id_parawisata`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_parawisata` (`id_parawisata`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_bukti_pembayaran`
--
ALTER TABLE `tb_bukti_pembayaran`
  MODIFY `id_bukti_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_coment`
--
ALTER TABLE `tb_coment`
  MODIFY `id_coment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_parawisata`
--
ALTER TABLE `tb_parawisata`
  MODIFY `id_parawisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_bukti_pembayaran`
--
ALTER TABLE `tb_bukti_pembayaran`
  ADD CONSTRAINT `tb_bukti_pembayaran_ibfk_1` FOREIGN KEY (`id_parawista`) REFERENCES `tb_parawisata` (`id_parawisata`),
  ADD CONSTRAINT `tb_bukti_pembayaran_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_coment`
--
ALTER TABLE `tb_coment`
  ADD CONSTRAINT `tb_coment_ibfk_1` FOREIGN KEY (`id_parawisata`) REFERENCES `tb_parawisata` (`id_parawisata`);

--
-- Constraints for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD CONSTRAINT `tb_penilaian_ibfk_1` FOREIGN KEY (`id_parawisata`) REFERENCES `tb_parawisata` (`id_parawisata`);

--
-- Constraints for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD CONSTRAINT `tb_pesanan_ibfk_1` FOREIGN KEY (`id_parawisata`) REFERENCES `tb_parawisata` (`id_parawisata`),
  ADD CONSTRAINT `tb_pesanan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
