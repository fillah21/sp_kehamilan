-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2024 pada 10.07
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
-- Database: `kehamilan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `idgejala` int(11) NOT NULL,
  `kode_gejala` varchar(45) NOT NULL,
  `nama_gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`idgejala`, `kode_gejala`, `nama_gejala`) VALUES
(1, 'G1', 'Pusing'),
(2, 'G2', 'Nyeri perut bagian bawah'),
(3, 'G3', 'Nyeri ulu hati'),
(4, 'G4', 'Kejang'),
(5, 'G5', 'Tekanan darah &gt;= 160/110 mmHg'),
(6, 'G6', 'Proteinuria lebih dari 3g/liter'),
(7, 'G7', 'Usia hamil 7 bulan/lebih'),
(8, 'G8', 'Mual'),
(9, 'G9', 'Muntah'),
(10, 'G10', 'Nyeri hebat tiba-tiba'),
(11, 'G11', 'Kesulitan konsentrasi'),
(12, 'G12', 'Mudah lelah'),
(13, 'G13', 'Nafsu makan berkurang'),
(14, 'G14', 'Penurunan berat badan'),
(15, 'G15', 'Kontraksi dari Rahim'),
(16, 'G16', 'Pingsan'),
(17, 'G17', 'Flek atau pendarahan berwarna cokelat dan bergelembung seperti busa'),
(18, 'G18', 'Nyeri pada tulang panggul'),
(19, 'G19', 'Produksi urin sedikit'),
(20, 'G20', 'Lemas dan lesu'),
(21, 'G21', 'Pucat'),
(22, 'G22', 'Sesak nafas'),
(23, 'G23', 'Tidak ada tanda-tandanya janin'),
(24, 'G24', 'Sakit kepala'),
(25, 'G25', 'Detak jantung tidak teratur'),
(28, 'G26', 'gumoh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `idhasil` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `usia_kandungan` int(30) NOT NULL,
  `preeklampsia` double DEFAULT 0,
  `kehamilan_etopik` double DEFAULT 0,
  `hiperemesis_gravidarum` double DEFAULT 0,
  `mola_hidatidosa` double DEFAULT 0,
  `anemia` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`idhasil`, `iduser`, `tanggal`, `usia_kandungan`, `preeklampsia`, `kehamilan_etopik`, `hiperemesis_gravidarum`, `mola_hidatidosa`, `anemia`) VALUES
(1, 1, '2024-01-08 13:40:02', 0, 0.45, 0.8, 0.72, 0.59, 0.68),
(2, 1, '2024-01-08 14:16:44', 5, 0.45, 0.52, 0.54, 0.54, 0.5),
(3, 2, '2024-01-08 15:38:23', 8, 0.5, 0.67, 0.62, 0.75, 0.61),
(4, 4, '2024-01-09 11:57:54', 4, 0.5, 0, 0.69, 0, 0.66),
(5, 3, '2024-01-13 04:00:55', 0, 0.5, 0.52, 0.7, 0, 0.5),
(6, 2, '2024-01-13 04:07:28', 7, 0.5, 0, 0.5, 0.59, 0),
(7, 3, '2024-01-13 07:08:56', 8, 0.5, 0.8, 0.8, 0.75, 0.8),
(8, 3, '2024-01-13 07:09:19', 9, 0.5, 0.8, 0.8, 0.66, 0),
(9, 1, '2024-01-13 07:10:14', 8, 0, 0, 0.8, 0.36, 0.71),
(10, 1, '2024-01-13 07:11:15', 8, 0, 0.8, 0.73, 0.8, 0.5),
(11, 1, '2024-01-13 07:12:11', 7, 0.43, 0.6, 0.68, 0, 0.3),
(12, 4, '2024-01-13 07:17:27', 7, 0.5, 0, 0.8, 0.4, 0),
(13, 4, '2024-01-13 07:18:18', 8, 0.5, 0, 0.63, 0, 0.6),
(14, 3, '2024-01-13 07:22:03', 8, 0.45, 0.4, 0.3, 0, 0.5),
(15, 4, '2024-01-13 07:38:08', 4, 0.5, 0, 0.61, 0.59, 0.57);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `idpenyakit` int(11) NOT NULL,
  `kode_penyakit` varchar(45) NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`idpenyakit`, `kode_penyakit`, `nama_penyakit`, `deskripsi`) VALUES
(1, 'P1', 'Preeklampsia', 'Preeklampsia sering juga disebut toksemia adalah ketika seorang wanita hamil mengalami tekanan darah tinggi yang meningkat selama kehamilan. Preklampsia dapat mencegah plasenta mendapatkan atau menyuplai darah yang cukup. Jika plasenta tidak mendapatkan cukup darah maka janin akan mendapat pasokan nustrisi yang kurang. Hal ini dapat menyebabkan berat badan bayi yang lahir menjadi rendah dan menyebabkan masalah lainnya untuk bayi'),
(2, 'P2', 'Kehamilan Etopik', 'Kehamilan etopik merupakan suatu kehamilan yang terjadi diluar endometrium kavum uteri. Kehamilan etopik hasil dari implantasi dan pematangan konseptus di luar rongga endometrium, yang khirnya berakhir dengan kematian janin. Jika tidak didiagnosis dini dan mendapat perawatan yang tepat waktu, maka kehamilan etopik dapat mengancam nyawa'),
(4, 'P3', 'Hiperemesis Gravidarum', 'Hiperemesis Gravidarum merupakan suatu keadaan yang ditandai rasa mual dan muntah yang berlebihan, kehilangan berat badan dan gangguan keseimbangan elektrolit, ibu hamil terlihat lebih kurus, turgor kulit berkurang dan mata terlihat cekung'),
(5, 'P4', 'Mola Hidatidosa', 'Mola hidatidosa adalah tidak ditemukan pertumbuhan janin dimana hampir seluruh vili korialis mengalami perubahan berupa degenerasi hidrofobik sehingga terlihat seperti sekumpulan buah anggur. Keadaan ini tetap menghasilkan hormon human chononic gonadotrophin (HCG) dalam jumlah yang lebih besar dari kehamilan biasa '),
(6, 'P5', 'Anemia', 'Anemia adalah kondisi dimana sel darah merah menurun atau menurunnya hemoglobin, sehingga kapasitas daya angkut oksigen untuk kebutuhan organ-organ vital pada ibu hamil dan janin menjadi berkurang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `relasi_penyakit_gejala`
--

CREATE TABLE `relasi_penyakit_gejala` (
  `idrelasi` int(11) NOT NULL,
  `idgejala` int(11) NOT NULL,
  `idpenyakit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `relasi_penyakit_gejala`
--

INSERT INTO `relasi_penyakit_gejala` (`idrelasi`, `idgejala`, `idpenyakit`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 19, 1),
(8, 2, 2),
(9, 7, 2),
(10, 8, 2),
(11, 9, 2),
(12, 10, 2),
(13, 8, 4),
(14, 9, 4),
(15, 11, 4),
(16, 12, 4),
(17, 13, 4),
(18, 14, 4),
(19, 15, 4),
(20, 16, 4),
(21, 19, 4),
(22, 20, 4),
(23, 24, 4),
(24, 8, 5),
(25, 9, 5),
(26, 17, 5),
(27, 18, 5),
(28, 23, 5),
(29, 8, 6),
(30, 20, 6),
(31, 21, 6),
(32, 22, 6),
(33, 24, 6),
(34, 25, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rule`
--

CREATE TABLE `rule` (
  `idrule` int(11) NOT NULL,
  `idgejala` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rule`
--

INSERT INTO `rule` (`idrule`, `idgejala`, `nilai`) VALUES
(1, 1, 0.5),
(2, 2, 0.6),
(3, 3, 0.5),
(4, 4, 0.3),
(5, 5, 0.3),
(6, 6, 0.5),
(7, 7, 0.4),
(8, 8, 0.8),
(9, 9, 0.8),
(10, 10, 0.6),
(11, 11, 0.5),
(12, 12, 0.5),
(13, 13, 0.3),
(14, 14, 0.7),
(15, 15, 0.5),
(16, 16, 0.8),
(17, 17, 0.7),
(18, 18, 0.3),
(19, 19, 0.5),
(20, 20, 0.3),
(21, 21, 0.3),
(22, 22, 0.5),
(23, 23, 0.4),
(24, 24, 0.8),
(26, 25, 0.6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `solusi`
--

CREATE TABLE `solusi` (
  `idsolusi` int(11) NOT NULL,
  `idpenyakit` int(11) NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `solusi`
--

INSERT INTO `solusi` (`idsolusi`, `idpenyakit`, `solusi`) VALUES
(3, 1, 'Beristirahat sebanyak mungkin'),
(4, 1, 'Mengurangi konsumsi garam'),
(5, 1, 'Melakukan pemeriksaan kehamilan dua kali dalam seminggu'),
(6, 2, 'Sel telur yang telah dibuahi tidak dapat berkembang secara normal di luar rahim. Oleh karena itu, jaringan ektopik harus diangkat untuk mencegah komplikasi yang dapat berakibat fatal'),
(7, 1, 'Mengonsumsi obat antihypertensip'),
(8, 1, 'Ibu hamil yang mengalami preeklampsia perlu mendapatkan perawatan di rumah sakit jika tekanan darah mencapai 140/90 atau lebih\r\n'),
(9, 1, 'Ibu hamil yang mengalami preeklampsia perlu mendapatkan perawatan di rumah sakit jika terdapat tanda proteinuria'),
(10, 2, 'Wanita yang dicurigai mengalami kehamilan ektopik segera harus dibawa ke rumah sakit untuk mendapatkan penanganan secepat mungkin. Kehamilan ektopik yang terdeteksi secara dini, tanpa gejala nyeri yang signifikan, dan tanpa janin yang berkembang normal dalam rahim biasanya diterapi dengan suntikan. Suntikan tersebut bertujuan untuk menghentikan pertumbuhan dan menghancurkan sel-sel yang telah terbentuk.'),
(11, 2, 'Penanganan kehamilan ektopik juga dapat dilakukan melalui tindakan operasi. Prosedur ini umumnya dilaksanakan dengan metode operasi laparoskopi atau operasi lubang kunci. Tuba fallopi yang ditumbuhi jaringan ektopik akan diperbaiki dalam proses ini'),
(12, 4, 'Mengonsumsi makanan dalam porsi kecil tetapi sering'),
(13, 4, 'Melakukan variasi dalam makanan dengan memasukkan biskuit atau  roti kering dengan teh'),
(14, 4, 'Hindari makanan berlemak karena umumnya dapat menyebabkan mual'),
(15, 4, 'Menambahkan asupan makanan yang mengandung vitamin B1,B6, vitamin B complex, dan vitamin C'),
(16, 4, 'Penggunaan obat, seperti Chlorpromazin, sering digunakan karena tidak hanya memiliki efek menenangkan jiwa tetapi juga bersifat anti muntah'),
(17, 4, 'Untuk ibu hamil yang mengalami Hiperemesis Gravidarum, penanganan medis segera diperlukan jika semua makanan dan minuman yang dikonsumsi cenderung dimuntahkan, terutama jika kondisi ini berlangsung dalam jangka waktu yang lama'),
(18, 4, 'Untuk ibu hamil yang mengalami Hiperemesis Gravidarum, penanganan medis segera diperlukan jika terjadi penurunan berat badan yang signifikan'),
(19, 4, 'Untuk ibu hamil yang mengalami Hiperemesis Gravidarum, penanganan medis segera diperlukan jika terdapat gejala lidah kering'),
(20, 6, 'Mengkonsumsi suplemen zat besi '),
(21, 6, 'Menambah asupan vitamin C'),
(22, 6, 'Mengkonsumsi sayur dan buah yang mengandung asam folat'),
(23, 5, 'Kuretase'),
(24, 5, 'Histerektomi atau pengangkatan rahim. Tindakan ini hanya direkomendasikan jika Anda tidak berencana untuk memiliki keturunan lagi.'),
(25, 5, 'Penanganan kehamilan anggur melibatkan metode utama berupa operasi pengangkatan jaringan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE `tamu` (
  `idtamu` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `usia_kandungan` int(30) NOT NULL,
  `preeklampsia` double DEFAULT 0,
  `kehamilan_etopik` double DEFAULT 0,
  `hiperemesis_gravidarum` double DEFAULT 0,
  `mola_hidatidosa` double DEFAULT 0,
  `anemia` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tamu`
--

INSERT INTO `tamu` (`idtamu`, `nama`, `tanggal`, `usia_kandungan`, `preeklampsia`, `kehamilan_etopik`, `hiperemesis_gravidarum`, `mola_hidatidosa`, `anemia`) VALUES
(1, 'Alisa', '2024-01-13 04:08:36', 8, 0.43, 0, 0.69, 0.58, 0.61),
(2, 'Maryam S', '2024-01-13 06:47:54', 9, 0.6, 0.6, 0.3, 0, 0),
(3, 'Lala', '2024-01-13 06:48:38', 8, 0.6, 0.71, 0.75, 0.8, 0.5),
(4, 'Lala', '2024-01-13 06:49:30', 8, 0.54, 0.6, 0.5, 0, 0.6),
(5, 'Nadya', '2024-01-13 07:13:43', 7, 0.6, 0.6, 0, 0.7, 0.6),
(6, 'Tria', '2024-01-13 07:36:17', 7, 0.5, 0.4, 0.75, 0.3, 0.8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `nama`, `email`, `level`) VALUES
(1, 'susan', '$2y$10$aCVepaZFbWEdO0LGLN84h.2C0H3MezwtBNXlzzBbsaBMSCg6kZqfa', 'Susan', 'susan@gmail.com', 'Admin'),
(2, 'user', '$2y$10$Dxlu0EZkFUCF.rsMMUpTseqywtducEZ8YkceQrH2Gqo3IEjUc7ch.', 'User App Edit', 'user@gmail.com', 'User'),
(3, 'dm', '$2y$10$VSJXsaXZz97DXDViP2w6Nu0o/F.nSRT/bLeTttNx0xPWrzKaY/gn2', 'Admin', 'triapujiastuti029@gmail.com', 'Admin'),
(4, 'userrr1', '$2y$10$UdLgpByCUVumDC3mzSjluOhJuEoh9KpT5SAF49qMLsfi4xGiYBSiu', 'userrr', 'user2@gmail.com', 'User'),
(5, 'anu', '$2y$10$WrI4v.P1QISCWvtNC0sgv.dQjPPYqiLUceILMKoTwJEnbR4SkzZ6K', 'Si Anu', 'anusabdk@bksda.com', 'User'),
(6, 'ens', '$2y$10$xthuVt4awwfsSQ7APCYyIuVuaNUBGBfd0SNiMBkB.fSWqgJsYJsr6', 'Eka Nurseva', 'ekanursevas@gmail.com', 'User');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`idgejala`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`idhasil`),
  ADD KEY `hasil_ibfk_1` (`iduser`);

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`idpenyakit`);

--
-- Indeks untuk tabel `relasi_penyakit_gejala`
--
ALTER TABLE `relasi_penyakit_gejala`
  ADD PRIMARY KEY (`idrelasi`),
  ADD KEY `idgelaja` (`idgejala`),
  ADD KEY `idpenyakit` (`idpenyakit`);

--
-- Indeks untuk tabel `rule`
--
ALTER TABLE `rule`
  ADD PRIMARY KEY (`idrule`),
  ADD KEY `idgejala` (`idgejala`);

--
-- Indeks untuk tabel `solusi`
--
ALTER TABLE `solusi`
  ADD PRIMARY KEY (`idsolusi`),
  ADD KEY `idpenyakit` (`idpenyakit`);

--
-- Indeks untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`idtamu`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `idgejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `idhasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `idpenyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `relasi_penyakit_gejala`
--
ALTER TABLE `relasi_penyakit_gejala`
  MODIFY `idrelasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `rule`
--
ALTER TABLE `rule`
  MODIFY `idrule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `solusi`
--
ALTER TABLE `solusi`
  MODIFY `idsolusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tamu`
--
ALTER TABLE `tamu`
  MODIFY `idtamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `relasi_penyakit_gejala`
--
ALTER TABLE `relasi_penyakit_gejala`
  ADD CONSTRAINT `relasi_penyakit_gejala_ibfk_1` FOREIGN KEY (`idgejala`) REFERENCES `gejala` (`idgejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relasi_penyakit_gejala_ibfk_2` FOREIGN KEY (`idpenyakit`) REFERENCES `penyakit` (`idpenyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rule`
--
ALTER TABLE `rule`
  ADD CONSTRAINT `rule_ibfk_2` FOREIGN KEY (`idgejala`) REFERENCES `gejala` (`idgejala`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `solusi`
--
ALTER TABLE `solusi`
  ADD CONSTRAINT `solusi_ibfk_1` FOREIGN KEY (`idpenyakit`) REFERENCES `penyakit` (`idpenyakit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
