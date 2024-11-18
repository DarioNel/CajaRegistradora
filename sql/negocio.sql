-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: MariaDb
-- Generation Time: Nov 15, 2024 at 06:24 PM
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
  `DNI` varchar(255) NOT NULL,
  `Nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Clientes`
--

INSERT INTO `Clientes` (`Id_cliente`, `DNI`, `Nombre`) VALUES
(1, '33897234', 'Juan Parraz'),
(2, '43678243', 'Marcos Jose');

-- --------------------------------------------------------

--
-- Table structure for table `Detalles_Ventas`
--

CREATE TABLE `Detalles_Ventas` (
  `Id_detallev` int(11) NOT NULL,
  `Id_venta` int(11) DEFAULT NULL,
  `Id_producto` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Importe` decimal(10,2) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Tipo_pago` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Detalles_Ventas`
--

INSERT INTO `Detalles_Ventas` (`Id_detallev`, `Id_venta`, `Id_producto`, `Cantidad`, `Importe`, `Total`, `Tipo_pago`) VALUES
(2, 2, 2, 4, 5600.00, 87878.00, 'Efectivo'),
(4, 4, 2, 79, 320323.00, 87878.00, 'Mercado Pago');

-- --------------------------------------------------------

--
-- Table structure for table `Productos`
--

CREATE TABLE `Productos` (
  `Id_producto` int(11) NOT NULL,
  `Cod_Barras` varchar(255) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Precio_Venta` decimal(10,2) NOT NULL,
  `Categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Productos`
--

INSERT INTO `Productos` (`Id_producto`, `Cod_Barras`, `Nombre`, `Stock`, `Precio_Venta`, `Categoria`) VALUES
(1, '43243242', 'Azucar Marilio', 50, 1.50, 'comestibles'),
(2, '7657675757', 'Coca Cola 1Lrs', 100, 2.60, 'Bebidas'),
(4, '5353454354', 'detergente', 534535, 13.56, 'Limpieza'),
(5, '5234535', 'alfajor tatin', 56, 6500.00, 'Golosinas'),
(9, '7777778', 'caramelos', 444000, 5453.00, 'Golosinas'),
(13, '33232132321321321', 'Azucar Arcor 1kg', 70, 1200.00, 'Comestibles');

-- --------------------------------------------------------

--
-- Table structure for table `Usuarios`
--

CREATE TABLE `Usuarios` (
  `Id_usuario` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Clave` varchar(255) NOT NULL,
  `Tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Usuarios`
--

INSERT INTO `Usuarios` (`Id_usuario`, `Nombre`, `Clave`, `Tipo`) VALUES
(1, 'admin', 'admin', 'Administrador'),
(25, 'invitado', '1234', 'Empleado'),
(32, 'dario', 'dario', 'Administrador');

-- --------------------------------------------------------

--
-- Table structure for table `Ventas`
--

CREATE TABLE `Ventas` (
  `Id_venta` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Id_usuario` int(11) DEFAULT NULL,
  `Id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Ventas`
--

INSERT INTO `Ventas` (`Id_venta`, `Fecha`, `Id_usuario`, `Id_cliente`) VALUES
(2, '2024-11-13', 1, 1),
(4, '2024-11-13', 1, 2);

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
  MODIFY `Id_detallev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Productos`
--
ALTER TABLE `Productos`
  MODIFY `Id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `Ventas`
--
ALTER TABLE `Ventas`
  MODIFY `Id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
