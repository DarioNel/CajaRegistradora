-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: MariaDb
-- Generation Time: Nov 18, 2024 at 04:46 PM
-- Server version: 11.4.2-MariaDB-ubu2404
-- PHP Version: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `negocio`
--

-- --------------------------------------------------------

--
-- Table structure for table `Clientes`
--

CREATE TABLE `Clientes` (
  `Id_cliente` int(11) NOT NULL,
  `DNI` varchar(70) NOT NULL,
  `Nombre` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Clientes`
--

INSERT INTO `Clientes` (`Id_cliente`, `DNI`, `Nombre`) VALUES
(1, '32546807', 'Dario'),
(2, '42976524', 'Juan Parraz');

-- --------------------------------------------------------

--
-- Table structure for table `Detalles_Ventas`
--

CREATE TABLE `Detalles_Ventas` (
  `Id_detallev` int(11) NOT NULL,
  `Id_venta` int(11) DEFAULT NULL,
  `Id_producto` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Importe` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Detalles_Ventas`
--

INSERT INTO `Detalles_Ventas` (`Id_detallev`, `Id_venta`, `Id_producto`, `Cantidad`, `Importe`) VALUES
(1, 1, 5, 3, 170.40),
(2, 1, 4, 1, 600.00),
(3, 1, 3, 2, 406.00);

-- --------------------------------------------------------

--
-- Table structure for table `Productos`
--

CREATE TABLE `Productos` (
  `Id_producto` int(11) NOT NULL,
  `Cod_Barras` varchar(70) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Precio_Venta` decimal(10,2) NOT NULL,
  `Categoria` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Productos`
--

INSERT INTO `Productos` (`Id_producto`, `Cod_Barras`, `Nombre`, `Stock`, `Precio_Venta`, `Categoria`) VALUES
(1, '231239873193', 'Arroz Marolio 1Kg', 80, 4.50, 'Comestibles'),
(2, '876853453453', 'Yerba Mate Playadito 1kg', 100, 3.89, 'Comestibles'),
(3, '213237657350', 'Coca Cola sin azucar 1Ltrs', 55, 203.00, 'Bebidas'),
(4, '6546546547753', 'Arina Favorita 1KG', 30, 600.00, 'Comestibles'),
(5, '6346898707234', 'Lavandina ayudin 500', 32, 56.80, 'Limpieza');

-- --------------------------------------------------------

--
-- Table structure for table `Usuarios`
--

CREATE TABLE `Usuarios` (
  `Id_usuario` int(11) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Clave` varchar(70) NOT NULL,
  `Tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Usuarios`
--

INSERT INTO `Usuarios` (`Id_usuario`, `Nombre`, `Clave`, `Tipo`) VALUES
(1, 'admin', 'admin', 'Administrador'),
(2, 'invitado', '1234', 'Empleado'),
(3, 'dario', 'dario', 'Administrador');

-- --------------------------------------------------------

--
-- Table structure for table `Ventas`
--

CREATE TABLE `Ventas` (
  `Id_venta` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Tipo_pago` varchar(70) NOT NULL,
  `Id_usuario` int(11) DEFAULT NULL,
  `Id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Ventas`
--

INSERT INTO `Ventas` (`Id_venta`, `Fecha`, `Total`, `Tipo_pago`, `Id_usuario`, `Id_cliente`) VALUES
(1, '2024-11-19', 1176.40, 'Mercado Pago', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Clientes`
--
ALTER TABLE `Clientes`
  ADD PRIMARY KEY (`Id_cliente`);

--
-- Indexes for table `Detalles_Ventas`
--
ALTER TABLE `Detalles_Ventas`
  ADD PRIMARY KEY (`Id_detallev`),
  ADD KEY `Id_venta` (`Id_venta`),
  ADD KEY `Id_producto` (`Id_producto`);

--
-- Indexes for table `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`Id_producto`);

--
-- Indexes for table `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`Id_usuario`);

--
-- Indexes for table `Ventas`
--
ALTER TABLE `Ventas`
  ADD PRIMARY KEY (`Id_venta`),
  ADD KEY `Id_usuario` (`Id_usuario`),
  ADD KEY `Id_cliente` (`Id_cliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Clientes`
--
ALTER TABLE `Clientes`
  MODIFY `Id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Detalles_Ventas`
--
ALTER TABLE `Detalles_Ventas`
  MODIFY `Id_detallev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Productos`
--
ALTER TABLE `Productos`
  MODIFY `Id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Ventas`
--
ALTER TABLE `Ventas`
  MODIFY `Id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Detalles_Ventas`
--
ALTER TABLE `Detalles_Ventas`
  ADD CONSTRAINT `Detalles_Ventas_ibfk_1` FOREIGN KEY (`Id_venta`) REFERENCES `Ventas` (`Id_venta`),
  ADD CONSTRAINT `Detalles_Ventas_ibfk_2` FOREIGN KEY (`Id_producto`) REFERENCES `Productos` (`Id_producto`);

--
-- Constraints for table `Ventas`
--
ALTER TABLE `Ventas`
  ADD CONSTRAINT `Ventas_ibfk_1` FOREIGN KEY (`Id_usuario`) REFERENCES `Usuarios` (`Id_usuario`),
  ADD CONSTRAINT `Ventas_ibfk_2` FOREIGN KEY (`Id_cliente`) REFERENCES `Clientes` (`Id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
