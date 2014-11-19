-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2014 a las 06:28:43
-- Versión del servidor: 5.5.39
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sgd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carpeta`
--

CREATE TABLE IF NOT EXISTS `carpeta` (
  `CARPETAID` int(11) NOT NULL,
  `NOMBRECARPETA` char(30) NOT NULL,
  `CAR_CARPETAID` int(11) DEFAULT NULL,
  `USUARIOID` int(11) NOT NULL,
  `FECHACREACION` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
  `DOCID` int(11) NOT NULL,
  `NOMBREDOCUMENTO` char(10) NOT NULL,
  `USUARIOID` int(11) NOT NULL,
  `DESCRIPCION` char(10) DEFAULT NULL,
  `FECHAPUBLICACION` char(10) NOT NULL,
  `PALABRASCLAVES` char(10) NOT NULL,
  `FOLIO` char(10) NOT NULL,
  `TAMANO` char(10) NOT NULL,
  `ALMACENAMIENTOFISICO` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`USUARIOID` int(11) NOT NULL,
  `NOMBRE` char(50) NOT NULL,
  `APELLIDO` char(50) NOT NULL,
  `NOMBREUSUARIO` char(50) NOT NULL,
  `CONTRASENA` char(15) NOT NULL,
  `CORREO` char(50) NOT NULL,
  `FECHANACIMIENTO` date DEFAULT NULL,
  `OFICINA` int(11) NOT NULL,
  `EXTENSION` int(11) NOT NULL,
  `CELULAR` char(14) DEFAULT NULL,
  `ROL` char(20) DEFAULT NULL,
  `ESTADO` char(20) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`USUARIOID`, `NOMBRE`, `APELLIDO`, `NOMBREUSUARIO`, `CONTRASENA`, `CORREO`, `FECHANACIMIENTO`, `OFICINA`, `EXTENSION`, `CELULAR`, `ROL`, `ESTADO`) VALUES
(1, 'PAO', 'rojas', 'PAO', 'juro', 'PAO@unicauca.edu.co', '2014-11-04', 3, 4, '3154456361', NULL, NULL),
(2, 'julian', 'rojas', 'jlr', 'juro', 'jlr@unicauca.edu.co', '2014-11-04', 3, 4, '3154456361', NULL, NULL),
(3, 'andrea', 'pabon', 'andreapabon', 'juro', 'andrr@unicauca.edu.co', '2014-11-04', 3, 4, '3154456361', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carpeta`
--
ALTER TABLE `carpeta`
 ADD PRIMARY KEY (`CARPETAID`), ADD KEY `FK_CONTIENE` (`CAR_CARPETAID`), ADD KEY `FK_TIENE_ASOCIADAS` (`USUARIOID`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
 ADD PRIMARY KEY (`DOCID`), ADD KEY `FK_GESTIONA` (`USUARIOID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`USUARIOID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `USUARIOID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carpeta`
--
ALTER TABLE `carpeta`
ADD CONSTRAINT `FK_TIENE_ASOCIADAS` FOREIGN KEY (`USUARIOID`) REFERENCES `usuario` (`USUARIOID`),
ADD CONSTRAINT `FK_CONTIENE` FOREIGN KEY (`CAR_CARPETAID`) REFERENCES `carpeta` (`CARPETAID`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
ADD CONSTRAINT `FK_GESTIONA` FOREIGN KEY (`USUARIOID`) REFERENCES `usuario` (`USUARIOID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
