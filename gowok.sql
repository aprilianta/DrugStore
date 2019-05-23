-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 10:07 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gowok`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCategory` (IN `name_category` VARCHAR(30))  BEGIN
    SELECT * FROM kategori WHERE nama_kategori LIKE CONCAT('%',name_category,'%');
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMedicine` (IN `medicine` VARCHAR(30))  BEGIN
    SELECT * FROM data_obat WHERE nama_obat LIKE CONCAT('%',medicine,'%');
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPelanggan` ()  BEGIN
 SELECT * FROM user WHERE jabatan='Pelanggan';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPembelian` (IN `medicine_terbeli` VARCHAR(30))  BEGIN
    SELECT * FROM data_pembelian WHERE nama_obat LIKE CONCAT('%',medicine_terbeli,'%');
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPembelianPelanggan` (IN `medicine_terbeli_pelanggan` VARCHAR(30))  BEGIN
 SELECT * FROM data_pembelian_pelanggan WHERE nama_obat LIKE CONCAT('%',medicine_terbeli,'%');
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPenjualan` (IN `medicine_terjual` VARCHAR(30))  BEGIN
    SELECT * FROM data_penjualan WHERE nama_obat LIKE CONCAT('%',medicine_terjual,'%');
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetStatus` (IN `nama_user` VARCHAR(15), OUT `status_user` VARCHAR(15))  BEGIN
    	DECLARE nm VARCHAR(15);
        SELECT username INTO nm FROM user WHERE username=nama_user;
        IF (SELECT STRCMP(nm,nama_user)=0) THEN
        	SET status_user='Active';
        ELSE
        	SET status_user='Inactive';
        END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetSupplier` (IN `name_supplier` VARCHAR(30))  BEGIN
    SELECT * FROM supplier WHERE nama_supplier LIKE CONCAT('%',name_supplier,'%');
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUser` (IN `name` VARCHAR(15))  NO SQL
BEGIN
	SELECT * FROM user WHERE username
    	LIKE CONCAT('%',name,'%') OR
    	nama LIKE CONCAT('%',name,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `HapusPelanggan` (IN `id_pelanggan` INT(5))  BEGIN
    DELETE FROM user WHERE id_user=id_pelanggan;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `data_obat`
-- (See below for the actual view)
--
CREATE TABLE `data_obat` (
`id_obat` int(5)
,`nama_obat` varchar(30)
,`id_kategori` int(11)
,`nama_kategori` varchar(15)
,`harga_jual` double
,`harga_beli` double
,`jumlah_obat` int(11)
,`id_supplier` int(11)
,`nama_supplier` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `data_pembelian`
-- (See below for the actual view)
--
CREATE TABLE `data_pembelian` (
`id_pembelian` int(5)
,`id_receipt_beli` varchar(5)
,`tgl_beli` date
,`id_obat` int(5)
,`nama_obat` varchar(30)
,`harga_beli` double
,`jumlah_beli` int(11)
,`total` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `data_pembelian_pelanggan`
-- (See below for the actual view)
--
CREATE TABLE `data_pembelian_pelanggan` (
`id_pembelian_pelanggan` int(5)
,`username` varchar(15)
,`tgl_beli_pelanggan` date
,`id_obat` int(5)
,`nama_obat` varchar(30)
,`jumlah_beli_pelanggan` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `data_penjualan`
-- (See below for the actual view)
--
CREATE TABLE `data_penjualan` (
`id_penjualan` int(5)
,`id_receipt_jual` varchar(5)
,`tgl_jual` date
,`id_obat` int(5)
,`nama_obat` varchar(30)
,`harga_jual` double
,`jumlah_jual` int(11)
,`total` double
);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_receipt_beli` varchar(5) NOT NULL,
  `id_pembelian` int(5) NOT NULL,
  `id_obat` int(5) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `stok_baru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_receipt_jual` varchar(5) NOT NULL,
  `id_penjualan` int(5) NOT NULL,
  `id_obat` int(5) NOT NULL,
  `jumlah_jual` int(11) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `stok_baru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_retur`
--

CREATE TABLE `detail_retur` (
  `id_detail_retur` int(5) NOT NULL,
  `id_retur` int(5) NOT NULL,
  `id_detail_pemb` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id_obat` int(5) NOT NULL,
  `nama_obat` varchar(30) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga_jual` double NOT NULL,
  `harga_beli` double NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id_obat`, `nama_obat`, `id_kategori`, `harga_jual`, `harga_beli`, `jumlah_obat`, `id_supplier`, `gambar`) VALUES
(5, 'Tolak Angin', 2, 1000, 900, 10, 2, 'tolak-angin.png'),
(9, 'Mylanta', 2, 1200, 900, 10, 1, 'mylanta.png'),
(13, 'Panadol', 2, 1200, 900, 15, 4, 'panadol.png'),
(15, 'Minol', 2, 1000, 900, 20, 1, 'minol.png'),
(22, 'Amoxcilin', 1, 1500, 1200, 20, 3, 'amoxicillin.png');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(0, 'Undefined'),
(1, 'Keras'),
(2, 'Lunak');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(5) NOT NULL,
  `id_receipt_beli` varchar(5) NOT NULL,
  `tgl_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_pelanggan`
--

CREATE TABLE `pembelian_pelanggan` (
  `id_pembelian_pelanggan` int(5) NOT NULL,
  `username` varchar(15) NOT NULL,
  `tgl_beli_pelanggan` date NOT NULL,
  `id_obat` int(5) NOT NULL,
  `jumlah_beli_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `pembelian_pelanggan`
--
DELIMITER $$
CREATE TRIGGER `riwayat_pembelian_pengguna` AFTER UPDATE ON `pembelian_pelanggan` FOR EACH ROW BEGIN
    	INSERT INTO riwayat_perubahan_pembelian_pengguna
        	(id_pembelian_pelanggan,id_obat,jumlah_beli_pelanggan_lama,jumlah_beli_pelanggan_baru,tgl_perubahan)
        VALUES (OLD.id_pembelian_pelanggan, OLD.id_obat, OLD.jumlah_beli_pelanggan,NEW.jumlah_beli_pelanggan,CURRENT_TIME);
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(5) NOT NULL,
  `id_receipt_jual` varchar(5) NOT NULL,
  `tgl_jual` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE `retur` (
  `id_retur` int(5) NOT NULL,
  `id_obat` int(5) NOT NULL,
  `total_retur` double NOT NULL,
  `total_harga_retur` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_perubahan_pembelian_pengguna`
--

CREATE TABLE `riwayat_perubahan_pembelian_pengguna` (
  `id_pembelian_pelanggan` int(5) NOT NULL,
  `id_obat` int(5) NOT NULL,
  `jumlah_beli_pelanggan_lama` int(11) NOT NULL,
  `jumlah_beli_pelanggan_baru` int(11) NOT NULL,
  `tgl_perubahan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(5) NOT NULL,
  `nama_supplier` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telp`) VALUES
(1, 'PT Jaya Abadi', 'Jl. Mawar 9 Solo', '027123456'),
(2, 'CV Sentosa', 'Jl. Kenanga 12 Yogyakarta', '027456789'),
(3, 'PT Cahaya Sehat', 'Jl. Kinanti 8 Malang', '082658794'),
(4, 'PT Budi Sehat', 'Jl. Setiabudi 78 Solo', '027198765');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(12) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `jabatan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `no_telp`, `jenis_kelamin`, `jabatan`) VALUES
(33, 'Dindakusayang', '123', 'dinda', 'jl duluin', '123', 'F', 'Owner'),
(35, 'Oki', '111', 'okiki', 'jl mantan', '12312412', 'F', 'Apoteker'),
(52, 'Kevin', '123', 'kevinaprilianta', 'solo', '082136699892', 'M', 'Apoteker Pendamping'),
(54, 'Yohaneganteng', '111', 'yohanes', 'jogja', '11111', 'M', 'Apoteker'),
(56, 'Aprilianta', '123', 'Aprilianta', 'Yogyakarta', '082136699892', 'M', 'Pelanggan');

-- --------------------------------------------------------

--
-- Structure for view `data_obat`
--
DROP TABLE IF EXISTS `data_obat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_obat`  AS  select `inventory`.`id_obat` AS `id_obat`,`inventory`.`nama_obat` AS `nama_obat`,`inventory`.`id_kategori` AS `id_kategori`,`kategori`.`nama_kategori` AS `nama_kategori`,`inventory`.`harga_jual` AS `harga_jual`,`inventory`.`harga_beli` AS `harga_beli`,`inventory`.`jumlah_obat` AS `jumlah_obat`,`inventory`.`id_supplier` AS `id_supplier`,`supplier`.`nama_supplier` AS `nama_supplier` from ((`inventory` join `kategori` on((`inventory`.`id_kategori` = `kategori`.`id_kategori`))) join `supplier` on((`inventory`.`id_supplier` = `supplier`.`id_supplier`))) ;

-- --------------------------------------------------------

--
-- Structure for view `data_pembelian`
--
DROP TABLE IF EXISTS `data_pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_pembelian`  AS  select `pembelian`.`id_pembelian` AS `id_pembelian`,`pembelian`.`id_receipt_beli` AS `id_receipt_beli`,`pembelian`.`tgl_beli` AS `tgl_beli`,`inventory`.`id_obat` AS `id_obat`,`inventory`.`nama_obat` AS `nama_obat`,`inventory`.`harga_beli` AS `harga_beli`,`detail_pembelian`.`jumlah_beli` AS `jumlah_beli`,(`detail_pembelian`.`jumlah_beli` * `inventory`.`harga_beli`) AS `total` from ((`pembelian` join `detail_pembelian` on((`pembelian`.`id_receipt_beli` = `detail_pembelian`.`id_receipt_beli`))) join `inventory` on((`detail_pembelian`.`id_obat` = `inventory`.`id_obat`))) ;

-- --------------------------------------------------------

--
-- Structure for view `data_pembelian_pelanggan`
--
DROP TABLE IF EXISTS `data_pembelian_pelanggan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_pembelian_pelanggan`  AS  select `pembelian_pelanggan`.`id_pembelian_pelanggan` AS `id_pembelian_pelanggan`,`pembelian_pelanggan`.`username` AS `username`,`pembelian_pelanggan`.`tgl_beli_pelanggan` AS `tgl_beli_pelanggan`,`pembelian_pelanggan`.`id_obat` AS `id_obat`,`inventory`.`nama_obat` AS `nama_obat`,`pembelian_pelanggan`.`jumlah_beli_pelanggan` AS `jumlah_beli_pelanggan` from (`pembelian_pelanggan` join `inventory` on((`pembelian_pelanggan`.`id_obat` = `inventory`.`id_obat`))) ;

-- --------------------------------------------------------

--
-- Structure for view `data_penjualan`
--
DROP TABLE IF EXISTS `data_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_penjualan`  AS  select `penjualan`.`id_penjualan` AS `id_penjualan`,`penjualan`.`id_receipt_jual` AS `id_receipt_jual`,`penjualan`.`tgl_jual` AS `tgl_jual`,`inventory`.`id_obat` AS `id_obat`,`inventory`.`nama_obat` AS `nama_obat`,`inventory`.`harga_jual` AS `harga_jual`,`detail_penjualan`.`jumlah_jual` AS `jumlah_jual`,(`detail_penjualan`.`jumlah_jual` * `inventory`.`harga_jual`) AS `total` from ((`penjualan` join `detail_penjualan` on((`penjualan`.`id_receipt_jual` = `detail_penjualan`.`id_receipt_jual`))) join `inventory` on((`detail_penjualan`.`id_obat` = `inventory`.`id_obat`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_receipt_beli`),
  ADD KEY `FK_detail_beli` (`id_pembelian`),
  ADD KEY `FK_id_obat_beli` (`id_obat`) USING BTREE;

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_receipt_jual`),
  ADD KEY `FK_id_penjualan` (`id_penjualan`),
  ADD KEY `FK_id_obat_jual` (`id_obat`);

--
-- Indexes for table `detail_retur`
--
ALTER TABLE `detail_retur`
  ADD PRIMARY KEY (`id_detail_retur`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `FK_kategori` (`id_kategori`),
  ADD KEY `FK_Suppliers` (`id_supplier`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_pelanggan`
--
ALTER TABLE `pembelian_pelanggan`
  ADD PRIMARY KEY (`id_pembelian_pelanggan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`id_retur`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_retur`
--
ALTER TABLE `detail_retur`
  MODIFY `id_detail_retur` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id_obat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian_pelanggan`
--
ALTER TABLE `pembelian_pelanggan`
  MODIFY `id_pembelian_pelanggan` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `id_retur` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `FK_detail_beli` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`),
  ADD CONSTRAINT `FK_id_obat` FOREIGN KEY (`id_obat`) REFERENCES `inventory` (`id_obat`);

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `FK_id_obat_jual` FOREIGN KEY (`id_obat`) REFERENCES `inventory` (`id_obat`),
  ADD CONSTRAINT `FK_id_penjualan` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `FK_Suppliers` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `FK_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
