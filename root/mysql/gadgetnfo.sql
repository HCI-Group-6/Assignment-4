-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2021 at 02:43 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gadgetnfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE `orderlist` (
  `id` int(11) NOT NULL,
  `userid` int(64) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `order_list` varchar(255) NOT NULL,
  `total` int(64) NOT NULL,
  `provinsi` varchar(64) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `nomortelepon` varchar(16) NOT NULL,
  `email` varchar(64) NOT NULL,
  `buktipembayaran` varchar(64) NOT NULL,
  `atasnama` varchar(64) NOT NULL,
  `orderstatus` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderlist`
--

INSERT INTO `orderlist` (`id`, `userid`, `nama`, `order_list`, `total`, `provinsi`, `alamat`, `nomortelepon`, `email`, `buktipembayaran`, `atasnama`, `orderstatus`) VALUES
(10, 10, 'Chiko Tridipa', '3,4,2,2,8,2,4,3,5,1', 3009000, 'DKI Jakarta', 'Pondok Kelapa West Jakarta, West Jakarta, 13450', '087887152770', 'chiko.tridipa1@gmail.com', 'images/orderpayment/order_1.jpg', 'Chiko Tridipa', 'Pending'),
(11, 11, 'Chiko Tridipa', '1,5,8,1', 1472995, 'DKI Jakarta', 'Pondok Kelapa West Jakarta, Jakarta Timur, 13450', '087887152770', 'chiko.tridipa1@gmail.com', 'images/orderpayment/order_11.jpg', 'Galih Kurnia', 'Terverifikasi'),
(12, 11, 'Chiko Tridipa', '3,1', 256000, 'DKI Jakarta', 'Pondok Kelapa West Jakarta, West Jakarta, 13450', '087887152770', 'chiko.tridipa1@gmail.com', 'images/orderpayment/order_12.jpg', 'Chiko Tridipa', 'Terverifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `productlist`
--

CREATE TABLE `productlist` (
  `id` int(11) NOT NULL,
  `nama_product` varchar(32) NOT NULL,
  `deskripsi_product` varchar(128) NOT NULL,
  `harga_product` int(32) NOT NULL,
  `gambar_product` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productlist`
--

INSERT INTO `productlist` (`id`, `nama_product`, `deskripsi_product`, `harga_product`, `gambar_product`) VALUES
(1, 'Samsung Galaxy Tab', 'Lorem ipsum dolor sit amet consectetur adipisicing.', 249999, 'images/products/product_1.png'),
(2, 'Asus Laptop', 'Lorem ipsum dolor sit amet consectetur adipisicing.', 245000, 'images/products/product_2.png'),
(3, 'Fantech Headphone', 'Lorem ipsum dolor sit amet consectetur adipisicing.', 256000, 'images/products/product_3.png'),
(4, 'DBE Headphone', 'Lorem ipsum dolor sit amet consectetur adipisicing.', 278000, 'images/products/product_4.png'),
(5, 'Acer Laptop', 'Lorem ipsum dolor sit amet consectetur adipisicing.', 215000, 'images/products/product_5.png'),
(6, 'Fuji Camera', 'Lorem ipsum dolor sit amet consectetur adipisicing.', 298000, 'images/products/product_6.png'),
(7, 'Lenovo Laptop', 'Lorem ipsum dolor sit amet consectetur adipisicing.', 254000, 'images/products/product_7.png'),
(8, 'Huawei Laptop', 'Lorem ipsum dolor sit amet consectetur adipisicing.', 223000, 'images/products/product_8.png'),
(9, 'TES', 'Ini adalah deskripsi dari TES', 2147483647, 'images/products/product_9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `user_role` varchar(32) NOT NULL,
  `nama_depan` varchar(32) NOT NULL,
  `nama_belakang` varchar(32) NOT NULL,
  `nomor_telepon` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `user_role`, `nama_depan`, `nama_belakang`, `nomor_telepon`, `email`, `username`, `password`) VALUES
(10, 'Admin', 'Chiko', 'Tridipa', '087887152770', 'chiko.tridipa1@gmail.com', 'admin', '$2y$10$7UYjbBqQD2QyMf.alCEUo.fR3o6SBwZEYrEGmthkqvGVnWt1yQbka'),
(12, 'Admin', 'Mr', 'Admin', '087126312798', 'admin@outlook.com', 'admin2', '$2y$10$0BU73rfWWYJNpj92bImw3uKGzQhsiTiDS1m1NfYKdnKHbLABZVswG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productlist`
--
ALTER TABLE `productlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderlist`
--
ALTER TABLE `orderlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `productlist`
--
ALTER TABLE `productlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
