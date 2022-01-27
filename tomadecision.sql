-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-01-2022 a las 16:07:34
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tomadecision`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales`
--

DROP TABLE IF EXISTS `animales`;
CREATE TABLE IF NOT EXISTS `animales` (
  `idAnimal` int(11) NOT NULL AUTO_INCREMENT,
  `RFID` int(10) DEFAULT NULL,
  `mmGrasa` float DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `tas1` float DEFAULT NULL,
  `tas2` float DEFAULT NULL,
  `tas3` float DEFAULT NULL,
  `idCarpeta` int(11) DEFAULT NULL,
  `ecoRef` varchar(10) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idAnimal`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `animales`
--

INSERT INTO `animales` (`idAnimal`, `RFID`, `mmGrasa`, `peso`, `sexo`, `tas1`, `tas2`, `tas3`, `idCarpeta`, `ecoRef`, `date`) VALUES
(1, 1, 2, 3, '4', 5, 6, 7, NULL, '8', '2022-01-26'),
(2, NULL, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(3, 1, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(4, 1, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(5, 1, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(6, 21, 2, 2, 'M', 100, 0.02, -11.98, NULL, NULL, '2022-01-26'),
(7, 1, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(8, 1, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(9, 1, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(10, 1, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(11, 1, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(12, 1, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(13, 1, 5, 8, 'M', 62.5, 0.128, -11.872, NULL, NULL, '2022-01-26'),
(14, 1, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(15, 1, 1, 1, 'M', 100, 0.01, -11.99, NULL, NULL, '2022-01-26'),
(16, 1, 2, 3, 'M', 66.6667, 0.045, -11.955, NULL, NULL, '2022-01-26'),
(17, 1, 2, 3, 'M', 66.6667, 0.045, -11.955, NULL, NULL, '2022-01-26'),
(18, 1, 2, 3, 'M', 66.6667, 0.045, -11.955, NULL, NULL, '2022-01-26'),
(19, 1, 2, 3, 'M', 66.6667, 0.045, -11.955, NULL, NULL, '2022-01-26'),
(20, 1, 2, 3, 'M', 66.6667, 0.045, -11.955, NULL, NULL, '2022-01-26'),
(21, 1, 2, 3, 'M', 66.6667, 0.045, -11.955, NULL, NULL, '2022-01-26'),
(22, 1, 2, 3, 'M', 66.6667, 0.045, -11.955, NULL, NULL, '2022-01-26'),
(23, 1, 2, 3, 'M', 66.6667, 0.045, -11.955, NULL, NULL, '2022-01-26');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
