-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2019 at 03:38 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trabalhopw2`
--

-- --------------------------------------------------------

--
-- Table structure for table `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `sigla` varchar(4) DEFAULT NULL,
  `dnome` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departamento`
--

INSERT INTO `departamento` (`id`, `sigla`, `dnome`) VALUES
(1, 'MAT', 'Matematica'),
(2, 'DEP', 'Departamento'),
(4, 'TE', 'IFSP'),
(7, 'AF', 'Outro'),
(9, 'a', 'Setor'),
(10, 'AAA', 'Pilha');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `login` varchar(8) DEFAULT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `permissao` varchar(20) NOT NULL,
  `departamento_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `nome`, `senha`, `salario`, `permissao`, `departamento_fk`) VALUES
(1, 'peco', 'Pedro Augusto', 'c6f057b86584942e415435ffb1fa93d4', '889.01', '1', 1),
(2, 'podsclan', 'Brendow', 'morango123', '107.70', '0', 2),
(5, 'marcelo', 'Marcelo', '4b96d5c1ff312eea069ddc760794963d', '180.00', '0', 1),
(6, 'passador', 'JoÃ£o', '9e2501934d067d71bb1c5850722a73d1', '15.00', '1', 4),
(7, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '90.00', '1', 2),
(8, 'asd', 'teste', '0cc175b9c0f1b6a831c399e269772661', '9.00', '0', 9),
(9, 'dinei', 'Dinei', '8c3d7993b1f0a0ea7e4f01a713b6f4bb', '9.00', '0', 7),
(10, 'th99', 'Thiago', 'ac627ab1ccbdb62ec96e702f07f6425b', '0.00', '1', 1),
(12, 'Ana', 'Ana', '276b6c4692e78d4799c12ada515bc3e4', '90.00', '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sigla` (`sigla`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `fk_dept` (`departamento_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_dept` FOREIGN KEY (`departamento_fk`) REFERENCES `departamento` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
