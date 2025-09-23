# TPEspecial-web2-2025


nombres de los integrantes del grupo (emails):
 - Lucia Moreira -> lulii.moreira96@gmail.com
 - Manuel Montoya -> montoya.christensen@outlook.com
   
Temática del TPE -> Breve descripción de la temática:
 - venta de productos informaticos, incluye vendedor y ventas. relacion 1 -> N
 - la tabla vendedor tiene:
 - un id, un nombre, un telefono y un email
 - la tabla venta tiene:
 - un id, un producto, un precio, una fecha de venta, y el id del vendedor que realizo la venta


El diagrama entidad relación (DER) del modelo de datos planteado (archivo jpeg o pdf):

<img width="636" height="339" alt="Captura de pantalla 2025-09-18 a la(s) 11 41 45 p  m" src="https://github.com/user-attachments/assets/763f5723-74b3-4932-a2af-5a83b9bf06e7" />

El código SQL que genera la base de datos (exportado desde phpMyAdmin)

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-09-2025 a las 04:43:01
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tiendaComputacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`id`, `nombre`, `telefono`, `email`) VALUES
(1, 'lucia', 111511, 'lucia@tienda.com'),
(2, 'manuel', 24941511, 'manuel@tienda.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id venta` int(11) NOT NULL,
  `producto` varchar(200) NOT NULL,
  `precio` double NOT NULL,
  `id vendedor` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id venta`, `producto`, `precio`, `id vendedor`, `fecha`) VALUES
(1, 'mouse', 1500, 1, '2025-09-02'),
(2, 'teclado con luces', 3000, 2, '2025-08-13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id venta`),
  ADD UNIQUE KEY `id vendedor` (`id vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id vendedor`) REFERENCES `vendedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

