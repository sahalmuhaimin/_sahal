-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 07:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gunajaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan_token`
--

CREATE TABLE `pelanggan_token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan_token`
--

INSERT INTO `pelanggan_token` (`id`, `email`, `token`, `date_created`) VALUES
(18, 'kasir@gmail.com', 'oJRDUypwlDgI4KNdB9QFhMLVZWohuZQiN9tUwVXTgBo=', 1750205159),
(19, 'regiworkofficial@gmail.com', 'tBFtYX5pybcLdnRm9hKFxFUlVVP7uStwDgS6iTr3a+E=', 1750205537);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `berat` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `id_kategori`, `harga`, `deskripsi`, `gambar`, `berat`, `stok`) VALUES
(11, 'Banner', 12, 18000, 'Banner biasa ukuran 3 m x 2 m `', 'banner1.jpg', 2300, 15),
(12, 'Brosur A4', 9, 125000, 'Brosur dengan ukuran kertas A4\r\nmacam 1/3 dengan 2 sisi\r\nharga per 1000 lembar (2 rim)', 'brosur_5_prev_ui.png', 9000, 500),
(13, 'Brosur Folio ', 9, 150000, 'Brosur F4 (Folio)\r\nDicetak 2 sisi (Double Sided)\r\nHarga per 1000 lembar', 'brosur1.jpg', 9000, 88),
(14, 'Kalender Dinding', 14, 12000, 'Kalender gantung tahunan\r\n', 'pixlr-bg-result(4).png', 200, 90),
(15, 'Kalender Duduk', 14, 40000, 'Kalender Duduk\r\nHarga per biji', 'kalender_duduk_3.jpg', 310, 20),
(16, 'Buku', 9, 500, 'Untuk pencetakan custom dapat menghubungi admin :\r\n1. pilih jenis kertas (hvs ato book paper)\r\n2. pilih metode cetak (bolak balik ato 1 muka) dan\r\n3. pilih ukuran kertasnya\r\nNB : Harga per halaman\r\n\r\n\r\n', 'pixlr-bg-result(3).png', 250, 20),
(17, 'Id Card', 12, 14750, 'Id Card berbahan plastik\r\nukuran 5,2 cm x 8 cm\r\nHarga per biji\r\n', 'pixlr-bg-result(2).png', 40, 70),
(18, 'Map Plastik', 10, 20000, '- Map Plastik\r\n- Ukuran F4 (Folio)\r\n- Untuk sampul Ijazah / Rapot\r\n\r\nNB : Desain dan warna map menghubungi Admin', 'pixlr-bg-result1.png', 200, 500),
(19, 'Map Kertas', 10, 5000, 'Map Kertas Tebal\r\nUkuran F4 (Folio)\r\nHarga Per Biji', 'pixlr-bg-result(1)1.png', 10, 500),
(20, 'Kotak Kemasan', 9, 630, 'Kotak Kemasan\r\nKertas duplex 250 gram\r\nUkuran 6,3 cm x 6,3 cm\r\nTebal = 1 cm\r\nHarga per biji', 'kotak_kemasan_2.jpg', 18, 99),
(21, 'Nota Rangkep 3', 9, 52925, 'Nota Rangkep 3\r\nUkuran F4 (Folio)\r\nNB : Harga per bundle, 1 bundle isi 50', 'nota1.jpg', 210, 45),
(22, 'Buku Yasin', 9, 7800, 'Buku Yasin\r\nCover AP (Art Paper) 260\r\nIsi 128 halaman\r\nHarga per buku', 'buku_yasin.jpg', 150, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gambar`
--

CREATE TABLE `tbl_gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gambar`
--

INSERT INTO `tbl_gambar` (`id_gambar`, `id_barang`, `ket`, `gambar`) VALUES
(10, 3, 'Plastik 2', 'plastik_beras_sablon_2.jpg'),
(11, 11, 'Banner biasa', 'banner_2.jpg'),
(12, 12, 'Brosur A4', 'brosur_6.jpg'),
(13, 12, 'Brosur A4 (2)', 'brosur_4.jpg'),
(14, 13, 'Brosur F4', 'brosur_2.jpg'),
(15, 13, 'Brosur F4 (2)', 'brosur_3.jpg'),
(16, 14, 'Kalender Gantung', 'kalender_gantung_2.jpg'),
(17, 15, 'Kalender Duduk', 'kalender_duduk_4.jpg'),
(18, 15, 'Kalender Duduk (2)', 'kalender_duduk.jpg'),
(19, 19, 'Map kertas ', 'map_4.jpg'),
(20, 19, 'Map kertas (2)', 'map_8.jpg'),
(21, 18, 'Map plastik', 'map_6.jpg'),
(22, 18, 'Map plastik (2)', 'map_7.jpg'),
(23, 17, 'Id card', 'id_card_2.jpg'),
(24, 16, 'Buku', 'buku.jpg'),
(25, 16, 'Buku (2)', 'buku_3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(9, 'Kertas'),
(10, 'Map'),
(11, 'Sablon'),
(12, 'Printing'),
(13, 'Undangan'),
(14, 'Kalender');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_hp` varchar(30) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email`, `password`, `no_hp`, `is_active`, `date_created`, `image`) VALUES
(1, 'Agna Rizky', 'putraodin21@gmail.com', 'agnarizky', '+6285334575065', 1, 0, 'agna.jpg'),
(5, 'Dian', 'agnarizky88@gmail.com', 'agnarizky1', '+6285755346418', 1, 1651170603, 'default.png'),
(10, 'Haica', 'ivalativa82@gmail.com', 'ivaagna', '+6285967209564', 1, 1653998968, 'default.png'),
(11, 'Mas ik', 'agnarizky69@gmail.com', 'agnarizky', '+621259557129', 1, 1654007197, 'default.png'),
(14, 'aca', 'atikaprint121@gmail.com', 'haicacantik', '+6285967209564', 1, 1655038693, 'default.png'),
(15, 'Agna', 'putraodin2@gmail.com', '12345', '+6281259557129', 1, 1655698806, 'default.png'),
(21, 'coba', 'kasir@gmail.com', 'password123', '+6285721819759', 0, 1750205159, 'default.png'),
(22, 'coba', 'regiworkofficial@gmail.com', 'password123', '+6285721819759', 0, 1750205537, 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekening`
--

CREATE TABLE `tbl_rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rekening`
--

INSERT INTO `tbl_rekening` (`id_rekening`, `nama_bank`, `no_rek`, `atas_nama`) VALUES
(3, 'BCA', '003017528', 'Gunaryono');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_retur`
--

CREATE TABLE `tbl_retur` (
  `id_retur` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `alasan` text NOT NULL,
  `bukti_retur` varchar(255) DEFAULT NULL,
  `tgl_retur` datetime DEFAULT NULL,
  `proses_retur` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rinci_transaksi`
--

CREATE TABLE `tbl_rinci_transaksi` (
  `id_rinci` int(11) NOT NULL,
  `no_order` varchar(100) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rinci_transaksi`
--

INSERT INTO `tbl_rinci_transaksi` (`id_rinci`, `no_order`, `id_barang`, `qty`) VALUES
(2, '20220328OR8FMTB7', 6, 1),
(3, '20220328OR8FMTB7', 4, 1),
(4, '20220328OR8FMTB7', 7, 1),
(5, '20220411HBYVUFOF', 10, 1),
(6, '20220411HBYVUFOF', 9, 1),
(7, '20220411HBYVUFOF', 8, 1),
(8, '20220413LQHGFSBW', 9, 1),
(9, '20220413LQHGFSBW', 8, 1),
(10, '20220414JJAMLHFQ', 3, 1),
(11, '20220414JJAMLHFQ', 6, 1),
(12, '20220414JJAMLHFQ', 7, 1),
(13, '20220414OHCUMY5V', 6, 2),
(14, '20220414OHCUMY5V', 10, 1),
(15, '20220414OHCUMY5V', 8, 3),
(16, '20220523DJXILBIH', 7, 1),
(17, '20220523DJXILBIH', 6, 1),
(18, '20220523DJXILBIH', 8, 3),
(19, '20220523JKPY1KP4', 9, 1),
(20, '20220523V5EW4PGP', 8, 1),
(21, '20220524ZFKEODB0', 8, 1),
(22, '20220524ZFKEODB0', 10, 1),
(23, '20220528KBBXSJAS', 10, 1),
(24, '20220529D2UGMON6', 9, 1),
(25, '2022053162GCEHQN', 8, 1),
(26, '2022053162GCEHQN', 9, 1),
(27, '20220531FDCBUWWL', 8, 1),
(28, '20220606WBFZZLQW', 15, 1),
(29, '20220607X5PMLFC6', 21, 1),
(30, '20220612ARNICSHK', 20, 10),
(31, '20220613SZ5GGQV0', 21, 1),
(32, '202206202JLDD68G', 21, 5),
(33, '202206202JLDD68G', 20, 1),
(34, '202406065Z0AIQDX', 22, 2),
(35, '20240607VV9G8RQL', 22, 4),
(36, '20240607VV9G8RQL', 21, 2),
(37, '20240607I8Q4ELWT', 20, 5),
(38, '20240607I8Q4ELWT', 11, 9),
(39, '20250617FFDA51LZ', 22, 1),
(40, '20250617QXJOX4P3', 21, 1),
(41, '20250617VSOGVLC6', 20, 1),
(42, '20250617IPJZX6NB', 22, 1),
(43, '20250617IPJZX6NB', 21, 1),
(44, '20250617OM2P5PQZ', 22, 1),
(45, '20250617CAXCJ5WZ', 21, 1),
(46, '20250617QRYEHMBS', 21, 1),
(47, '20250618SBZNGI03', 22, 1),
(48, '20250619YSQBARGP', 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(1) NOT NULL,
  `nama_toko` varchar(255) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `alamat_toko` text DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `nama_toko`, `lokasi`, `alamat_toko`, `no_telepon`) VALUES
(1, 'Toko Kasep_Code Olshop', '152', 'Senen Jaya Blok IV Lt.1 C6 No.7-8, Jakarta Pusat', '082260686031');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `no_order` varchar(100) NOT NULL,
  `tgl_order` date DEFAULT NULL,
  `nama_penerima` varchar(255) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(100) DEFAULT NULL,
  `ekspedisi` varchar(255) DEFAULT NULL,
  `paket` varchar(255) DEFAULT NULL,
  `estimasi` varchar(255) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `metode_bayar` varchar(20) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `status_bayar` int(11) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `atas_nama` varchar(255) DEFAULT NULL,
  `nama_bank` varchar(255) DEFAULT NULL,
  `no_rek` varchar(255) DEFAULT NULL,
  `no_hp` varchar(30) DEFAULT NULL,
  `status_order` int(11) DEFAULT NULL,
  `no_resi` varchar(255) DEFAULT NULL,
  `bukti_kirim` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_pelanggan`, `no_order`, `tgl_order`, `nama_penerima`, `provinsi`, `kota`, `alamat`, `kode_pos`, `ekspedisi`, `paket`, `estimasi`, `ongkir`, `berat`, `grand_total`, `total_bayar`, `metode_bayar`, `catatan`, `status_bayar`, `bukti_bayar`, `atas_nama`, `nama_bank`, `no_rek`, `no_hp`, `status_order`, `no_resi`, `bukti_kirim`) VALUES
(3, 1, '20220328OR8FMTB7', '2022-03-28', 'Mas Ok', '11', 'Banyuwangi', 'Genteng', '68465', 'jne', 'REG', '2-3 Hari', 6000, 1300, 17500, 23500, NULL, NULL, 1, 'IMG_20190704_202954.jpg', 'Mas ik', 'BRI', '1123-4568-12390', '+6285334575065', 3, 'JBR081239957', 'Foto_2_-_Poster_Internship_Gradify4.png'),
(4, 2, '20220411HBYVUFOF', '2022-04-11', 'Siti Latifatul', '11', 'Malang', 'Malang Lawang', '64123', 'jne', 'OKE', '2-3 Hari', 14000, 2100, 182500, 196500, NULL, NULL, 0, NULL, NULL, NULL, NULL, '+6285967209564', 0, NULL, NULL),
(5, 2, '20220413LQHGFSBW', '2022-04-13', 'Siti Latifatul', '11', 'Jember', 'Jember Tumpeng', '68123', 'tiki', 'ECO', '4 Hari', 5000, 1100, 82500, 87500, NULL, NULL, 1, 'agna.jpg', 'Siti Latifatul', 'Mandiri', '1234-5678-90123', '+6285967209564', 1, NULL, NULL),
(6, 1, '20220414JJAMLHFQ', '2022-04-14', 'Agna', '11', 'Surabaya', 'Sidoarjo', '68721', 'pos', 'Paket Kilat Khusus', '2 HARI Hari', 15200, 1300, 14000, 29200, NULL, NULL, 1, 'IMG_20190704_203623.jpg', 'Mas ik', 'BRI', '1123-4568-12390', '+6285334575065', 3, 'BAC093193190', NULL),
(7, 1, '20220414OHCUMY5V', '2022-04-14', 'Mas ik', '11', 'Bondowoso', 'Bondowoso', '68122', 'jne', 'REG', '2-3 Hari', 36000, 6000, 335000, 371000, NULL, NULL, 1, 'IMG_20190704_202216.jpg', 'Agna Rizky', 'BRI', '1239-1234-5543', '+6285334575065', 3, 'JBR081239957', NULL),
(10, 7, '20220523V5EW4PGP', '2022-05-23', 'Asa Brilian', '2', 'Bangka', 'Bangka Belitung', '12321', 'jne', 'OKE', '3-6 Hari', 45000, 1000, 75000, 120000, NULL, NULL, 0, NULL, NULL, NULL, NULL, '+6288803878843', 0, NULL, NULL),
(11, 8, '20220524ZFKEODB0', '2022-05-24', 'agna', '1', 'Badung', 'bali', '321123', 'jne', 'REG', '2-3 Hari', 36000, 2000, 175000, 211000, NULL, NULL, 1, 'admin.png', 'agna', 'BRi', '21312312313', '+6285337860853', 1, NULL, NULL),
(12, 7, '20220528KBBXSJAS', '2022-05-28', 'Agna', '1', 'Badung', 'Badung', '68122', 'jne', 'OKE', '3-6 Hari', 16000, 1000, 100000, 116000, NULL, NULL, 1, 'Capture.PNG', 'Asa', 'Mandiri', '111111111111', '+6288803878843', 1, NULL, NULL),
(13, 7, '20220529D2UGMON6', '2022-05-29', 'Asa', '8', 'Muaro Jambi', 'Jambi', '68122', 'jne', 'OKE', '3-6 Hari', 43000, 100, 7500, 50500, NULL, NULL, 1, 'Capture1.PNG', 'Asa', 'Mandiri', '222222222', '+6288803878843', 1, NULL, NULL),
(14, 1, '2022053162GCEHQN', '2022-05-31', 'Agna', '11', 'Jember', 'Jember', '68122', 'pos', 'Pos Instan Barang', '0 HARI Hari', 12000, 1100, 82500, 94500, NULL, NULL, 1, 'IMG_20201211_225522_507.jpg', 'Agna', 'Mandiri', '1111111111111111', '+6285334575065', 3, 'JBR081239957', 'PROPOSAL_PENGAJUAN_INVESTASI_PARCHEZZI_TECH_22.jpg'),
(15, 10, '20220531FDCBUWWL', '2022-05-31', 'Haica', '11', 'Jember', 'Jalan Basuki Rahmat Gang 7 Tumpengsari, Tegal Besar, Jember', '68132', 'jne', 'CTC', '1-2 Hari', 6000, 1000, 75000, 81000, NULL, NULL, 1, 'IMG_20210215_190215_732.jpg', 'Bebek', 'BRI', '1111111111111111', '+6285967209564', 2, 'JBR081239957', NULL),
(17, 11, '20220607X5PMLFC6', '2022-06-07', 'Agna', '11', 'Jember', 'Jember', '68121', 'tiki', 'ECO', '4 Hari', 5000, 210, 52925, 57925, NULL, NULL, 0, NULL, NULL, NULL, NULL, '+621259557129', 0, NULL, NULL),
(18, 14, '20220612ARNICSHK', '2022-06-12', 'Aca', '11', 'Malang', 'Kepanjen', '65163', 'jne', 'REG', '1-2 Hari', 8000, 180, 6300, 14300, NULL, NULL, 1, 'WhatsApp_Image_2022-06-12_at_20_21_02.jpeg', 'Siti Latifatul Munawaroh', 'Dana', '0', '+6285967209564', 3, 'ABK2211356', NULL),
(19, 10, '20220613SZ5GGQV0', '2022-06-13', 'Agna', '11', 'Jember', 'Jember', '68122', 'jne', 'CTC', '1-2 Hari', 6000, 210, 52925, 58925, NULL, NULL, 0, NULL, NULL, NULL, NULL, '+6285967209564', 0, NULL, NULL),
(20, 15, '202206202JLDD68G', '2022-06-20', 'Agna', '11', 'Jember', 'Kebonsari', '68122', 'jne', 'CTC', '1-2 Hari', 6000, 1068, 265255, 271255, NULL, NULL, 1, '231287506p.jpg', 'Agna Rizky', 'Dana', '12345678', '+6281259557129', 3, 'ABK2211356', NULL),
(24, 1, '20250617FFDA51LZ', '2025-06-17', 'Ujang', '9', 'Bandung', 'Jl Paskal Bandung', '12983', 'jne', 'REG', '1-2 Hari', 21000, 150, 7800, 28800, NULL, NULL, 1, 'Foto_2_-_Poster_Internship_Gradify.png', 'ujang', 'Mandiri', '1130-0171-82084', '+6285334575065', 3, 'JBR081239957', NULL),
(25, 1, '20250617QXJOX4P3', '2025-06-17', 'Firman', '9', 'Bandung', 'Jl Bandung', '18312', 'tiki', 'DAT', '4 Hari', 22000, 210, 52925, 74925, NULL, NULL, 1, 'PROPOSAL_PENGAJUAN_INVESTASI_PARCHEZZI_TECH_2.jpg', 'ujang', 'Mandiri', '102381232', '+6285334575065', 3, 'JBR081239957', 'Foto_2_-_Poster_Internship_Gradify2.png'),
(26, 1, '20250617VSOGVLC6', '2025-06-17', 'Fahmi', '9', 'Bandung', 'Jalan Garut', '12039', 'jne', 'JTR', '5-6 Hari', 80000, 18, 630, 80630, 'COD', 'a', 1, NULL, NULL, NULL, NULL, NULL, 3, 'JBR081239957', 'Foto_2_-_Poster_Internship_Gradify1.png'),
(27, 1, '20250617IPJZX6NB', '2025-06-17', 'Farhut', '9', 'Bandung', 'Jl Andir Rt06/Rw10', '887123', 'jne', 'JTR', '5-6 Hari', 80000, 360, 60725, 140725, 'COD', 'a', 1, NULL, NULL, NULL, NULL, '+6285334575065', 3, 'JBR081239957', NULL),
(28, 1, '20250617OM2P5PQZ', '2025-06-17', '86nce5v768', '9', 'Bandung', 'Jl. Bandung Selatan', '123123', 'jne', 'JTR', '5-6 Hari', 80000, 150, 7800, 87800, 'COD', 'a', 1, NULL, NULL, NULL, NULL, '+6285334575065', 3, 'JBR081239957', 'Foto_2_-_Poster_Internship_Gradify.png'),
(29, 1, '20250617CAXCJ5WZ', '2025-06-17', '86nce5v768', '1', 'Badung', 'asd', '23132', 'jne', 'JTR', '5-6 Hari', 75000, 210, 52925, 127925, 'COD', 'a', 1, NULL, NULL, NULL, NULL, '+6285334575065', 3, 'JBR081239957', 'PROPOSAL_PENGAJUAN_INVESTASI_PARCHEZZI_TECH_2.jpg'),
(30, 1, '20250617QRYEHMBS', '2025-06-17', 'asdasd', '9', 'Bandung', 'aasdasd', 'asdasd', 'jne', 'JTR', '5-6 Hari', 80000, 210, 52925, 132925, 'COD', 'a', 1, NULL, NULL, NULL, NULL, '+6285334575065', 3, 'JBR081239957', 'Foto_2_-_Poster_Internship_Gradify3.png'),
(31, 1, '20250618SBZNGI03', '2025-06-18', 'asdasd', '1', 'Bangli', 'ada', 'asdasd', 'jne', 'JTR', '5-6 Hari', 75000, 150, 7800, 82800, 'COD', 'asdad', 1, NULL, NULL, NULL, NULL, '+6285334575065', 3, 'JBR081239957', 'PROPOSAL_PENGAJUAN_INVESTASI_PARCHEZZI_TECH_23.jpg'),
(32, 5, '20250619YSQBARGP', '2025-06-19', 'asdasd', '9', 'Bandung', 'asdas', '13123', 'jne', 'REG', '1-2 Hari', 12000, 210, 52925, 64925, NULL, NULL, 0, NULL, NULL, NULL, NULL, '+6285755346418', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `level_user` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `username`, `password`, `level_user`) VALUES
(1, 'Admin', 'admin', 'admin', 1),
(3, 'Dian', 'user', 'user', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `id_pelanggan`, `id_barang`) VALUES
(1, 10, 22),
(2, 10, 22),
(3, 10, 21),
(4, 16, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelanggan_token`
--
ALTER TABLE `pelanggan_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_gambar`
--
ALTER TABLE `tbl_gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tbl_rekening`
--
ALTER TABLE `tbl_rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `tbl_retur`
--
ALTER TABLE `tbl_retur`
  ADD PRIMARY KEY (`id_retur`);

--
-- Indexes for table `tbl_rinci_transaksi`
--
ALTER TABLE `tbl_rinci_transaksi`
  ADD PRIMARY KEY (`id_rinci`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan_token`
--
ALTER TABLE `pelanggan_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_gambar`
--
ALTER TABLE `tbl_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_rekening`
--
ALTER TABLE `tbl_rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_retur`
--
ALTER TABLE `tbl_retur`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_rinci_transaksi`
--
ALTER TABLE `tbl_rinci_transaksi`
  MODIFY `id_rinci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
