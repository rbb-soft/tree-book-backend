-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-07-2022 a las 21:32:00
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
  `avatar` varchar(128) COLLATE latin1_spanish_ci NOT NULL,
  `gender` enum('M','F') COLLATE latin1_spanish_ci NOT NULL,
  `lastnames_tree` varchar(1024) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`person_id`, `id`, `father`, `mother`, `spouses`, `children`, `first_name`, `last_name`, `birthday`, `avatar`, `gender`, `lastnames_tree`) VALUES
(27, '49744aef-7d22-429e-8d3f-cd360df028fd', '472220c9-f3d0-448e-ab30-47ef70f1f94a', '8861804a-7d67-4e0c-91be-3231cd08f0a6', '5ea06eb5-495d-4e55-8d81-b5e96db7d8ca,0f043baa-2389-4fd2-b577-c3360ed6a128', 'd0a12fc3-25e6-42b2-8403-536cf3b9b7bb,b3609861-bf17-4721-b272-86412de9051a,df6983dc-ba64-4f95-baa3-e8349bb53e3b,0831a641-3f2a-4e8d-a944-049279894f86,86ffe45d-b40b-43ef-81bc-9e26bb6d0ee4,10e3dfb3-3357-4da5-8f15-5c80bd0e96cd,10290d7e-c815-42ce-b539-ebdf9bb58b7c,81cca70d-8200-4779-8698-48c79aeb3841', 'Nelson', 'Barolin Maeso', '1954-12-21', 'http://localhost/assets/img/profile/M.jpg', 'M', ''),
(69, '472220c9-f3d0-448e-ab30-47ef70f1f94a', '', '', '8861804a-7d67-4e0c-91be-3231cd08f0a6', '49744aef-7d22-429e-8d3f-cd360df028fd', 'Elvio', 'Barolin', '0000-00-00', 'http://localhost/assets/img/profile/M.jpg', 'M', ''),
(70, '8861804a-7d67-4e0c-91be-3231cd08f0a6', '', '', '472220c9-f3d0-448e-ab30-47ef70f1f94a', '49744aef-7d22-429e-8d3f-cd360df028fd', 'Marta', 'Maeso', '0000-00-00', 'http://localhost/assets/img/profile/F.jpg', 'F', ''),
(71, '5ea06eb5-495d-4e55-8d81-b5e96db7d8ca', '', '', '49744aef-7d22-429e-8d3f-cd360df028fd', 'd0a12fc3-25e6-42b2-8403-536cf3b9b7bb,b3609861-bf17-4721-b272-86412de9051a,df6983dc-ba64-4f95-baa3-e8349bb53e3b', 'Lourdes Graciela', 'Bueno', '1956-07-03', 'http://localhost/assets/img/profile/F.jpg', 'F', ''),
(72, '0f043baa-2389-4fd2-b577-c3360ed6a128', '', '', '49744aef-7d22-429e-8d3f-cd360df028fd', '0831a641-3f2a-4e8d-a944-049279894f86,86ffe45d-b40b-43ef-81bc-9e26bb6d0ee4,10e3dfb3-3357-4da5-8f15-5c80bd0e96cd,10290d7e-c815-42ce-b539-ebdf9bb58b7c,81cca70d-8200-4779-8698-48c79aeb3841', 'Iris Giriselda', 'Dasilva Caetano', '1966-06-30', 'http://localhost/assets/img/profile/F.jpg', 'F', ''),
(73, 'd0a12fc3-25e6-42b2-8403-536cf3b9b7bb', '49744aef-7d22-429e-8d3f-cd360df028fd', '5ea06eb5-495d-4e55-8d81-b5e96db7d8ca', '', '', 'Richard', 'Barolin Bueno', '1977-10-29', 'http://localhost/assets/img/profile/M.jpg', 'M', ''),
(74, 'b3609861-bf17-4721-b272-86412de9051a', '49744aef-7d22-429e-8d3f-cd360df028fd', '5ea06eb5-495d-4e55-8d81-b5e96db7d8ca', '', '', 'Silvana', 'Barolin Bueno', '1975-08-12', 'http://localhost/assets/img/profile/F.jpg', 'F', ''),
(75, 'df6983dc-ba64-4f95-baa3-e8349bb53e3b', '49744aef-7d22-429e-8d3f-cd360df028fd', '5ea06eb5-495d-4e55-8d81-b5e96db7d8ca', '', '', 'Lorena', 'Barolin Bueno', '1985-07-06', 'http://localhost/assets/img/profile/F.jpg', 'F', ''),
(76, '0831a641-3f2a-4e8d-a944-049279894f86', '49744aef-7d22-429e-8d3f-cd360df028fd', '0f043baa-2389-4fd2-b577-c3360ed6a128', '', '', 'Nelson Gabriel', 'Barolin Dasilva', '1990-03-04', 'http://localhost/assets/img/profile/M.jpg', 'M', ''),
(77, '86ffe45d-b40b-43ef-81bc-9e26bb6d0ee4', '49744aef-7d22-429e-8d3f-cd360df028fd', '0f043baa-2389-4fd2-b577-c3360ed6a128', '', '', 'Romina Paola', 'Barolin Dasilva', '0000-00-00', 'http://localhost/assets/img/profile/F.jpg', 'F', ''),
(78, '10e3dfb3-3357-4da5-8f15-5c80bd0e96cd', '49744aef-7d22-429e-8d3f-cd360df028fd', '0f043baa-2389-4fd2-b577-c3360ed6a128', '', '', 'Yanina', 'Barolin Dasilva', '0000-00-00', 'http://localhost/assets/img/profile/F.jpg', 'F', ''),
(79, '10290d7e-c815-42ce-b539-ebdf9bb58b7c', '49744aef-7d22-429e-8d3f-cd360df028fd', '0f043baa-2389-4fd2-b577-c3360ed6a128', '', '', 'Marianela', 'Barolin Dasilva', '0000-00-00', 'http://localhost/assets/img/profile/F.jpg', 'F', ''),
(80, '81cca70d-8200-4779-8698-48c79aeb3841', '49744aef-7d22-429e-8d3f-cd360df028fd', '0f043baa-2389-4fd2-b577-c3360ed6a128', '', '', 'Tamara Belen', 'Barolin Dasilva', '0000-00-00', 'http://localhost/assets/img/profile/F.jpg', 'F', '');

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
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
