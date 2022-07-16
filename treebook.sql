-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2022 a las 17:38:05
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `treebook`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `id` varchar(36) COLLATE latin1_spanish_ci NOT NULL,
  `father` varchar(36) COLLATE latin1_spanish_ci NOT NULL,
  `mother` varchar(36) COLLATE latin1_spanish_ci NOT NULL,
  `spouses` varchar(256) COLLATE latin1_spanish_ci NOT NULL,
  `children` varchar(516) COLLATE latin1_spanish_ci NOT NULL,
  `first_name` varchar(22) COLLATE latin1_spanish_ci NOT NULL,
  `last_name` varchar(22) COLLATE latin1_spanish_ci NOT NULL,
  `birthday` date NOT NULL,
  `avatar` varchar(64) COLLATE latin1_spanish_ci NOT NULL,
  `gender` enum('M','F') COLLATE latin1_spanish_ci NOT NULL,
  `lastnames_tree` varchar(1024) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`person_id`, `id`, `father`, `mother`, `spouses`, `children`, `first_name`, `last_name`, `birthday`, `avatar`, `gender`, `lastnames_tree`) VALUES
(1, '7f0a8ee0-2567-4373-a7b8-aaceac8f7004', '', '', 'ac09352e-c5de-42dc-bd34-d78d6d13071c,e6e06497-d536-4d9c-9881-afa8997dc30e', '6f27d934-b1cc-4064-b60b-eb2e636134a0,c0051725-6db3-4155-bb58-672d731850e7', 'Nelson', 'Barolin Maeso', '1954-12-21', 'assets/img/M.jpg', 'M', ''),
(2, 'ac09352e-c5de-42dc-bd34-d78d6d13071c', '', '', '7f0a8ee0-2567-4373-a7b8-aaceac8f7004', '6f27d934-b1cc-4064-b60b-eb2e636134a0', 'Lourdes Graciela', 'Bueno', '1956-03-03', 'assets/img/profile/F.jpg', 'F', ''),
(3, 'c0051725-6db3-4155-bb58-672d731850e7', '7f0a8ee0-2567-4373-a7b8-aaceac8f7004', 'e6e06497-d536-4d9c-9881-afa8997dc30e', '', '', 'Nelson Gabriel', 'Barolin Dasiva', '1990-03-04', 'assets/img/profile/M.jpg', 'M', ''),
(4, 'e6e06497-d536-4d9c-9881-afa8997dc30e', '', '', '7f0a8ee0-2567-4373-a7b8-aaceac8f7004', 'c0051725-6db3-4155-bb58-672d731850e7', 'Iris Griselda', 'Dasilva Caetano', '1966-06-30', 'assets/img/profile/F.jpg', 'F', ''),
(5, '6f27d934-b1cc-4064-b60b-eb2e636134a0', '7f0a8ee0-2567-4373-a7b8-aaceac8f7004', 'ac09352e-c5de-42dc-bd34-d78d6d13071c', '', '', 'Richard', 'Barolin Bueno', '1977-10-29', 'assets/img/profile/M.jpg', 'M', 'Barolin, Bueno , Dasilva');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
