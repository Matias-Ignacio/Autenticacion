
-- 
-- Base de datos: `autenticacion`
-- 

-- --------------------------------------------------------
CREATE DATABASE `autenticacion`;
-- 
-- Estructura de tabla para la tabla `usuario`
-- 

CREATE TABLE `usuario` (
	`idusuario` bigint(20) NOT NULL,
	`usnombre` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
	`uspass` int(11) NOT NULL,
	`usmail` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
	`usdeshabilitado` TIMESTAMP,
  PRIMARY KEY  (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `rol`
-- 
CREATE TABLE `rol` (
	`idrol` bigint(20) NOT NULL,
	`rodescripcion` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
	PRIMARY KEY  (`idrol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `usuariorol`
-- 
CREATE TABLE `usuariorol`(
	`idusuario` bigint(20) NOT NULL,
	`idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `usuariorol` ADD KEY `idusuario` (`idusuario`);
ALTER TABLE `usuariorol` ADD KEY `idrol` (`idrol`);

ALTER TABLE `usuariorol`
ADD CONSTRAINT `usuariorol_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`);

INSERT INTO usuario (idusuario, usnombre, uspass, usmail, usdeshabilitado) VALUES
	(1, 'Roberto Claro', 11111, 'mail@mail.com', ''),
	(2, 'Juan Claros', 22222, 'mail@mail.com', ''),
	(3, 'Lolo Caros', 22222, 'mail@mail.com', ''),
	(4, 'Jose Carlos', 22222, 'mail@mail.com', ''),
	(5, 'Martin Bhaj', 22222, 'mail@mail.com', ''),
	(6, 'Juana Oscuro', 22222, 'mail@mail.com', ''),
	(7, 'Ana Oscu', 22222, 'mail@mail.com', '');
	
INSERT INTO rol (idrol, rodescripcion) VALUES
	(1, 'comun'),
	(2, 'encargado'),
	(3, 'admin');
	
INSERT INTO usuariorol (idusuario, idrol) VALUES
	(1, 1),
	(1, 2),
	(2, 1),
	(3, 1),
	(4, 3),
	(5, 2);