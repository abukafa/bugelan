-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2022 at 10:32 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bugelan`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id` int(11) NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `session` text NOT NULL,
  `nisn` text NOT NULL,
  `name` text NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id`, `date`, `time`, `session`, `nisn`, `name`, `note`) VALUES
(26, '2022-02-05', '06:50:47', '1', '64263229', 'Abdul Jamil Daris Salam', '-'),
(31, '2022-02-06', '09:53:00', '1', '66849244', 'Aidil Putra', '-'),
(33, '2022-02-06', '09:55:38', '1', '          64263229', 'Abdul Jamil Daris Salam', '-'),
(34, '2022-02-06', '09:56:42', '1', '74960870          ', 'Insan Kamil', '-');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `code` varchar(11) NOT NULL,
  `unit` text NOT NULL,
  `name` text NOT NULL,
  `des` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`code`, `unit`, `name`, `des`) VALUES
('11001', 'Aktiva', 'Bantuan Operasional Sekolah (BOS)', 'Bantuan dari Kementrian Pendidikan RI'),
('11002', 'Aktiva', 'Mutasi Saldo', 'Pemindahan/ Realokasi Saldo'),
('22003', 'Ekuitas', 'Sumbangan Yayasan', 'Sumbangan dari donatur yayasan'),
('22004', 'Ekuitas', 'Iuran Anggota', 'Pengumpulan dana melalui iuran anggota yayasan'),
('22005', 'Ekuitas', 'Hutang Lembaga', 'Pendapatan berupa pinjaman dana operasional'),
('33006', 'Pendapatan', 'Pendapatan Usaha', 'Pendapatan hasil usaha (koperasi)'),
('33007', 'Pendapatan', 'Penjualan', 'Pendapatan dari penjualan hasil karya Lembaga'),
('33008', 'Pendapatan', 'Penjualan Aset', 'Pendapatan dari penjualan atau sewa aset'),
('33009', 'Pendapatan', 'Pemasukan Lain-lain', 'Pendapatan lain-lain'),
('44010', 'Biaya', 'Honor Guru', 'Pembayaran gaji guru'),
('44011', 'Biaya', 'Gaji Karyawan', 'Pembayaran gaji non guru'),
('44012', 'Biaya', 'Alat Tulis Kantor (ATK)', 'Perlengkapan Operasional Kantor'),
('44013', 'Biaya', 'Biaya Rapat', 'Pembiayaan kebutuhan rapat'),
('44014', 'Biaya', 'Laporan BOS', 'Biaya operasional dan laporan BOS'),
('44015', 'Biaya', 'Seragam Batik', 'Pembuatan seragam batik sekolah'),
('44016', 'Biaya', 'Seragam Olahraga', 'Pembuatan seragam olahraga sekolah'),
('44017', 'Biaya', 'Atribut', 'Pembelian atribut sekolah'),
('44018', 'Biaya', 'Biaya UAS', 'Biaya kebutuhan ujian ahir semester'),
('44019', 'Biaya', 'Biaya UKK', 'Biaya kebutuhan ujian kenaikan kelas'),
('44020', 'Biaya', 'Biaya Raport', 'Kebutuhan laporan hasil belajar'),
('44021', 'Biaya', 'Buku dan Modul', 'Pembelanjaan buku pendamping belajar'),
('44022', 'Biaya', 'Kegiatan OSIS', 'Biaya kebutuhan kegiatan organisasi siswa'),
('44023', 'Biaya', 'Kegiatan Pramuka', 'Biaya kebutuhan kegiatan pramuka'),
('44024', 'Biaya', 'Kegiatan Lomba', 'Biaya kebutuhan kegiatan perlombaan sekolah'),
('44025', 'Biaya', 'Kegiatan Akhir Tahun', 'Biaya kebutuhan kegiatan pelepasan/ ahir tahun'),
('44026', 'Biaya', 'Kegiatan Lain-lain', 'Biaya kebutuhan kegiatan lain-lain'),
('44027', 'Biaya', 'Biaya Lain-lain', 'Biaya kebutuhan lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uname` text NOT NULL,
  `pass` text NOT NULL,
  `name` text NOT NULL,
  `access` text NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uname`, `pass`, `name`, `access`, `remark`) VALUES
(1, 'tech', '456', 'Abu Kafa', 'Programmer', 'Maintenance App Technician'),
(6, 'adm', '7890', 'Anonymous', 'User', 'Program user test'),
(7, 'spr', '7890', 'Anonymous', 'Supervisor', 'Program user test'),
(8, 'mgr', '7890', 'Anonymous', 'Manager', 'Program user test');

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `id` int(11) NOT NULL,
  `inv` text NOT NULL,
  `date` date NOT NULL,
  `period` text NOT NULL,
  `account` text NOT NULL,
  `vendor` text NOT NULL,
  `des` text NOT NULL,
  `remark` text NOT NULL,
  `debit` text NOT NULL,
  `credit` text NOT NULL,
  `admin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`id`, `inv`, `date`, `period`, `account`, `vendor`, `des`, `remark`, `debit`, `credit`, `admin`) VALUES
(406, 'FC-87543373', '2020-08-17', 'Aug 2020', '44026', 'pasar', 'bumbu masak', 'mabit', '0', '30000', 'Abu Kafa'),
(411, 'FC-063232', '2021-07-16', 'Jul 2021', '44021', 'Bagea jaya', 'homeshool planner @10 buku qiroah @10', 'Modul', '0', '187000', 'Abu Kafa'),
(445, 'FC-22098', '2020-08-17', 'Aug 2020', '44016', 'sarana sport', '12kun corong, ', 'perlengkapan olahraga', '0', '85000', 'Abu Kafa'),
(456, 'FC-0082452', '2021-06-10', 'Jun 2021', '44012', 'Bukalapak', '20 meja belajar lipat', 'perlengkapan kelas', '0', '615300', 'Abu Kafa'),
(475, 'FC-633988', '2021-12-07', 'Dec 2021', '44025', 'pasar', 'Air minum', 'Gabungan', '0', '6000', 'Abu Kafa'),
(484, 'FC-633988', '2021-12-07', 'Dec 2021', '44025', 'umi fajri', 'butbut', 'Gabungan', '0', '27000', 'Abu Kafa'),
(488, 'FC-633333', '2021-09-10', 'Sep 2021', '44027', 'Mirah Rejeki', 'asbes', 'bangunan saung sawah', '0', '200000', 'Abu Kafa'),
(489, 'FC-633333', '2021-09-10', 'Sep 2021', '44027', 'habi', 'Bayar tukang', 'bangunan saung sawah', '0', '800000', 'Abu Kafa'),
(492, 'FC-633333', '2021-09-10', 'Sep 2021', '44027', 'habi', 'Bayar tukang pasang pintu', 'bangunan saung sawah', '0', '100000', 'Abu Kafa'),
(497, 'FC-633333', '2021-09-10', 'Sep 2021', '44027', 'habi', 'minum', 'bangunan saung sawah', '0', '7500', 'Abu Kafa'),
(519, 'FC-666953', '2021-06-10', 'Jun 2021', '44013', 'SPBU', 'bensin', 'rapat guru', '0', '200000', 'Abu Kafa'),
(523, 'FC-333333', '2021-08-12', 'Aug 2021', '44027', 'tukang', 'Bayar tukang gali sumur', 'mck sawah', '0', '350000', 'Abu Kafa'),
(528, 'FC-63395355', '2020-12-10', 'Dec 2020', '44012', 'gema', 'akses point', 'akses point', '0', '700000', 'Abu Kafa'),
(541, 'FC-633909', '2021-01-10', 'Jan 2021', '44013', 'pasar', 'jus', 'konsumsi kajian', '0', '50000', 'Abu Kafa'),
(542, 'FC-633555', '2021-10-10', 'Oct 2021', '44021', 'pasar', 'figura tasmi', 'program mutqin', '0', '200000', 'Abu Kafa'),
(543, 'FC-2359300', '2021-01-10', 'Jan 2021', '44024', 'Mie ayam kujang', 'Konsumsi Rapat', 'Konsumsi', '0', '47000', 'Abu Kafa'),
(544, 'FC-235930377', '2021-10-10', 'Oct 2021', '44015', 'el hisyami', 'Rompi Guru', 'seragam', '0', '1400000', 'Abu Kafa'),
(545, 'FC-2359303', '2021-12-30', 'Dec 2021', '44026', 'SPBU', 'Bensin', 'Rihlah Guru', '0', '150000', 'Abu Kafa'),
(550, 'FC-203327', '2021-12-30', 'Dec 2021', '44010', 'Ms.Tia', 'KASBON', 'mukafaah november 2020', '0', '650000', 'Abu Kafa'),
(551, 'FC-203327', '2021-12-29', 'Dec 2021', '44010', 'Ust Abu', 'KASBON', 'mukafaah november 2020', '0', '200000', 'Abu Kafa'),
(553, 'FC-3903322', '2021-12-30', 'Dec 2021', '44022', 'SPBU', 'Bensin', 'Survei Tempat Camp', '0', '200000', 'Abu Kafa'),
(554, 'FC-3903322', '2021-12-26', 'Dec 2021', '44024', 'SPBU', 'Cilok', 'Survei Tempat Camp', '0', '20000', 'Abu Kafa'),
(555, 'FC-3903322', '2021-12-27', 'Dec 2021', '44023', 'SPBU', 'Keresek untuk beras', 'Survei Tempat Camp', '0', '14000', 'Abu Kafa'),
(556, 'FC-30322303', '2021-12-07', 'Dec 2021', '44012', 'Tokopedia', 'teko kopi', 'perlengkapan kantor', '0', '160000', 'Abu Kafa'),
(557, 'FC-30322303', '2021-12-07', 'Dec 2021', '44012', 'aji seafood', 'cumi 1 kg untuk konsumsi', 'perlengkapan kantor', '0', '55000', 'Abu Kafa'),
(558, 'FC-322', '2021-05-14', 'May 2021', '22003', 'ust asep', 'donasi dari umi yuyun', 'donasi', '500000', '0', 'Abu Kafa'),
(567, 'FC-0034223', '2021-11-07', 'Nov 2021', '44011', 'ust iqbal', 'mukafaah ust iqbal', 'kajian guru habi', '0', '50000', 'Abu Kafa'),
(568, 'FC-0034223', '2021-11-17', 'Nov 2021', '44011', 'pasar', 'uang taklamh konsumsi', 'kajian guru habi', '0', '300000', 'Abu Kafa');

-- --------------------------------------------------------

--
-- Table structure for table `letter`
--

CREATE TABLE `letter` (
  `id` int(11) NOT NULL,
  `no` text NOT NULL,
  `lamp` text NOT NULL,
  `hal` text NOT NULL,
  `kpd` text NOT NULL,
  `main_1` text NOT NULL,
  `main_2` text NOT NULL,
  `main_3` text NOT NULL,
  `sign_1` text NOT NULL,
  `name_1` text NOT NULL,
  `sign_2` text NOT NULL,
  `name_2` text NOT NULL,
  `sign_3` text NOT NULL,
  `name_3` text NOT NULL,
  `sign_4` text NOT NULL,
  `name_4` text NOT NULL,
  `note` text NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `letter`
--

INSERT INTO `letter` (`id`, `no`, `lamp`, `hal`, `kpd`, `main_1`, `main_2`, `main_3`, `sign_1`, `name_1`, `sign_2`, `name_2`, `sign_3`, `name_3`, `sign_4`, `name_4`, `note`, `ket`) VALUES
(1, '03.001/SB/TKA-BGL/I/2022', '-', 'Surat Pemberitahuan', 'Yth. Orang tua', 'Selanjutnya kami atas nama bendahara Homeschooling Alquran Bina Insani (HABI) memberitahukan bahwa;\r\nNama : Muhammad Rizq Rahmatulloh\r\nKelas : Awal 2\r\nWali : Jajang Jaris Yogaspia\r\nAlamat : Jl.Ujungsari II No.81 Rt.02 Rw.017 , Desa. Nagarasari, Kec. Cipedes, Kab. Tasikmalaya\r\n\r\nMenurut database kami ada administrasi yang belum diselesaikan, sbb;\r\n1. Infaq Pendaftaran Rp. 0\r\n2. Infaq Bangunan Rp. 0\r\n3. Infaq Pendidikan Rp. 500,000\r\nJUMLAH Rp. 500,000', '', 'Demi kelancaran dan berjalannya kegiatan belajar di HABI, besar harapan kami agar administrasi tersebut bisa segera diselesaikan. Demikian surat pemberitahuan ini kami sampaikan, Semoga Allah SWT memudahkan segala urusan kita. ', 'Bendahara', 'Fina Astuti', 'Kepala', 'Asep Saepullah', '', '', '', '', '- Harap datang sebelum jam 10 \r\n- Harap membawa uang pas', 'Tagihan'),
(3, '01.001/SE/Y-BGL/I/2022', '-', 'Surat Edaran', 'Yth. Dewan Guru dan Staf Pengajar', 'Bersama ini kami umumkan bahwa;\r\nHari : Sabtu\r\nTanggal : 11 Januari 2022\r\nPukul : 08.00\r\nAkan diadakan Rapat kerja Guru yang harus dihadiri oleh semua guru bidang studi', '', 'Untuk itu diharapkan kehadiran semua guru di gedung SMP Bugelan.', 'Sekretaris', 'Ipin Mahmudin', 'Kepala', 'Asep Saepullah', 'HRD', 'Jajang Darunnadwah', 'Ketua Yayasan', 'H. Sobari', '', 'raker smt2'),
(4, '02.002/SU/SMPT-BGL/I/2022', '-', 'Surat Undangan', 'Yth. Dewan Guru dan Staf Pengajar', 'Bersama ini kami umumkan bahwa;\r\nHari : Sabtu\r\nTanggal : 11 Januari 2022\r\nPukul : 08.00\r\nAkan diadakan Rapat kerja Guru yang harus dihadiri oleh semua guru bidang studi. Untuk itu diharapkan kehadiran semua guru di gedung SMP Bugelan', '', '', 'Sekretaris', 'Ipin Mahmudin', 'Kepala', 'Asep Saepullah', '', '', 'Ketua Yayasan', 'H. Sobari', '', 'Undangan'),
(5, '03.003/SB/TKA-BGL/I/2022', '-', 'Surat Pemberitahuan', 'Yth. Orang tua siswa', 'Selanjutnya kami atas nama bendahara Homeschooling Alquran Bina Insani (HABI) memberitahukan bahwa;\r\nNama : Muhammad Rizq Rahmatulloh\r\nKelas : Awal 2\r\nWali : Jajang Jaris Yogaspia\r\nAlamat : Jl.Ujungsari II No.81 Rt.02 Rw.017 , Desa. Nagarasari, Kec. Cipedes, Kab. Tasikmalaya', 'Menurut database kami ada administrasi yang belum diselesaikan, sbb;\r\n1. Infaq Pendaftaran Rp. 0\r\n2. Infaq Bangunan Rp. 0\r\n3. Infaq Pendidikan Rp. 500,000\r\nJUMLAH Rp. 500,000', 'Demi kelancaran dan berjalannya kegiatan belajar di HABI, besar harapan kami agar administrasi tersebut bisa segera\r\ndiselesaikan. Demikian surat pemberitahuan ini kami sampaikan, Semoga Allah SWT memudahkan segala urusan kita. ', 'Bendahara', 'Fina Astuti', 'Kepala', 'Asep Saepullah', '', '', '', '', '- Harap datang sebelum jam 10.00\r\n- Harap membawa uang pas', 'Tagihan');

-- --------------------------------------------------------

--
-- Table structure for table `letterin`
--

CREATE TABLE `letterin` (
  `id` int(11) NOT NULL,
  `sip` text NOT NULL,
  `no` text NOT NULL,
  `lamp` text NOT NULL,
  `hal` text NOT NULL,
  `file` text NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `letterin`
--

INSERT INTO `letterin` (`id`, `sip`, `no`, `lamp`, `hal`, `file`, `ket`) VALUES
(1, 'Kemendikbud', '03.001/SB/TKA-BGL/I/2022', '-', 'Surat Pemberitahuan', '61e9a6ce253fa.jpg', 'Tagihan'),
(3, 'Dinas Kabupaten Tasikmalaya', '01.001/SE/Y-BGL/I/2022', '-', 'Surat Edaran', '61e9a2619db96.jpg', 'raker smt2'),
(5, 'Yayasan Bugelan', '03.003/SB/TKA-BGL/I/2022', '-', 'Surat Pemberitahuan', '61e9a27ec2f94.jpg', 'Tagihan'),
(8, 'Komunitas Ngajiaja', '11.001/SK/TKA-BGL/I/2022', '2', 'Surat Pemberitahuan', '61e9a276ebd57.jpg', 'Tagihan');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` int(11) NOT NULL,
  `nama` text NOT NULL,
  `nipd` text NOT NULL,
  `jk` text NOT NULL,
  `tempat_lahir` text NOT NULL,
  `tanggal_lahir` text NOT NULL,
  `nik` text NOT NULL,
  `agama` text NOT NULL,
  `alamat` text NOT NULL,
  `rt` text NOT NULL,
  `rw` text NOT NULL,
  `dusun` text NOT NULL,
  `kelurahan` text NOT NULL,
  `kecamatan` text NOT NULL,
  `kode_pos` text NOT NULL,
  `jenis_tinggal` text NOT NULL,
  `alat_transportasi` text NOT NULL,
  `telepon` text NOT NULL,
  `hp` text NOT NULL,
  `email` text NOT NULL,
  `skhun` text NOT NULL,
  `penerima_kps` text NOT NULL,
  `no_kps` text NOT NULL,
  `nama_ayah` text NOT NULL,
  `tl_ayah` text NOT NULL,
  `pendidikan_ayah` text NOT NULL,
  `pekerjaan_ayah` text NOT NULL,
  `penghasilan_ayah` text NOT NULL,
  `nik_ayah` text NOT NULL,
  `nama_ibu` text NOT NULL,
  `tl_ibu` text NOT NULL,
  `pendidikan_ibu` text NOT NULL,
  `pekerjaan_ibu` text NOT NULL,
  `penghasilan_ibu` text NOT NULL,
  `nik_ibu` text NOT NULL,
  `nama_wali` text NOT NULL,
  `tl_wali` text NOT NULL,
  `pendidikan_wali` text NOT NULL,
  `pekerjaan_wali` text NOT NULL,
  `penghasilan_wali` text NOT NULL,
  `nik_wali` text NOT NULL,
  `tahun` text NOT NULL,
  `npun` text NOT NULL,
  `no_seri_ijazah` text NOT NULL,
  `penerima_kip` text NOT NULL,
  `nomor_kip` text NOT NULL,
  `nama_di_kip` text NOT NULL,
  `nomor_kks` text NOT NULL,
  `no_registrasi_akta_lahir` text NOT NULL,
  `bank` text NOT NULL,
  `nomor_rekening_bank` text NOT NULL,
  `rekening_atas_nama` text NOT NULL,
  `layak_pip` text NOT NULL,
  `alasan_layak_pip` text NOT NULL,
  `kebutuhan_khusus` text NOT NULL,
  `sekolah_asal` text NOT NULL,
  `anak_ke` text NOT NULL,
  `lintang` text NOT NULL,
  `bujur` text NOT NULL,
  `no_kk` text NOT NULL,
  `berat_badan` text NOT NULL,
  `tinggi_badan` text NOT NULL,
  `lingkar_kepala` text NOT NULL,
  `jml_saudara` text NOT NULL,
  `jarak_rumah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama`, `nipd`, `jk`, `tempat_lahir`, `tanggal_lahir`, `nik`, `agama`, `alamat`, `rt`, `rw`, `dusun`, `kelurahan`, `kecamatan`, `kode_pos`, `jenis_tinggal`, `alat_transportasi`, `telepon`, `hp`, `email`, `skhun`, `penerima_kps`, `no_kps`, `nama_ayah`, `tl_ayah`, `pendidikan_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`, `nik_ayah`, `nama_ibu`, `tl_ibu`, `pendidikan_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`, `nik_ibu`, `nama_wali`, `tl_wali`, `pendidikan_wali`, `pekerjaan_wali`, `penghasilan_wali`, `nik_wali`, `tahun`, `npun`, `no_seri_ijazah`, `penerima_kip`, `nomor_kip`, `nama_di_kip`, `nomor_kks`, `no_registrasi_akta_lahir`, `bank`, `nomor_rekening_bank`, `rekening_atas_nama`, `layak_pip`, `alasan_layak_pip`, `kebutuhan_khusus`, `sekolah_asal`, `anak_ke`, `lintang`, `bujur`, `no_kk`, `berat_badan`, `tinggi_badan`, `lingkar_kepala`, `jml_saudara`, `jarak_rumah`) VALUES
(84508542, 'Ade Nurafni', '212207001', 'P', 'Tasikmalaya', '2008-05-16', '3278055605080002', 'Islam', 'Bugelan', '3', '10', 'Bugelan', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '082315915160', '', '', 'Ya', 'T06Wve', 'Nedi', '1969', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Mae', '1972', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Ya', 'T06Wve', '0', '', '', 'Bank Bri', '445301002489504', 'Ade Nurafni', 'Ya', '', 'Tidak Ada', '', '1', '-7.4007', '108.2029', '', '40', '145', '0', '0', '1'),
(98104957, 'Aldi Fahri Ramdani', '212207002', 'L', 'Tasikmalaya', '2008-09-26', '3278052609080002', 'Islam', 'Bugelan', '3', '6', '', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '089627420099', '', '', 'Ya', 'Pao1Yh', 'Syaepul', '1978', 'Sma / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Ida Rosyidah', '1985', 'Smp / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Ya', 'Pao1Yh', '0', '', '', 'Bank Bri', '445301003049501', 'Aldi Fahri Ramdani', 'Ya', 'Pemegang Pkh/Kps/Kks', 'Tidak Ada', '', '1', '-7.4029', '108.2091', '', '45', '150', '0', '0', '1'),
(91471079, 'Aneu Anggraeni', '212207003', 'P', 'Tasikmalaya', '2009-04-30', '3278057004090002', 'Islam', 'Bugelan', '2', '6', 'Bugelan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081390960936', '', '', 'Ya', 'Prq5A6', 'Apul', '1971', 'Sma / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Yanti Rostina', '1978', 'Smp / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Ya', 'Prq5Ak', '0', '', '', '', '', '', 'Ya', '', 'Tidak Ada', '', '1', '-7.399238492396', '108.20288658142', '', '40', '140', '0', '0', '1'),
(83140286, 'Anggraini Salsabillah', '212207004', 'P', 'Tasikmalaya', '2008-11-04', '3278054411080003', 'Islam', 'Bugelan', '2', '6', 'Bugelan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081914944190', '', '', 'Tidak', '', 'Ishak', '1970', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Tuti Astuti', '1975', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', '', '1', '-7.4007', '108.2029', '', '50', '140', '0', '0', '1'),
(87709032, 'Fatema Alzahra', '212207005', 'P', 'Saudi Arabia', '2008-10-20', '3205196010080003', 'Islam', 'Perum Dano Asri', '0', '0', '', 'Cibodas', 'Kec. Cikajang', '44171', 'Wali', 'Jalan Kaki', '', '08985868330', '', '', 'Tidak', '', 'Ade Candra', '1966', 'Sma / Sederajat', 'Sudah Meninggal', 'Tidak Berpenghasilan', '', 'Sri Rahayu', '1966', 'Sma / Sederajat', 'Pns/Tni/Polri', 'Rp. 2,000,000 - Rp. 4,999,999', '', '', '', '', '', '', '', '2021', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', '', '1', '-7.360154', '107.811984', '', '45', '155', '0', '1', '1'),
(95932413, 'Fuad Hasyim', '212207006', 'L', 'Malang', '2009-12-06', '3278050612090002', 'Islam', 'Bugelan', '4', '6', '', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '082130024736', '', '', 'Tidak', '', 'Karom', '1975', 'Smp / Sederajat', 'Pedagang Kecil', 'Rp. 500,000 - Rp. 999,999', '', 'Dede Entin Kartini', '1981', '', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Ya', 'Siswa Miskin/Rentan Miskin', 'Tidak Ada', '', '1', '-7.4029', '108.2091', '', '50', '145', '0', '0', '1'),
(81947275, 'Herna Nurajijah', '212207007', 'P', 'Tasikmalaya', '2008-12-09', '3278054912080004', 'Islam', 'Bugelan', '5', '6', 'Gunung Tandala', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Angkutan Umum', '', '082829512288', '', '', 'Ya', 'Pdker0', 'Ibad Nurul Badri', '1977', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Susi', '1983', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Ya', 'Pdker0', '0', '', '', 'Bank Bri', '445301002677505', 'Herna Nurajijah', 'Ya', 'Pemegang Pkh/Kps/Kks', 'Tidak Ada', '', '1', '-7.4007', '108.2029', '', '46', '155', '0', '0', '1'),
(81383079, 'Husnul Rizal', '212207008', 'L', 'Tasikmalaya', '2008-03-23', '3278052303080004', 'Islam', 'Bugelan', '2', '10', 'Gunung Tandala', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Angkutan Umum', '', '0895361420714', '', '', 'Ya', 'Pzrc9Q', 'Toni', '1984', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Reni Pitriani', '1989', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Ya', 'Pzrc9Q', '0', '', '', 'Bank Bri', '445301001931508', 'Husnul Rizal', 'Ya', '', 'Tidak Ada', '', '1', '-7.4007', '108.2029', '', '48', '155', '0', '0', '1'),
(93097618, 'Jelita Arkeylla Edgina', '212207020', 'P', 'Tasikmalaya', '2009-01-01', '3278054101090003', 'Islam', 'Kp. Pasir Datar', '3', '7', '', 'Gunung Gede', 'Kec. Kawalu', '', 'Bersama Orang Tua', 'Jalan Kaki', '', '', '', '', 'Tidak', '', 'Agus Zamhur', '1979', 'Sma / Sederajat', 'Wiraswasta', 'Rp. 500,000 - Rp. 999,999', '3278050308790001', 'Rani Nugraha', '0', 'Sd / Sederajat', 'Wiraswasta', 'Kurang Dari Rp. 500,000', '0000000000000000', '', '', 'Sd / Sederajat', 'Wiraswasta', '', '', '2021', '', '', 'Tidak', '', '1', '', '', '', '', '', 'Ya', 'Daerah Konflik', 'Tidak Ada', '', '1', '', '', '3278052001100029', '50', '146', '0', '0', '1'),
(82376651, 'Livia Anggraeni', '212207009', 'P', 'Tasikmalaya', '2008-12-04', '3278054412080001', 'Islam', 'Bugelan', '5', '6', 'Gunung Tandala', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '085222713763', '', '', 'Ya', '39Q2Eg46182004', 'Amas', '1965', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Diah', '1973', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Ya', 'Dino40', '0', '39Q2Eg', '', 'Bank Bri', '445301002839505', 'Livia Anggraeni', 'Ya', '', 'Tidak Ada', '', '1', '-7.4007', '108.2029', '', '45', '155', '0', '0', '1'),
(91550550, 'Nurmalasari', '212207010', 'P', 'Tasikmalaya', '2009-01-16', '3278055601090001', 'Islam', 'Sukasari', '2', '11', '', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081220813460', '', '', 'Tidak', 'Din5C6', 'Misbahul Ulum', '1964', 'Sma / Sederajat', 'Wiraswasta', 'Rp. 500,000 - Rp. 999,999', '', 'Hajar Rohayati', '1979', 'Smp / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Ya', 'Pemegang Pkh/Kps/Kks', 'Tidak Ada', '', '1', '-7.4029', '108.2091', '', '45', '147', '0', '0', '1'),
(99909151, 'Piki Putra Pratama', '212207011', 'L', 'Tasikmalaya', '2009-06-22', '3278052206090001', 'Islam', 'Cibeas', '1', '10', 'Gunung Tandala', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '082118170434', '', '', 'Tidak', '', 'Yoyo', '1974', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Ani', '1980', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', '', '2', '-7.4007', '108.2029', '', '47', '150', '0', '0', '1'),
(86763978, 'Raihan Ihsan Ramdani', '212207012', 'L', 'Tasikmalaya', '2008-09-24', '3278052409080001', 'Islam', 'Bugelan', '2', '10', 'Gunung Tandala', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '0895395284032', '', '', 'Ya', '39Q2Bi46182003', 'Umar', '1970', 'Sma / Sederajat', 'Buruh', 'Rp. 1,000,000 - Rp. 1,999,999', '', 'Itoh Masitoh', '1973', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Tidak', '', '0', '39Q2Bi', '', '', '', '', 'Ya', 'Pemegang Pkh/Kps/Kks', 'Tidak Ada', '', '2', '-7.4007', '108.2029', '', '47', '140', '0', '0', '1'),
(84323178, 'Restu Gumilar', '212207013', 'L', 'Tasikmalaya', '2008-11-26', '3278052611080001', 'Islam', 'Bugelan', '3', '10', 'Gunung Tandala', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081223180632', '', '', 'Tidak', '39Q2Kb46182005', 'Rasmana', '1971', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Ihat', '1983', 'Smp / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Ya', 'Psta2J', '0', '', '', '', '', '', 'Ya', '', 'Tidak Ada', '', '1', '-7.4007', '108.2029', '', '45', '145', '0', '0', '1'),
(95293438, 'Rizki Istiawan', '212207014', 'L', 'Bekasi', '2009-03-12', '3275091203090002', 'Islam', 'Jl. Bangka No 67 F Komp. Ppa', '3', '4', 'Kp. Pondok Benda', 'Jatirasa', 'Kec. Jatiasih', '17424', 'Bersama Orang Tua', 'Jalan Kaki', '', '082261443748', '', '', 'Tidak', '', 'Nono Sutrisno', '1970', 'Sma / Sederajat', 'Wiraswasta', 'Rp. 1,000,000 - Rp. 1,999,999', '', 'Eris', '1971', 'Sma / Sederajat', 'Pedagang Kecil', 'Rp. 1,000,000 - Rp. 1,999,999', '', '', '', '', '', '', '', '2021', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Ya', 'Siswa Miskin/Rentan Miskin', 'Tidak Ada', '', '2', '-6.291', '106.9756', '', '48', '150', '0', '0', '1'),
(88322948, 'Syifa Rahmi Firmansyah', '212207015', 'P', 'Tasikmalaya', '2008-07-28', '3278056807080002', 'Islam', 'Bugelan', '3', '10', 'Bugelan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '085967066606', '', '', 'Ya', 'T9Rj2O', 'Ayep Yayat P', '1982', 'Smp / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Epa Nurhayati', '1985', 'Smp / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Ya', 'T9Rj2O', '0', '', '', 'Bank Bri', '445301002824500', 'Syifa Rahmi Firmansyah', 'Ya', 'Pemegang Pkh/Kps/Kks', 'Tidak Ada', '', '1', '-7.409677', '108.218819', '', '48', '150', '0', '0', '1'),
(88301140, 'Vivian Attaufunnisa', '212207016', 'P', 'Tasikmalaya', '2008-12-02', '3278054212080001', 'Islam', 'Bugelan', '3', '10', 'Bugelan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '082115234232', '', '', 'Ya', 'P05Zr3', 'Yusup', '1975', 'Smp / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Eet Nurasiah', '1981', 'Smp / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Ya', 'Po5Zr3', '0', '', '', '', '', '', 'Ya', '', 'Tidak Ada', '', '2', '-7.40108', '108.217824', '', '50', '160', '0', '0', '1'),
(97704986, 'Wafa Nurfauzan', '212207017', 'L', 'Tasikmalaya', '2009-01-25', '3278052501090002', 'Islam', 'Bugelan', '3', '6', '', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081320326153', '', '', 'Tidak', '39Q2Kp46182007', 'Hopid', '1972', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Atin Rustini', '1977', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Ya', '', '0', '', '', 'Bank Bri', '445301003031508', 'Wafa Nurfauzan', 'Ya', '', 'Tidak Ada', '', '1', '-7.4029', '108.2091', '', '50', '155', '0', '0', '1'),
(95061965, 'Wafi Nurfauziah', '212207018', 'P', 'Tasikmalaya', '2009-01-25', '3278056501090005', 'Islam', 'Bugelan', '3', '6', '', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081320326153', '', '', 'Tidak', 'Rhtev1', 'Hopid', '1972', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Atin Rustini', '1977', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Ya', 'Rhtevi', '0', '', '', '', '', '', 'Ya', '', 'Tidak Ada', '', '1', '-7.4029', '108.2091', '', '50', '145', '0', '0', '1'),
(84941959, 'Zaki Muhammad Fauzi', '212207019', 'L', 'Tasikmalaya', '2008-03-04', '3278050403080005', 'Islam', 'Bugelan', '3', '10', 'Bugelan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '085222740375', '', '', 'Tidak', '', 'Wawan Hermawan', '1960', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Romlah', '1968', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2021', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', '', '1', '-7.4007', '108.2029', '', '55', '150', '0', '0', '1'),
(75198228, 'Ade Tegar Maulana', '202107001', 'L', 'Tasikmalaya', '2007-05-11', '3278051105070005', 'Islam', 'Bugelan', '2', '10', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '089524294244', '', '', 'Ya', '39Q2Q461820003', 'Maman', '1967', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Heni', '1972', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Ya', 'Pk99Ak', '0', '', '', 'Bank Bri', '445301001892500', 'Ade Tegar Maulana', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.399601', '1008.217256', '', '45', '158', '15', '0', '1'),
(75597303, 'Aulia Nurazizah', '202107002', 'P', 'Tasikmalaya', '2007-09-02', '3278054209070001', 'Islam', 'Bugelan', '3', '10', '', 'Gununggede', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '083129736961', '', '', 'Ya', '', 'Yoyo  S', '1966', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Lela  Nurlela', '1977', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Ya', 'Pp8Lza', '0', '', '', 'Bank Bri', '445301002194507', 'Aulia  Nurazizah', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '2', '-7.405885', '108.217804', '', '47', '148', '0', '1', '1'),
(82787492, 'Fatma Nuraliah', '202107003', 'P', 'Tasikmalaya', '2008-01-21', '3278056101080001', 'Islam', 'Bugelan', '3', '10', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '087797778413', '', '', 'Tidak', '', 'Iin  R', '1976', 'Sd / Sederajat', 'Buruh', 'Rp. 1,000,000 - Rp. 1,999,999', '', 'Epon Komariah', '1977', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '2', '-7.408673', '108.217816', '', '45', '148', '0', '2', '1'),
(76319455, 'Hilda Khoirunissa', '202107004', 'P', 'Tasikmalaya', '2007-09-14', '3278055409070003', 'Islam', 'Bugelan', '3', '6', '', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '089519211329', '', '', 'Tidak', '', 'Nono Sumarno', '1972', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Idah', '1974', '', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Sdn Sukasari', '1', '-7.4029', '108.2091', '', '40', '140', '20', '1', '1'),
(89953396, 'Hirsa Nuraisyah', '202107005', 'P', 'Tasikmalaya', '2008-03-04', '3278054403080002', 'Islam', 'Bugelan', '3', '6', '', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '083116657275', '', '', 'Ya', 'T45U3J', 'Idis', '1963', 'Sd / Sederajat', 'Buruh', 'Rp. 1,000,000 - Rp. 1,999,999', '', 'Lela Nurlela', '1973', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Ya', 'T45U3J', '0', '', '', 'Bank Bri', '445301003136502', 'Hirsa Nuraisyah', 'Ya', '', 'Tidak Ada', 'Sdn Sukasari', '4', '-7.4029', '108.2091', '', '46', '145', '0', '1', '1'),
(77304977, 'Irgi Faiz Nurramdhani', '202107006', 'L', 'Tasikmalaya', '2007-09-20', '3278052009070002', 'Islam', 'Bugelan', '1', '10', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '087797703993', '', '', 'Tidak', '', 'Uus', '1980', 'Sd / Sederajat', 'Buruh', 'Rp. 1,000,000 - Rp. 1,999,999', '', 'Erma', '1987', 'Smp / Sederajat', 'Pedagang Kecil', 'Rp. 500,000 - Rp. 999,999', '', '', '', '', '', '', '', '2020', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.399724', '108.216651', '', '43', '145', '0', '1', '1'),
(88357804, 'Laila Azkia', '202107007', 'P', 'Tasikmalaya', '2008-02-11', '3278055102080002', 'Islam', 'Bugelan', '4', '6', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '085381711802', '', '', 'Ya', '39Qxc46182005', 'Dudung', '1969', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Emay', '1976', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Ya', 'Pn3Pyp', '0', '', '', 'Bank Bri', '445301001918500', 'Laila Azkia', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.400862', '108.217707', '', '44', '143', '35', '1', '1'),
(78041399, 'Muhammad Arul Aulia', '202107008', 'L', 'Tasikmalaya', '2007-02-25', '3278052502070001', 'Islam', 'Bugelan', '2', '10', 'Bugelan', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '089686511717', '', '', 'Ya', 'T6Kvgx', 'Iwan Rustiawan', '1984', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Yulianti', '1988', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Ya', 'T6Kvgx', '0', '', '', 'Bank Bri', '445301002227504', 'Muhammad Arul Aulia', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.402733', '108.221019', '', '46', '140', '30', '0', '1'),
(72504732, 'Nizar Al Ghifari', '202107009', 'L', 'Tasikmalaya', '2007-09-30', '3278053009070004', 'Islam', 'Bugelan', '3', '6', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081221779217', '', '', 'Tidak', '', 'Endang Kurnia', '1983', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Ai Ina Karlina', '1987', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.403733', '108.222019', '', '43', '143', '0', '1', '1'),
(87611265, 'Nuri Alfiani', '202107010', 'P', 'Tasikmalaya', '2008-01-12', '3278055201080001', 'Islam', 'Bugelan', '2', '6', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '085878910929', '', '', 'Ya', '39Q2Y46182002', 'Toni', '1971', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Lasmini', '1982', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Ya', '', '0', '', '', 'Bank Bri', '445301002389500', 'Nuri Alfiani', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.394811', '108.213471', '3278051801080003', '46', '150', '0', '1', '1'),
(71189319, 'Razif Alvian Sidiq', '202107011', 'L', 'Tasikmalaya', '2007-07-24', '3278052407070003', 'Islam', 'Cibeas', '1', '10', 'Cibeas', 'Gununggede', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '089612608736', '', '', 'Ya', 'P5Wwbk', 'Aep Saepulloh', '1975', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Yeni Yuliani', '1979', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Ya', 'P5Wwbk', '0', '', '', 'Bank Bri', '445301001941503', 'Razif Alvian Sidiq', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '2', '-7.402353', '108.21561', '', '42', '151', '35', '1', '1'),
(72607200, 'Rifat Abdul Lazis', '202107012', 'L', 'Tasikmalaya', '2007-10-20', '3278052010070002', 'Islam', 'Bugelan', '4', '6', '', 'Bugelan', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '087888018921', '', '', 'Tidak', '', 'Jaja Miharja', '1981', 'Sd / Sederajat', 'Wiraswasta', 'Rp. 1,000,000 - Rp. 1,999,999', '', 'Lina Herlina', '1998', 'Smp / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '2', '-7.394284', '108.206379', '', '44', '143', '0', '1', '1'),
(82291638, 'Rizki Nugraha', '202107013', 'L', 'Tasikmalaya', '2008-03-13', '3278051303080003', 'Islam', 'Bugelan', '3', '10', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '089519233506', '', '', 'Tidak', '', 'Dodi Supriyadi', '1989', 'Sd / Sederajat', 'Buruh', 'Rp. 1,000,000 - Rp. 1,999,999', '', 'Elis', '1986', 'Smp / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', '', '1', '-7.400325', '108.217615', '', '46', '143', '0', '1', '1'),
(76382239, 'Rusmana', '202107014', 'L', 'Tasikmalaya', '2007-10-04', '3278050410070001', 'Islam', 'Bugelan', '5', '6', '', 'Gununggede', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '0821214321721', '', '', 'Ya', '39Q2To46182007', 'Cucu', '1965', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Maryam', '1971', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Ya', 'Plozqu', '0', '39Q2To', '', 'Bank Bri', '445301002809500', 'Rusmana', 'Ya', 'Pemegang Pkh/Kps/Kks', 'Tidak Ada', 'Sdn 2 Picungremuk', '2', '-7.406627', '108.219896', '', '45', '159', '0', '1', '1'),
(73982934, 'Syahdan Hasbi Asidiqi', '202107015', 'L', 'Tasikmalaya', '2007-09-19', '3278051909070002', 'Islam', 'Bugelan', '2', '6', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '083832510970', '', '', 'Tidak', '', 'Eni Rohaeni', '1975', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Lilis  Syamsiah', '1975', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Ya', 'Dinolx', '0', '', '', 'Bank Bri', '445301002453503', 'Syahdan Hasbi Asidiq', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.401308', '108.218538', '', '48', '145', '0', '1', '1'),
(77428633, 'Winda Wahdatul Mukromah', '202107016', 'P', 'Tasikmalaya', '2007-10-03', '3278054310070002', 'Islam', 'Bugelan', '4', '6', '', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '087742043753', '', '', 'Tidak', '', 'Mamat', '1971', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Dede Suryani', '1973', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2020', '', '', 'Ya', 'Ta9Zh2', '0', '', '', 'Bank Bri', '445301003192508', 'Winda Wahdatul Mukromah', 'Ya', '', 'Tidak Ada', 'Sdn Sukasari', '3', '-7.4029', '108.2091', '', '47', '144', '0', '1', '1'),
(64263229, 'Abdul Jamil Daris Salam', '192007001', 'L', 'Tasikmalaya', '2006-06-23', '3278052306060002', 'Islam', 'Bugelan', '3', '11', 'Bugelan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '082115102823', '', 'Dn-02 Dd 09072001     ', 'Tidak', '', 'Urip', '1981', 'Smp / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '3278050403810001', 'Kokom', '1986', 'Sma / Sederajat', 'Buruh', 'Kurang Dari Rp. 500,000', '3278055210860006', '', '', '', '', '', '', '2019', '1-19-02-09-072-001-8  ', 'Dn-02/D-Sd/13/0774920', 'Tidak', '', '0', '', '', '', '', '', 'Ya', 'Siswa Miskin/Rentan Miskin', 'Tidak Ada', 'Sdn Sukasari', '1', '-7.4029', '108.2091', '', '40', '154', '53', '1', '1'),
(62676364, 'Abdul Muhamad Jarnuji Napis', '192007002', 'L', 'Tasikmalaya', '2006-08-09', '3206080908060001', 'Islam', 'Kp. Lemburgede', '', '', '', 'Wangunsari', 'Kec. Bantarkalong', '', 'Pesantren', 'Jalan Kaki', '', '082123703900', '', 'Dn-02 Dd-26-289-002   ', 'Tidak', '', 'Arip Rahman Hakim', '1976', '', 'Wiraswasta', 'Rp. 500,000 - Rp. 999,999', '3206080707760001', 'Elin', '1984', 'Sma / Sederajat', 'Petani', 'Rp. 500,000 - Rp. 999,999', '3206084101840010', '', '', 'Sma / Sederajat', 'Wiraswasta', '', '', '2019', '1-19-02-26-289-002-7  ', 'Dn-02/D-Sd/13/0540059', 'Tidak', '', '1', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Sdn Wangunsari', '1', '-7.403186', '108.213582', '', '45', '155', '54', '3', '0'),
(66849244, 'Aidil Putra', '192007003', 'L', 'Tasikmalaya', '2006-10-24', '3278052410060003', 'Islam', 'Sukasari', '2', '11', 'Sukasari', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '082126115304', '', 'Dn-02 Dd 09072004     ', 'Tidak', '', 'Aa Kurnia', '1976', 'Smp / Sederajat', 'Buruh', 'Kurang Dari Rp. 500,000', '', 'Titin', '1973', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', '', '', '', '', '', '', '2019', '1-19-02-09-072-004-5  ', 'Dn-02/D-Sd/13/0774923', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Sdn Sukasari', '2', '-7.4029', '108.2091', '', '45', '145', '54', '2', '0'),
(67300166, 'Aldi Aryadi Pratama', '192007004', 'L', 'Tasikmalaya', '2006-09-09', '3278050909060004', 'Islam', 'Neglasari', '1', '2', 'Pameutingan', 'Pameutingan', 'Kec. Cipatujah', '46189', 'Bersama Orang Tua', 'Jalan Kaki', '', '081310197101', '', 'Dd-26-0015-0004-5     ', 'Tidak', '', 'Heryaman', '1983', 'Smp / Sederajat', 'Wiraswasta', 'Kurang Dari Rp. 500,000', '3278052811830002', 'Sinta', '1987', 'Smp / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278054710860008', '', '', '', '', '', '', '2019', '1-19-02-26-0015-0004  ', 'Dn-02/D-Sd/06/0142089', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Smp Negeri Satu Atap 4 Cipatujah', '1', '-7.6772', '107.9673', '3206010303160006', '30', '145', '45', '0', '1'),
(68570440, 'Aldi Supriatna', '192007005', 'L', 'Tasikmalaya', '2006-06-05', '3278050506060003', 'Islam', 'Cibeas', '1', '10', '', 'Gununggede', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '083854822665', '', 'Dn-02 Dd 09065057     ', 'Tidak', '', 'Asep Yudianto', '1980', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '3278051804800002', 'Ai Resti Andriani', '1984', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278056004840003', '', '', '', '', '', '', '2019', '1-19-02-09-065-057-8  ', 'Dn-02/D-Sd/13/0774705', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.398929', '108.215117', '', '65', '150', '57', '1', '0'),
(138638524, 'Amri Abdul Aziz', '192007006', 'L', 'Tasikmalaya', '2006-03-06', '3278050603060004', 'Islam', 'Bugelan', '2', '10', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081913500159', '', 'Dn-02 Dd 090065031    ', 'Tidak', '', 'Apep', '1977', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '3278052707770005', 'Kokom', '1983', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278055509830003', '', '', '', '', '', '', '2019', '1-19-02-09-065-031-2  ', 'Dn-02/D-Sd/13/0774679', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.399601', '1008.217256', '', '50', '161', '55', '1', '0'),
(74135424, 'Ana Silpia Apipah', '192007007', 'P', 'Tasikmalaya', '2007-08-08', '3278054808070001', 'Islam', 'Bugelan', '3', '6', 'Kp. Bugelan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '087747137808', '', 'Dn-02 Dd 090072005    ', 'Tidak', '', 'Abdul Somad', '1972', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '3278051908720001', 'Tika', '1977', 'Informal', 'Lainnya', 'Tidak Berpenghasilan', '3278058308770005', '', '', 'Tidak Sekolah', '', '', '', '2019', '1-19-02-09-072-005-4  ', 'Dn-02/D-Sd/13/0774924', 'Tidak', '', '0', '', '', '', '', '', 'Ya', 'Siswa Miskin/Rentan Miskin', 'Tidak Ada', 'Sdn Sukasari', '2', '-7.4029', '108.2091', '', '50', '160', '57', '2', '1'),
(72406611, 'Andini Rahma Pebrianti', '192007008', 'P', 'Tasikmalaya', '2007-02-07', '3278054702070001', 'Islam', 'Cibeas', '1', '10', 'Bugelan', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '087826052876', '', 'Dn-02 Dd 090065059    ', 'Ya', '39Q2Re46182008', 'Syarip Hidayatuloh', '1984', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '3278051006840005', 'Desi Susanti', '1987', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278054612870003', '', '', '', '', '', '', '2019', '1-19-02-09-065-059-6  ', 'Dn-02/D-Sd/13/0774710', 'Ya', 'Pkv1X6', '0', '', '', 'Bank Bri', '445301002397503', 'Andini Rahma Pebrianti', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.40066', '108.216013', '', '40', '150', '54', '1', '1'),
(52225485, 'Ayu Lestari Firmansyah', '192007009', 'P', 'Tasikmalaya', '2006-09-05', '3278054509060007', 'Islam', 'Bugelan', '3', '10', 'Bugelan', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '085336266925', '', 'Dn-02 Dd 090065032    ', 'Ya', '', 'Ayep Yayat P', '1982', 'Smp / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '3278053110820001', 'Epa Nurhayati', '1985', 'Smp / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278055705850004', '', '', '', '', '', '', '2019', '1-19-2-09-065-032-9   ', 'Dn-02/D-Sd/13/0774680', 'Ya', 'T1S18U', '0', '', '', 'Bank Bri', '445301002231503', 'Ayu Lestari Firmansyah', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.409673', '108.218816', '', '60', '150', '57', '1', '1'),
(66453869, 'Azka Nugraha', '192007010', 'L', 'Tasikmalaya', '2006-03-30', '3278053003060002', 'Islam', 'Bugelan', '3', '10', 'Bugelan', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081312505308', '', 'Dn-02 Dd 090065033    ', 'Tidak', 'T1Tl1X', 'Wawan ', '1969', 'Smp / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Omah', '1974', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2019', '1-19-02-09-065-033-8  ', 'Dn-02/D-Sd/13/0774681', 'Ya', 'T1Tl1X', '0', '', '', 'Bank Bri', '445301002409504', 'Azka Nugraha', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '2', '-7.403733', '108.222019', '', '55', '154', '53', '2', '0'),
(71034270, 'Dela Aulia Rahmah', '192007011', 'P', 'Tasikmalaya', '2007-01-24', '3278056401070001', 'Islam', 'Bugelan', '3', '6', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '089530058275', '', 'Dn-02 Dd 090065062    ', 'Tidak', '', 'Suparman', '1970', 'Smp / Sederajat', 'Pedagang Kecil', 'Rp. 1,000,000 - Rp. 1,999,999', '3278051003700001', 'Adah', '1980', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278055508800010', '', '', '', '', '', '', '2019', '1-19-02-09-065-062-3  ', 'Dn-02/D-Sd/13/0774710', 'Tidak', '', '0', '', '', '', '', '', 'Ya', 'Siswa Miskin/Rentan Miskin', 'Tidak Ada', 'Sdn 2 Picungremuk', '2', '-7.409601', '108.317256', '', '38', '150', '53', '2', '1'),
(61334652, 'Gagan Nugraha', '192007012', 'L', 'Tasikmalaya', '2006-07-07', '3278050707060002', 'Islam', 'Bugelan', '2', '10', 'Bugelan', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '083825918681', '', 'Dn-02 Dd 090065041    ', 'Ya', 'T3Q1Uu', 'Mamad Rahmat', '1984', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '3278050607840003', 'Nina Marlina', '1990', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278054102900007', '', '', '', '', '', '', '2019', '1-19-02-09-065-041-8  ', 'Dn-02/D-Sd/13/0774689', 'Ya', 'T3Q1Uu', '0', '', '', 'Bank Bri', '445301002603506', 'Gagan Nugraha', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '1', '-7.40856', '108.22092', '', '50', '157', '54', '1', '0'),
(62651111, 'Hilma Nurul Arofah', '192007013', 'P', 'Tasikmalaya', '2006-12-29', '3278056912060002', 'Islam', 'Bugelan', '3', '11', 'Bugelan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '087836281793', '', 'Dn-02 Dd 090072010    ', 'Tidak', '', 'Saipul Aripin', '1978', 'Sma / Sederajat', 'Wiraswasta', 'Rp. 1,000,000 - Rp. 1,999,999', '3278052508780006', 'Ida Rosyidah', '1984', 'Sma / Sederajat', 'Pedagang Kecil', 'Rp. 500,000 - Rp. 999,999', '3278055810840006', '', '', '', '', '', '', '2019', '1-19-02-09-072-010-7  ', 'Dn-02/D-Sd/13/0774929', 'Ya', 'Pydxyi', '0', '', '', 'Bank Bri', '445301002956501', 'Hilma Nurul Arofah', 'Ya', '', 'Tidak Ada', 'Sdn Sukasari', '1', '-7.4029', '108.2091', '', '40', '140', '54', '1', '1'),
(65437884, 'Indri Rahmawati', '192007014', 'P', 'Tasikmalaya', '2006-06-24', '3278056406060003', 'Islam', 'Bugelan', '3', '10', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081904035893', '', 'Dn-02 Dd 09065042     ', 'Ya', '39Q29P46182003', 'Hoer Apandi', '1952', 'Smp / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '', 'Julaeha', '1965', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278056209660002', '', '', '', '', '', '', '2019', '1-19-02-09-065-042-7  ', 'Dn-02/D-Sd/13/0774690', 'Tidak', '', '0', '39Q29P', '', '', '', '', 'Ya', 'Pemegang Pkh/Kps/Kks', 'Tidak Ada', 'Sdn 2 Picungremuk', '2', '-7.411308', '108.219538', '', '35', '150', '54', '2', '1'),
(74960870, 'Insan Kamil', '192007015', 'L', 'Tasikmalaya', '2007-03-31', '3278063103070002', 'Islam', 'Bugelan', '1', '6', '', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '089502111778', '', 'Dn-02 Dd 09072011     ', 'Ya', '39Q1Q446196003', 'Yosi Ginanjar', '1979', '', 'Wiraswasta', 'Rp. 500,000 - Rp. 999,999', '', 'Alis Solihah', '1986', '', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '', '', '', '2019', '1-19-02-09-072-011-6  ', 'Dn-02/D-Sd/13/0774930', 'Tidak', '', '0', '', '', '', '', '', 'Ya', 'Pemegang Pkh/Kps/Kks', 'Tidak Ada', 'Sdn Sukasari', '1', '-7.4029', '108.2091', '', '40', '148', '52', '1', '1'),
(68915077, 'Muhamad Ikbal', '192007016', 'L', 'Tasikmalaya', '2006-12-07', '3278050712060004', 'Islam', 'Sukasari', '3', '11', 'Sukasari', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081218802501', '', 'Dn-02 Dd 09072016     ', 'Tidak', 'T6Hops', 'Dede Sukiman', '1971', 'Sd / Sederajat', 'Buruh', 'Kurang Dari Rp. 500,000', '3278052012760016', 'Sri Lestari', '1979', 'Sd / Sederajat', 'Buruh', 'Kurang Dari Rp. 500,000', '3278056012790020', '', '', '', '', '', '', '2019', '1-19-02-09-072-016-9  ', 'Dn-02/D-Sd/13/0774935', 'Ya', '', '0', '', '', 'Bank Bri', '445301002943508', 'Muhamad Ikbal', 'Ya', '', 'Tidak Ada', 'Sdn Sukasari', '2', '-7.4029', '108.2091', '', '40', '150', '53', '2', '0'),
(67963913, 'Neng Teni', '192007017', 'P', 'Lebak', '2006-05-21', '3602106105060001', 'Islam', 'Kp Cijeruk Girang ', '5', '4', '', 'Cibeuti', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '081929711759', '', 'Dn Dd 09000910019-6   ', 'Tidak', '', 'Kodir', '1982', 'Smp / Sederajat', 'Karyawan Swasta', 'Rp. 1,000,000 - Rp. 1,999,999', '3602100808820003', 'Ida Maesaroh', '1977', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3602105708770003', '', '', '', 'Tidak Bekerja', '', '', '2019', '19-02-09-0091-0019-6  ', 'Mi-13 100017843', 'Tidak', '', '1', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Mi Miftahul Falah', '2', '-7.403186', '108.213582', '', '50', '155', '53', '2', '1'),
(51209869, 'Novan Alparizi', '192007018', 'L', 'Tasikmalaya', '2005-11-20', '3278052011050001', 'Islam', 'Bugelan', '3', '10', '', 'Gunungtandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '089524294234', '', 'Dn-2 Dd 09065045      ', 'Tidak', '', 'Eman', '1963', 'Sd / Sederajat', 'Pedagang Kecil', 'Rp. 500,000 - Rp. 999,999', '3278051111610004', 'Engkoy', '1966', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278056103660001', '', '', '', '', '', '', '2019', '1-19-02-09-065-045-4  ', 'Dn-02/D-Sd/13/0774693', 'Tidak', '', '0', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '2', '-7.406885', '108.218804', '', '65', '166', '55', '1', '0'),
(68415426, 'Parid Ridwan', '192007019', 'L', 'Tasikmalaya', '2006-07-29', '3278052907060006', 'Islam', 'Bugelan', '3', '11', 'Bugelan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '087872885912', '', 'Dn-02 Dd 09072190     ', 'Tidak', '', 'Kindi', '1953', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '3278051605530001', 'Emin', '1962', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278056804620001', '', '', '', '', '', '', '2019', '1-19-02-09-072-190-6  ', 'Dn-02/D-Sd/13/0774938', 'Ya', 'T7Kn2E', '0', '', '', 'Bank Bri', '445301002876507', 'Parid Ridwan', 'Ya', '', 'Tidak Ada', 'Sdn Sukasari', '4', '-7.4029', '108.2091', '', '40', '150', '51', '3', '0'),
(76899596, 'Rifdayanti Zulfia', '192007020', 'P', 'Tasikmalaya', '2007-02-28', '3278056802070004', 'Islam', 'Bugelan', '2', '3', 'Bugelan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '087820093773', '', 'Dn-02 Dd 09072023     ', 'Tidak', '', 'Herman', '1968', 'Sd / Sederajat', 'Pedagang Kecil', 'Rp. 500,000 - Rp. 999,999', '3278051205680006', 'Oon', '1972', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278054214720002', '', '', '', '', '', '', '2019', '1-19-02-09-072-023-2  ', 'Dn-02/D-Sd/13/0774942', 'Ya', 'Pvjx04', '0', '', '', 'Bank Bri', '445301002930505', 'Rifdayanti Zulfia', 'Ya', '', 'Tidak Ada', 'Sdn Sukasari', '2', '-7.4029', '108.2091', '', '48', '154', '54', '2', '1'),
(2147483647, 'Ripan Nugraha', '192007021', 'L', 'Tasikmalaya', '2006-11-15', '3206085511060003', 'Islam', 'Kp. Pencutkondang', '', '', '', 'Wakap', 'Kec. Bantarkalong', '', 'Bersama Orang Tua', 'Jalan Kaki', '', '081914432347', '', '', 'Tidak', '', 'Ujun', '1974', 'Sd / Sederajat', 'Petani', 'Rp. 500,000 - Rp. 999,999', '3206084604740003', 'Ujum', '0', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '0000000000000000', '', '', 'Sd / Sederajat', 'Petani', '', '3206084604740003', '2019', '', '', 'Tidak', '', '1', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', 'Mts Miftahul Ulum', '1', '-7.403186', '108.213582', '', '45', '150', '0', '1', '1'),
(2147483647, 'Rizki Ramdhani', '192007022', 'L', 'Tasikmalaya', '2006-09-25', '3278052509060004', 'Islam', 'Pasir Datar', '', '', '', 'Gunung Gede', 'Kec. Kawalu', '', 'Bersama Orang Tua', 'Jalan Kaki', '', '083869868392', '', '', 'Tidak', '', 'Budi Wahyudi', '1976', 'Sd / Sederajat', 'Wiraswasta', 'Rp. 1,000,000 - Rp. 1,999,999', '3278050808760010', 'Evi Handayani', '1981', 'Smp / Sederajat', 'Tidak Bekerja', 'Kurang Dari Rp. 500,000', '3278054506810017', '', '1976', 'Sd / Sederajat', 'Wiraswasta', '', '3278050808760010', '2019', '', '', 'Tidak', '', '1', '', '', '', '', '', 'Tidak', '', 'Tidak Ada', '', '2', '-7.403186', '108.213582', '', '45', '145', '0', '1', '1'),
(72692889, 'Salma Zakiyah', '192007023', 'P', 'Tasikmalaya', '2007-03-31', '3278057103070001', 'Islam', 'Bugelan', '2', '6', 'Bugelan', 'Gununggede', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '082317637502', '', 'Dn-02 Dd 09065051     ', 'Tidak', 'Dinpj0', 'Dian Haeroni', '1976', 'Smp / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '3278050504760004', 'Ani Sumarni', '1981', 'Smp / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278056703810001', '', '', '', '', '', '', '2019', '1-19-02-09-065-051-6  ', 'Dn-02/D-Sd/13/0774699', 'Ya', 'Dinpj0', '0', '', '', 'Bank Bri', '445301002826502', 'Salma Zakiyah', 'Ya', '', 'Tidak Ada', 'Sdn 2 Picungremuk', '2', '-7.393172', '108.212016', '', '65', '167', '58', '2', '1'),
(61730037, 'Sofi Sopiawati', '192007024', 'P', 'Tasikmalaya', '2006-06-20', '3278056006060010', 'Islam', 'Bugeulan', '3', '6', 'Bugeulan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '083108456430', '', 'Dn-02 Dd 09072032     ', 'Ya', '', 'Entis Sutisna', '1967', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '3278050101670010', 'Ita', '1977', 'Sd / Sederajat', 'Lainnya', 'Tidak Berpenghasilan', '3278054101760018', '', '', '', '', '', '', '2019', '1-19-02-09-072-032-9  ', 'Dn-0/D-Sd/13/0774951', 'Ya', 'T9G39O', '0', '', '', 'Bank Bri', '445301003201501', 'Sofi Sopiawati', 'Ya', '', 'Tidak Ada', 'Sdn Sukasari', '3', '-7.4029', '108.2091', '', '46', '148', '56', '3', '1'),
(79798077, 'Yayu Purnamasari', '192007025', 'P', 'Tasikmalaya', '2007-01-04', '3278054401070003', 'Islam', 'Bugelan', '2', '4', 'Bugelan', 'Gunung Tandala', 'Kec. Kawalu', '46182', 'Bersama Orang Tua', 'Jalan Kaki', '', '085942088515', '', 'Dn-02 Dd 09072033     ', 'Tidak', 'Pqdjm8', 'Jojo', '1966', 'Sd / Sederajat', 'Buruh', 'Rp. 500,000 - Rp. 999,999', '3278051008660005', 'Dede Uyum', '1972', 'Sd / Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '3278055401720002', '', '', '', '', '', '', '2019', '1-19-02-09-072-033-8  ', 'Dn-02/D-Sd/13/0774952', 'Ya', 'Pqdjmb', '0', '', '', '', '', '', 'Ya', '', 'Tidak Ada', 'Sdn Sukasari', '4', '-7.4029', '108.2091', '3278050803070003', '35', '145', '53', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `trash_finance`
--

CREATE TABLE `trash_finance` (
  `id` int(11) NOT NULL,
  `inv` text NOT NULL,
  `date` text NOT NULL,
  `period` text NOT NULL,
  `account` text NOT NULL,
  `vendor` text NOT NULL,
  `des` text NOT NULL,
  `remark` text NOT NULL,
  `debit` text NOT NULL,
  `credit` text NOT NULL,
  `admin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trash_finance`
--

INSERT INTO `trash_finance` (`id`, `inv`, `date`, `period`, `account`, `vendor`, `des`, `remark`, `debit`, `credit`, `admin`) VALUES
(1, 'FC-33732', '2021-04-28', 'Apr 2021', '000225', 'ibu seni', 'Mukafaah bulanan', 'mukafaah bulan april 2021', '0', '300000', 'Abu Kafa'),
(2, 'FC-33732', '2021-04-28', 'Apr 2021', '000225', 'Usth Ghaida', 'Mukafaah bulanan', 'mukafaah bulan april 2021', '0', '550000', 'Abu Kafa'),
(3, '', '', 'Dec 2021', '', '', '', '', '', '0', 'Abu Kafa'),
(4, '', '', 'Dec 2021', '', '', '', '', '', '0', 'Abu Kafa'),
(5, '', '', 'Dec 2021', '', '', '', '', '', '0', 'Abu Kafa'),
(6, '', '', 'Dec 2021', '', '', '', '', '', '0', 'Abu Kafa'),
(7, '', '2021-12-06', 'Dec 2021', '11002', 'MR', 'Semen 10 sak', 'Bangunan', '500000', '0', 'Abu Kafa'),
(8, 'FC-33732', '2021-04-28', 'Apr 2021', '000225', 'Ust Maruf', 'Mukafaah bulanan', 'mukafaah bulan april 2021', '0', '725000', 'Abu Kafa'),
(9, 'FC-33732', '2021-04-28', 'Apr 2021', '000225', 'ust Asep', 'Mukafaah bulanan', 'mukafaah bulan april 2021', '0', '875000', 'Abu Kafa'),
(10, 'FC-33732', '2021-04-28', 'Apr 2021', '000225', 'Ust Hakim', 'Mukafaah bulanan', 'mukafaah bulan april 2021', '0', '900000', 'Abu Kafa'),
(11, 'FC-33732', '2021-04-28', 'Apr 2021', '000225', 'Ust Askar', 'Mukafaah bulanan', 'mukafaah bulan april 2021', '0', '700000', 'Abu Kafa'),
(12, 'FC-633333', '25-12-2021', 'Dec 2021', '000222', 'Mirah Rejeki', 'papan dan GRC', 'bangunan saung sawah', '0', '200000', 'Abu Kafa'),
(13, 'FC-633333', '25-12-2021', 'Dec 2021', '000222', 'habi', 'Bayar tukang', 'bangunan saung sawah', '0', '420000', 'Abu Kafa'),
(14, 'FC-633333', '25-12-2021', 'Dec 2021', '000225', 'warung depan', 'Air minum', 'bangunan saung sawah', '0', '20000', 'Abu Kafa'),
(15, 'FC-633333', '25-12-2021', 'Dec 2021', '000222', 'warung depan', 'nasi padang', 'bangunan saung sawah', '0', '50000', 'Abu Kafa'),
(16, 'FC-633333', '25-12-2021', 'Dec 2021', '000223', 'habi', 'bayar yang kerja', 'bangunan saung sawah', '0', '300000', 'Abu Kafa'),
(17, 'FC-286483', '13-12-2021', 'Dec 2021', '000225', 'Bengkel AHAS', 'Reparasi Motor Ust. Askar', 'Transport', '0', '550000', 'Abu Kafa'),
(18, 'FC-63395311', '13-12-2021', 'Dec 2021', '000223', 'DST', 'Bayar kontrakan', 'mukafaah oktober 2020', '0', '400000', 'Abu Kafa'),
(19, 'FC-63395311', '13-12-2021', 'Dec 2021', '000225', 'Usth Lala', 'Mukafaah bulanan', 'mukafaah oktober 2020', '0', '500000', 'Abu Kafa'),
(20, 'FC-63395311', '13-12-2021', 'Dec 2021', '000225', 'Usth Ghaida', 'Mukafaah bulanan', 'mukafaah oktober 2020', '0', '500000', 'Abu Kafa'),
(21, 'FC-63395311', '13-12-2021', 'Dec 2021', '000225', 'Usth Dea', 'Mukafaah bulanan', 'mukafaah oktober 2020', '0', '450000', 'Abu Kafa'),
(22, 'FC-63395311', '13-12-2021', 'Dec 2021', '000225', 'Ms.Tia', 'Mukafaah bulanan', 'mukafaah oktober 2020', '0', '650000', 'Abu Kafa'),
(23, 'FC-63395311', '13-12-2021', 'Dec 2021', '000225', 'Pak Koswara', 'Mukafaah bulanan', 'mukafaah oktober 2020', '0', '500000', 'Abu Kafa'),
(24, 'FC-63395311', '13-12-2021', 'Dec 2021', '000225', 'Ust Askar', 'Mukafaah bulanan', 'mukafaah oktober 2020', '0', '500000', 'Abu Kafa'),
(25, 'FC-63395311', '13-12-2021', 'Dec 2021', '000225', 'Ust Maruf', 'Mukafaah bulanan', 'mukafaah oktober 2020', '0', '650000', 'Abu Kafa'),
(26, 'FC-63395311', '13-12-2021', 'Dec 2021', '000225', 'ust Asep', 'Mukafaah bulanan', 'mukafaah oktober 2020', '0', '600000', 'Abu Kafa'),
(27, 'FC-63395311', '13-12-2021', 'Dec 2021', '000225', 'Ust Hakim', 'Mukafaah bulanan', 'mukafaah oktober 2020', '0', '650000', 'Abu Kafa'),
(28, 'FC-63395311', '13-12-2021', 'Dec 2021', '000225', 'Ust Abu', 'Mukafaah bulanan', 'mukafaah oktober 2020', '0', '750000', 'Abu Kafa'),
(29, 'FC-63395312', '15-05-2021', 'May 2021', '000223', 'Ust Maruf', 'Bayar kontrakan', 'mukafaah september 2020', '0', '400000', 'Abu Kafa'),
(30, 'FC-63395312', '15-05-2021', 'May 2021', '000225', 'Usth Lala', 'Mukafaah bulanan', 'mukafaah september 2020', '0', '500000', 'Abu Kafa'),
(31, 'FC-63395312', '15-05-2021', 'May 2021', '000225', 'Usth Ghaida', 'Mukafaah bulanan', 'mukafaah september 2020', '0', '500000', 'Abu Kafa'),
(32, 'FC-63395312', '15-05-2021', 'May 2021', '000225', 'Usth Dea', 'Mukafaah bulanan', 'mukafaah september 2020', '0', '450000', 'Abu Kafa'),
(33, 'FC-63395312', '15-05-2021', 'May 2021', '000225', 'Ms.Tia', 'Mukafaah bulanan', 'mukafaah september 2020', '0', '650000', 'Abu Kafa'),
(34, 'FC-63395312', '15-05-2021', 'May 2021', '000225', 'Pak Koswara', 'Mukafaah bulanan', 'mukafaah september 2020', '0', '500000', 'Abu Kafa'),
(35, 'FC-63395312', '15-05-2021', 'May 2021', '000225', 'Ust Maruf', 'Mukafaah bulanan', 'mukafaah september 2020', '0', '650000', 'Abu Kafa'),
(36, 'FC-63395312', '15-05-2021', 'May 2021', '000225', 'Ust Askar', 'Mukafaah bulanan', 'mukafaah september 2020', '0', '500000', 'Abu Kafa'),
(37, 'FC-63395312', '15-05-2021', 'May 2021', '000225', 'ust Asep', 'Mukafaah bulanan', 'mukafaah september 2020', '0', '600000', 'Abu Kafa'),
(38, 'FC-63395312', '15-05-2021', 'May 2021', '000225', 'Ust Hakim', 'Mukafaah bulanan', 'mukafaah september 2020', '0', '650000', 'Abu Kafa'),
(39, 'FC-63395312', '15-05-2021', 'May 2021', '000225', 'Ust Abu', 'Mukafaah bulanan', 'mukafaah september 2020', '0', '750000', 'Abu Kafa'),
(40, 'FC-636609', '25-12-2021', 'Dec 2021', '000223', 'pasar', 'roti bakar', 'kajian guru habi', '0', '100000', 'Abu Kafa'),
(41, 'FC-636609', '25-12-2021', 'Dec 2021', '000223', 'pasar', 'mie goreng dan minuman', 'kajian guru habi', '0', '130000', 'Abu Kafa'),
(42, 'FC-636609', '25-12-2021', 'Dec 2021', '000225', 'ust iqbal', 'Mukafaah Ust. Iqbal', 'kajian guru habi', '0', '100000', 'Abu Kafa'),
(43, 'FC-636609', '25-12-2021', 'Dec 2021', '000223', 'pasar', 'martabak', 'kajian guru habi', '0', '100000', 'Abu Kafa'),
(44, 'FC-636609', '25-12-2021', 'Dec 2021', '000225', 'ust iqbal', 'mukafaah ust iqbal', 'kajian guru habi', '0', '50000', 'Abu Kafa'),
(45, 'FC-636609', '25-12-2021', 'Dec 2021', '000223', 'pasar', 'martabak', 'kajian guru habi', '0', '100000', 'Abu Kafa'),
(46, 'FC-636609', '25-12-2021', 'Dec 2021', '000225', 'ust hakim', 'pinjaman', 'pinjaman', '0', '1000000', 'Abu Kafa'),
(47, 'FC-636609', '25-12-2021', 'Dec 2021', '000223', 'ust iqbal', 'mukafaah ust iqbal', 'kajian guru habi', '0', '150000', 'Abu Kafa'),
(48, 'FC-637709', '15-05-2021', 'May 2021', '000225', 'ust iqbal', 'mukafaah ust iqbal', 'kajian guru habi', '0', '50000', 'Abu Kafa'),
(49, 'FC-637709', '15-05-2021', 'May 2021', '000225', 'warung depan', 'gorengan', 'kajian guru habi\r\n', '0', '30000', 'Abu Kafa'),
(50, 'FC-637709', '15-05-2021', 'May 2021', '000225', 'ust iqbal', 'mukafaah ust iqbal', 'kajian guru habi', '0', '100000', 'Abu Kafa'),
(51, 'FC-637709', '15-05-2021', 'May 2021', '000225', 'pasar', 'roti bakar', 'kajian guru habi\r\n', '0', '100000', 'Abu Kafa'),
(52, 'FC-637709', '15-05-2021', 'May 2021', '000225', 'pasar', 'martabak', 'kajian guru habi\r\n', '0', '98200', 'Abu Kafa'),
(53, 'FC-637709', '15-05-2021', 'May 2021', '000223', 'ust iqbal', 'mukafaah ust iqbal', 'kajian guru habi', '0', '100000', 'Abu Kafa'),
(54, 'FC-637709', '15-05-2021', 'May 2021', '000223', 'pasar', 'mie goreng', 'kajian guru habi\r\n', '0', '100000', 'Abu Kafa'),
(55, 'FC-637709', '15-05-2021', 'May 2021', '000225', 'ust iqbal', 'mukafaah ust iqbal', 'kajian guru habi', '0', '50000', 'Abu Kafa'),
(56, 'FC-639993', '15-05-2021', 'May 2021', '000222', 'habi', 'untuk wc', 'Gabungan', '0', '500000', 'Abu Kafa'),
(57, 'FC-639993', '15-05-2021', 'May 2021', '000223', 'habi', 'bayar ke gasela', 'Gabungan', '0', '30000', 'Abu Kafa'),
(58, 'FC-639993', '15-05-2021', 'May 2021', '000223', 'habi', 'bulanan wifi', 'Gabungan', '0', '50000', 'Abu Kafa'),
(59, 'FC-639993', '15-05-2021', 'May 2021', '000223', 'gasela', 'bayar ke gasela', 'Gabungan', '0', '50000', 'Abu Kafa'),
(60, 'FC-639993', '15-05-2021', 'May 2021', '000223', 'warung depan', 'beli amplop', 'Gabungan', '0', '5000', 'Abu Kafa'),
(61, 'FC-639993', '15-05-2021', 'May 2021', '000223', 'warung depan', 'aqua botol 2', 'Gabungan', '0', '6000', 'Abu Kafa'),
(62, 'FC-639993', '15-05-2021', 'May 2021', '000223', 'Tokopedia', 'buku', 'Gabungan', '0', '200000', 'Abu Kafa'),
(63, 'FC-37370230', '25-12-2021', 'Dec 2021', '000223', 'Toko AA', ' 2plastik display document', 'Kantor', '0', '34000', 'Abu Kafa'),
(64, 'FC-37370230', '25-12-2021', 'Dec 2021', '000223', 'Toko AA', ' 5 spidol ', 'Kantor', '0', '26000', 'Abu Kafa'),
(65, 'FC-37370230', '25-12-2021', 'Dec 2021', '000223', 'Toko AA', 'cuter joyko', 'Kantor', '0', '15000', 'Abu Kafa'),
(66, 'FC-37370230', '25-12-2021', 'Dec 2021', '000223', 'Toko AA', 'pulpen ', 'Kantor', '0', '6000', 'Abu Kafa'),
(67, 'FC-37370230', '25-12-2021', 'Dec 2021', '000223', 'Toko AA', 'kertas glosi A4', 'Kantor', '0', '36000', 'Abu Kafa'),
(68, 'FC-37370230', '25-12-2021', 'Dec 2021', '000223', 'Toko AA', 'kertas jilid bufallo f4', 'Kantor', '0', '25000', 'Abu Kafa'),
(69, 'FC-37370230', '25-12-2021', 'Dec 2021', '000223', 'Toko AA', 'Mistar besi', 'Kantor', '0', '11500', 'Abu Kafa'),
(70, 'FC-37370230', '25-12-2021', 'Dec 2021', '000223', 'Toko AA', 'Mistar', 'Kantor', '0', '38000', 'Abu Kafa'),
(71, 'FC-666953', '0000-00-00', 'May 2021', '000223', 'pantai pangandaran', 'ongkos perahu', 'rapat guru', '0', '200000', 'Abu Kafa'),
(72, 'FC-666953', '0000-00-00', 'May 2021', '000223', 'AGJ', 'ayam geprek', 'rapat guru', '0', '287100', 'Abu Kafa'),
(73, 'FC-666953', '0000-00-00', 'May 2021', '000223', 'alfamart', 'mie goreng, minum, cemilan,dll', 'rapat guru', '0', '243000', 'Abu Kafa'),
(74, 'FC-63395366', '2021-12-30', 'Dec 2021', '000223', 'pasar', 'white board', 'white board', '0', '500000', 'Abu Kafa'),
(75, 'FC-999953', '2021-12-30', 'Dec 2021', '000224', 'Rizka', 'pembayaran baju olahraga', 'seragam', '0', '1900000', 'Abu Kafa'),
(76, 'FC-333953', '2021-12-30', 'Dec 2021', '000224', 'el hisyami', 'rompi', 'rompi', '0', '1500000', 'Abu Kafa'),
(77, 'FC-633909', '2021-12-30', 'Dec 2021', '000225', 'ust iqbal', 'mukafaah ust iqbal', 'kajian guru habi', '0', '50000', 'Abu Kafa'),
(78, 'FC-2359300', '2021-12-30', 'Dec 2021', '000225', 'Mie ayam kujang', 'Konsumsi Rapat', 'Konsumsi', '0', '80000', 'Abu Kafa'),
(79, 'FC-87543373', '2021-12-30', 'Dec 2021', '000223', 'pasar', 'lampu dan lilin', 'mabit', '0', '60000', 'Abu Kafa'),
(80, 'FC-87543373', '2021-12-30', 'Dec 2021', '000223', 'pasar', 'galon', 'mabit', '0', '3000', 'Abu Kafa'),
(81, 'FC-87543373', '2021-12-30', 'Dec 2021', '000223', 'pasar', 'batre', 'mabit', '0', '20000', 'Abu Kafa'),
(82, 'FC-22098', '2021-12-30', 'Dec 2021', '000223', 'sarana sport', '3 bola kasti', 'perlengkapan olahraga', '0', '25000', 'Abu Kafa'),
(83, 'FC-22098', '2021-12-30', 'Dec 2021', '000223', 'sarana sport', '1 BS Fiesta', 'perlengkapan olahraga', '0', '95000', 'Abu Kafa'),
(84, 'FC-633988', '2021-12-30', 'Dec 2021', '000223', 'habi', 'bulanan wifi', 'Gabungan', '0', '100000', 'Abu Kafa'),
(85, 'FC-633988', '2021-12-30', 'Dec 2021', '000223', 'pasar', 'selang gas', 'Gabungan', '0', '50000', 'Abu Kafa'),
(86, 'FC-633988', '2021-12-30', 'Dec 2021', '000223', 'gasela', 'bayar ke gasela', 'Gabungan', '0', '50000', 'Abu Kafa'),
(87, 'FC-2359303', '2021-12-30', 'Dec 2021', '000225', 'SPBU', 'Es Kelapa muda', 'Rihlah Guru', '0', '33000', 'Abu Kafa'),
(88, 'FC-2359303', '2021-12-30', 'Dec 2021', '000225', 'SPBU', 'Minuman', 'Rihlah Guru', '0', '22000', 'Abu Kafa'),
(89, '', '0000-00-00', 'Jan 2022', '', '', '', '-', '', '0', 'Abu Kafa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `letter`
--
ALTER TABLE `letter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `letterin`
--
ALTER TABLE `letterin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trash_finance`
--
ALTER TABLE `trash_finance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=569;
--
-- AUTO_INCREMENT for table `letter`
--
ALTER TABLE `letter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `letterin`
--
ALTER TABLE `letterin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `trash_finance`
--
ALTER TABLE `trash_finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
