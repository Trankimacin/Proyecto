-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-11-2017 a las 18:31:34
-- Versión del servidor: 5.1.41-community
-- Versión de PHP: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE IF NOT EXISTS `articulos` (
  `cod_articulo` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `entradilla` varchar(250) NOT NULL,
  `texto` text NOT NULL,
  `cod_revista` smallint(5) unsigned NOT NULL,
  `cod_autor` smallint(5) unsigned DEFAULT NULL,
  `cod_imagen` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`cod_articulo`),
  UNIQUE KEY `titulo` (`titulo`),
  KEY `cod_revista` (`cod_revista`),
  KEY `cod_autor` (`cod_autor`),
  KEY `cod_imagen` (`cod_imagen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE IF NOT EXISTS `autores` (
  `cod_autor` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `cod_imagen` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ruta` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_imagen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revistas`
--

CREATE TABLE IF NOT EXISTS `revistas` (
  `cod_revista` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `numero` smallint(5) unsigned NOT NULL,
  `fecha` varchar(25) NOT NULL,
  `portada` varchar(100) NOT NULL,
  `publicada` bit(1) NOT NULL,
  PRIMARY KEY (`cod_revista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `cod_usuario` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `pass` char(8) NOT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`cod_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `usuario`, `pass`, `estado`) VALUES
(2, 'pepe@hotmail.com', 'qwerqwer', '1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`cod_revista`) REFERENCES `revistas` (`cod_revista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`cod_autor`) REFERENCES `autores` (`cod_autor`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `articulos_ibfk_3` FOREIGN KEY (`cod_imagen`) REFERENCES `imagenes` (`cod_imagen`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
