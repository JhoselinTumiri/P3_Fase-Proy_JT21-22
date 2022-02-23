-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2022 a las 11:11:12
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registrosp3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportistas`
--

CREATE TABLE `deportistas` (
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `apellido2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `telf` int(9) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fechaN` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lesiones` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `privacidad` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `deportistas`
--

INSERT INTO `deportistas` (`nombre`, `apellido1`, `apellido2`, `dni`, `sexo`, `telf`, `email`, `fechaN`, `categoria`, `lesiones`, `privacidad`) VALUES
('Gabriela', 'Sinclair', 'Benet', '06280879k', 'Mujer', 662721343, 'gabici@gmail.com', '2001-11-12', 'Cadete', 'tobillo, dedos', 'Acepto las condiciones de Politica de Privacidad'),
('Carlos', 'Gallarde', 'Benet', '07250822B', 'Hombre', 632721355, 'carlitosp@gmail.com', '2001-12-11', 'Mayores', 'hombro', 'Acepto las condiciones de Politica de Privacidad'),
('Julian', 'Rocha', 'Castro', '07280822B', 'Hombre', 658923645, 'julir@gmail.com', '31/03/1998', 'mayores', NULL, 'Acepto las condiciones de Politica de Privacidad'),
('JHOS', 'Tum', 'Benet', '07280823n', 'Mujer', 632721355, 'jhostum@gmail.com', '1999-11-12', 'Juvenil', 'rodilla', 'Acepto las condiciones de Politica de Privacidad');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `deportistas`
--
ALTER TABLE `deportistas`
  ADD PRIMARY KEY (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
