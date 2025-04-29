-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 09:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: ` db_gaji_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_gaji`
--

CREATE TABLE `detail_gaji` (
  `no` int(11) DEFAULT NULL,
  `no_ref` varchar(20) DEFAULT NULL,
  `nominal` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_gaji`
--

INSERT INTO `detail_gaji` (`no`, `no_ref`, `nominal`) VALUES
(1, 'SG001', 5500000.00),
(2, 'SG001', 500000.00),
(4, 'SG001', 500000.00),
(1, 'SG002', 6000000.00),
(4, 'SG002', 300000.00),
(3, 'SG002', 500000.00),
(1, 'SG003', 6800000.00),
(5, 'SG003', 200000.00),
(1, 'SG004', 5000000.00),
(2, 'SG004', 500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `kode_karyawan` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `no_telpon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_rekening` varchar(30) DEFAULT NULL,
  `rek_bank` varchar(50) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`kode_karyawan`, `nama`, `alamat`, `jabatan`, `no_telpon`, `email`, `no_rekening`, `rek_bank`, `id`) VALUES
('K001', 'Andi Saputra', 'Jl. Merdeka No.5', 'Staff IT', '081234567890', 'andi@maju.com', '1234567890', 'BCA', 1),
('K002', 'Siti Aminah', 'Jl. Melati No.12', 'HRD', '081298765432', 'siti@maju.com', '9876543210', 'Mandiri', 1),
('K003', 'Budi Santoso', 'Jl. Mawar No.8', 'Keuangan', '082134567890', 'budi@sukses.com', '4567891230', 'BNI', 2),
('K004', 'Rina Kartika', 'Jl. Dahlia No.4', 'Marketing', '081377778888', 'rina@sukses.com', '7894561230', 'BRI', 2);

-- --------------------------------------------------------

--
-- Table structure for table `keterangan_gaji`
--

CREATE TABLE `keterangan_gaji` (
  `no` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `debitkredit` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keterangan_gaji`
--

INSERT INTO `keterangan_gaji` (`no`, `keterangan`, `debitkredit`) VALUES
(1, 'Gaji Lembur', 'Debit'),
(2, 'Potongan BPJS', 'kredit'),
(3, 'Tunjangan Transport', 'Debit'),
(4, 'Bonus Kinerja', 'Debit'),
(5, 'Potongan Absen', 'Kredit'),
(6, 'Gaji Pokok', 'Debit');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telpon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `nama`, `alamat`, `no_telpon`, `email`) VALUES
(1, 'PT Maju Bersama', 'Jl. Kenangan No.10, Jakarta', '0211234567', 'info@maju.com'),
(2, 'CV Sukses Selalu', 'Jl. Anggrek No.22, Bandung', '0227654321', 'halo@sukses.com'),
(3, 'PT Cinta Bersama', 'Jl. Kenangan No.08, Jakarta', '0211234524', 'cinta@bersama.com');

-- --------------------------------------------------------

--
-- Table structure for table `slip_gaji`
--

CREATE TABLE `slip_gaji` (
  `no_ref` varchar(20) NOT NULL,
  `tgl` date DEFAULT NULL,
  `total_gaji` decimal(15,2) DEFAULT NULL,
  `kode_karyawan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slip_gaji`
--

INSERT INTO `slip_gaji` (`no_ref`, `tgl`, `total_gaji`, `kode_karyawan`) VALUES
('SG001', '2025-04-01', 5000000.00, 'K001'),
('SG002', '2025-04-01', 6200000.00, 'K002'),
('SG003', '2025-04-01', 7000000.00, 'K003'),
('SG004', '2025-04-01', 5500000.00, 'K004');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  ADD KEY `no` (`no`),
  ADD KEY `no_ref` (`no_ref`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`kode_karyawan`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `keterangan_gaji`
--
ALTER TABLE `keterangan_gaji`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slip_gaji`
--
ALTER TABLE `slip_gaji`
  ADD PRIMARY KEY (`no_ref`),
  ADD KEY `kode_karyawan` (`kode_karyawan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keterangan_gaji`
--
ALTER TABLE `keterangan_gaji`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_gaji`
--
ALTER TABLE `detail_gaji`
  ADD CONSTRAINT `detail_gaji_ibfk_1` FOREIGN KEY (`no`) REFERENCES `keterangan_gaji` (`no`),
  ADD CONSTRAINT `detail_gaji_ibfk_2` FOREIGN KEY (`no_ref`) REFERENCES `slip_gaji` (`no_ref`);

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id`) REFERENCES `perusahaan` (`id`);

--
-- Constraints for table `slip_gaji`
--
ALTER TABLE `slip_gaji`
  ADD CONSTRAINT `slip_gaji_ibfk_1` FOREIGN KEY (`kode_karyawan`) REFERENCES `karyawan` (`kode_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
