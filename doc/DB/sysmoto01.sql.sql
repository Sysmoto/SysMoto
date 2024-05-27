-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 24-05-2023 a las 21:09:23
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `finalv1`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMarcas` ()   BEGIN
SELECT MARCA_ID, MARCA_NOMBRE
FROM MARCA;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ARTICULO`
--

CREATE TABLE `ARTICULO` (
  `ART_ID` int NOT NULL,
  `PROVE_ID` int NOT NULL,
  `MODELO_ID` int NOT NULL,
  `ESTADOALERTA_ID` int NOT NULL,
  `EST_ART` int NOT NULL,
  `ART_CODIGO` int NOT NULL,
  `ART_PRECIOCOMPRA` decimal(10,2) NOT NULL,
  `ART_INFOADICIONAL` varchar(200) NOT NULL,
  `ART_UBICACION` varchar(100) NOT NULL,
  `ART_CODQR` varchar(250) DEFAULT NULL,
  `ART_FOTO` varchar(250) DEFAULT NULL,
  `ART_CODARTPROV` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `ARTICULO`
--

INSERT INTO `ARTICULO` (`ART_ID`, `PROVE_ID`, `MODELO_ID`, `ESTADOALERTA_ID`, `EST_ART`, `ART_CODIGO`, `ART_PRECIOCOMPRA`, `ART_INFOADICIONAL`, `ART_UBICACION`, `ART_CODQR`, `ART_FOTO`, `ART_CODARTPROV`) VALUES
(1, 1, 2, 1, 1, 1009324, '1080.00', 'DISCO EMBRAGUE XR', 'P1S1F1', 'XXXX', 'XXXX', 9324),
(2, 1, 1, 1, 1, 1002683, '2502.78', 'OPTICA DEL VOLKANO *', 'P1S1F2', 'XXX', 'XXX', 2683),
(3, 1, 2, 1, 1, 10011050, '8.98', 'PU¥OS TUNINNG C/LUZ JYM *', 'P1S1F3', 'XXX', 'XXX', 11050),
(4, 1, 2, 1, 1, 1009327, '1028.40', 'REPUESTOS VARIOS', '', 'XXX', 'XXX', 9327),
(5, 1, 2, 1, 1, 1009328, '2758.49', 'SERVICE COMPLETO', 'P1S4F2', 'XXX', 'XXX', 9328);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CIUDAD`
--

CREATE TABLE `CIUDAD` (
  `CIUDAD_ID` int NOT NULL,
  `PROVINCIA_ID` int NOT NULL,
  `CIUDAD_NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `CIUDAD`
--

INSERT INTO `CIUDAD` (`CIUDAD_ID`, `PROVINCIA_ID`, `CIUDAD_NOMBRE`) VALUES
(3, 1, 'Alta Gracia'),
(4, 1, 'Cordoba Capital');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CLIENTE`
--

CREATE TABLE `CLIENTE` (
  `CLIENTE_ID` int NOT NULL,
  `DOM_ID` int NOT NULL,
  `CONTACTO_ID` int NOT NULL,
  `CLIENTE_NOMBE` varchar(50) NOT NULL,
  `CLIENTE_APELLIDO` varchar(50) NOT NULL,
  `CLIENTE_FECHAALTA` date NOT NULL,
  `CLIENTE_FECHABAJA` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CONTACTO`
--

CREATE TABLE `CONTACTO` (
  `CONTACTO_ID` int NOT NULL,
  `CONTACTO_TEL1` varchar(13) NOT NULL,
  `CONTACTO_TEL2` varchar(13) DEFAULT NULL,
  `CONTACTO_EMAIL` varchar(100) DEFAULT NULL,
  `CONTACTO_WEB` varchar(255) DEFAULT NULL,
  `CONTACTO_INFO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `CONTACTO`
--

INSERT INTO `CONTACTO` (`CONTACTO_ID`, `CONTACTO_TEL1`, `CONTACTO_TEL2`, `CONTACTO_EMAIL`, `CONTACTO_WEB`, `CONTACTO_INFO`) VALUES
(1, '03512233445', NULL, 'j.perez@sysmoto.com.ar', NULL, NULL),
(2, '03515566778', NULL, 'c.ramirez@sysmoto.com.ar', NULL, NULL),
(3, '03512222333', NULL, 'r.gonzalez@sysmoto.com.ar', NULL, NULL),
(4, '03514444555', NULL, 'm.domingez@sysmoto.com.ar', NULL, NULL),
(5, '03512222777', NULL, 'r.garcia@sysmoto.com.ar', NULL, NULL),
(6, '03517777888', NULL, 'ventas@cordobamotos.com.ar', 'www.cordobamotos.com.ar', NULL),
(7, '03514141414', NULL, 'ventas@tabladamotos.com.ar', 'www.tabladamotos.com.ar', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DETALLEPEDPROVEEDOR`
--

CREATE TABLE `DETALLEPEDPROVEEDOR` (
  `PEDPROV_ID` int NOT NULL,
  `DETPEDPROV_ITEM` int DEFAULT NULL,
  `DETPEDPROV_CANT` int NOT NULL,
  `DETPEDPROVEEDOR_FECHA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DETALLEVENTA`
--

CREATE TABLE `DETALLEVENTA` (
  `VENTA_ID` int NOT NULL,
  `ID` int NOT NULL,
  `ART_ID` int NOT NULL,
  `DETVENTA_ITEM` int NOT NULL,
  `DETVENTA_CANT` int NOT NULL,
  `DETVENTA_PRECVTA` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DOMICILIO`
--

CREATE TABLE `DOMICILIO` (
  `DOM_ID` int NOT NULL,
  `CIUDAD_ID` int NOT NULL,
  `DOM_CALLE` varchar(30) NOT NULL,
  `DOM_ALTURA` int NOT NULL,
  `DOM_CP` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `DOMICILIO`
--

INSERT INTO `DOMICILIO` (`DOM_ID`, `CIUDAD_ID`, `DOM_CALLE`, `DOM_ALTURA`, `DOM_CP`) VALUES
(1, 3, 'Ruta 5', 42, '1859'),
(2, 4, 'Gral. Paz', 790, '5000'),
(3, 4, 'Sarmiento', 400, '5000'),
(4, 4, 'colon', 1200, '5000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADOALERTA`
--

CREATE TABLE `ESTADOALERTA` (
  `ESTADOALERTA_ID` int NOT NULL,
  `ESTADOALERTA_NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `ESTADOALERTA`
--

INSERT INTO `ESTADOALERTA` (`ESTADOALERTA_ID`, `ESTADOALERTA_NOMBRE`) VALUES
(1, 'Normal'),
(2, 'Bajo'),
(3, 'Critico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADOARTICULO`
--

CREATE TABLE `ESTADOARTICULO` (
  `EST_ART` int NOT NULL,
  `ESTADOART_NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `ESTADOARTICULO`
--

INSERT INTO `ESTADOARTICULO` (`EST_ART`, `ESTADOART_NOMBRE`) VALUES
(1, 'EnStock'),
(2, 'Faltante'),
(3, 'Anulado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADOPEDIDOPROVEEDOR`
--

CREATE TABLE `ESTADOPEDIDOPROVEEDOR` (
  `ESTPEDPROV_ID` int NOT NULL,
  `ESTPEDPROV_NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADOVENTA`
--

CREATE TABLE `ESTADOVENTA` (
  `ESTADOVENTA_ID` int NOT NULL,
  `ESTADOVENTA_NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `ESTADOVENTA`
--

INSERT INTO `ESTADOVENTA` (`ESTADOVENTA_ID`, `ESTADOVENTA_NOMBRE`) VALUES
(1, 'Pendiente'),
(2, 'En curso'),
(3, 'Anulado'),
(4, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MARCA`
--

CREATE TABLE `MARCA` (
  `MARCA_ID` int NOT NULL,
  `MARCA_NOMBRE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `MARCA`
--

INSERT INTO `MARCA` (`MARCA_ID`, `MARCA_NOMBRE`) VALUES
(1, '3B'),
(2, 'ALFA'),
(3, 'ATHON'),
(4, 'ATLANTIC'),
(5, 'BAJAJ'),
(6, 'BEON'),
(7, 'BGP'),
(8, 'BHI'),
(9, 'BRAVA'),
(10, 'BRN'),
(11, 'BRONCO'),
(12, 'BROT'),
(13, 'CARWO'),
(14, 'CASTROL'),
(15, 'CATALANO'),
(16, 'CATIMOTO'),
(17, 'CICLOTECNICA'),
(18, 'DEVRO'),
(19, 'DUCAL JUNTAS'),
(20, 'DYNAVOLTS'),
(21, 'FAR'),
(22, 'FORTE'),
(23, 'GM RACING'),
(24, 'HADA'),
(25, 'HALCON'),
(26, 'HOR FORTUNE'),
(27, 'IMPERIAL COR'),
(28, 'JC JUNTAS'),
(29, 'JOURNEY'),
(30, 'JRS'),
(31, 'JYM'),
(32, 'MAX5'),
(33, 'MMG'),
(34, 'MOTOMEL'),
(35, 'NSU'),
(36, 'OSAKA'),
(37, 'ROQUE PARRIL'),
(38, 'RUMISOIL'),
(39, 'SIN MARCA'),
(40, 'YAKAWA'),
(41, 'YAMASIDA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MODELO`
--

CREATE TABLE `MODELO` (
  `MODELO_ID` int NOT NULL,
  `MARCA_ID` int NOT NULL,
  `MODELO_NOMBRE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `MODELO`
--

INSERT INTO `MODELO` (`MODELO_ID`, `MARCA_ID`, `MODELO_NOMBRE`) VALUES
(1, 1, 'VOLKANO'),
(2, 1, '7A17'),
(3, 2, 'RX150'),
(4, 2, 'CRYPTON'),
(5, 2, 'STORN'),
(6, 2, 'SMASH'),
(7, 3, 'SMASH'),
(8, 3, 'CRYPTON'),
(9, 3, 'FZ16'),
(10, 3, 'SKUA'),
(11, 3, 'TITAN150'),
(12, 3, 'YBR125'),
(13, 3, 'RX150'),
(14, 4, 'ALTERNATIVO'),
(15, 4, 'SMASH'),
(16, 4, 'SIN MODELO'),
(17, 4, 'VARIOS'),
(18, 5, 'ALTERNATIVO'),
(19, 5, 'NS200'),
(20, 5, 'ROUSER135'),
(21, 6, 'ALTERNATIVO'),
(22, 7, 'VARIOS'),
(23, 7, 'ALTERNATIVO'),
(24, 7, 'RX150'),
(25, 7, 'SMASH'),
(26, 7, 'SKUA'),
(27, 7, 'STORN'),
(28, 7, 'TITAN'),
(29, 7, 'VECTRA'),
(30, 8, 'RX150'),
(31, 8, 'SMASH'),
(32, 9, 'ALTINO R'),
(33, 9, 'DK200'),
(34, 9, 'NEVADA'),
(35, 9, 'TEXANA'),
(36, 9, 'SKUA'),
(37, 9, 'SKUA150M/N'),
(38, 9, 'AQUILA200'),
(39, 9, 'RX150'),
(40, 9, 'ELECTRA'),
(41, 9, 'ALTERNATIVO'),
(42, 9, 'SMASH'),
(43, 9, 'VX150'),
(44, 10, 'SKUA200'),
(45, 11, 'ALTERNATIVO'),
(46, 11, 'ACCESORIO'),
(47, 11, 'TITAN'),
(48, 11, '7A17'),
(49, 11, 'TWISTER'),
(50, 12, 'ALTERNATIVO'),
(51, 12, 'VARIOS'),
(52, 13, 'ALTERNATIVO'),
(53, 14, 'ALTERNATIVO'),
(54, 15, 'RIDER'),
(55, 15, 'ZTT'),
(56, 15, 'WAVE'),
(57, 16, 'SMASH'),
(58, 16, 'RX150'),
(59, 16, 'SKUA'),
(60, 16, 'WAVE'),
(61, 16, 'YBR125'),
(62, 16, 'TITAN150'),
(63, 16, 'ALTERNATIVO'),
(64, 16, 'STORN'),
(65, 16, 'CG150'),
(66, 16, 'BIT110'),
(67, 16, 'BIZ'),
(68, 16, 'AX100'),
(69, 16, 'CRYPTON'),
(70, 16, 'FZ16'),
(71, 16, 'TORNADO'),
(72, 16, 'BAJAJ120'),
(73, 16, 'BLITZ125'),
(74, 16, 'BROSS'),
(75, 16, 'DAX70'),
(76, 16, 'C110'),
(77, 16, 'CGS3'),
(78, 16, 'CUSTOM150'),
(79, 16, 'CGS2'),
(80, 16, 'CE150'),
(81, 16, 'TITAN'),
(82, 16, 'VARIOS'),
(83, 16, 'SKUA150M/N'),
(84, 16, 'ROUSER200'),
(85, 16, 'MOTARD'),
(86, 16, 'MAX110'),
(87, 17, 'MOTARD'),
(88, 18, 'TITAN'),
(89, 19, 'TITAN'),
(90, 20, 'VARIOS'),
(91, 21, 'MOTARD'),
(92, 21, 'TITAN'),
(93, 22, 'ROUSER200'),
(94, 22, 'MAX110'),
(95, 23, 'MOTARD'),
(96, 23, 'VARIOS'),
(97, 23, 'TITAN'),
(98, 24, 'ROUSER200'),
(99, 25, 'VARIOS'),
(100, 26, 'VARIOS'),
(101, 27, 'VARIOS'),
(102, 28, 'MOTARD'),
(103, 29, 'VARIOS'),
(104, 30, 'TITAN'),
(105, 31, 'TITAN'),
(106, 32, '7A17'),
(107, 32, 'ACCESORIO'),
(108, 32, 'ALTERNATIVO'),
(109, 32, 'ALTINO R'),
(110, 32, 'AX100'),
(111, 32, 'BAJAJ220'),
(112, 32, 'BIT110'),
(113, 32, 'BIZ'),
(114, 32, 'BIZ125'),
(115, 32, 'BLITZ125'),
(116, 32, 'BROSS'),
(117, 32, 'CB1'),
(118, 32, 'TITAN'),
(119, 32, 'SMASH'),
(120, 32, 'CRYPTON'),
(121, 32, 'RX150'),
(122, 32, 'YBR125'),
(123, 32, 'TITAN150'),
(124, 32, 'SKUA'),
(125, 32, 'FZ16'),
(126, 32, 'NEW TITAN15'),
(127, 32, 'DAKAR'),
(128, 32, 'WAVE'),
(129, 32, 'ZB125'),
(130, 32, 'TORNADO'),
(131, 32, 'NEW CRYPTON'),
(132, 32, 'MOTARD'),
(133, 32, 'CGS2'),
(134, 32, 'CUSTOM150'),
(135, 32, 'STORN'),
(136, 32, 'MAX110'),
(137, 32, 'TWISTER'),
(138, 32, 'NS200'),
(139, 32, 'XMM250'),
(140, 32, 'XTZ125'),
(141, 32, 'RX200'),
(142, 32, 'ROUSER200'),
(143, 32, 'ROUSER220'),
(144, 32, 'SKUA250'),
(145, 32, 'XLR125'),
(146, 32, 'DAX70'),
(147, 32, 'ZTT'),
(148, 32, 'CG125'),
(149, 32, 'ROUSER135'),
(150, 32, 'FUSION'),
(151, 32, 'DK200'),
(152, 32, 'CGS3'),
(153, 33, 'DK200'),
(154, 34, 'DK200'),
(155, 34, 'CGS3'),
(156, 35, 'DK200'),
(157, 35, 'CGS3'),
(158, 36, 'DK200'),
(159, 37, 'DK200'),
(160, 38, 'DK200'),
(161, 39, 'DK200'),
(162, 40, 'DK200'),
(163, 41, 'DK200');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PEDIDOPROVEEDOR`
--

CREATE TABLE `PEDIDOPROVEEDOR` (
  `PEDPROV_ID` int NOT NULL,
  `ID` int NOT NULL,
  `TIPOINGRESO_ID` int NOT NULL,
  `ESTPEDPROV_ID` int NOT NULL,
  `PROVE_ID` int NOT NULL,
  `ART_ID` int NOT NULL,
  `PEDPROV_FECHACOMPRA` date NOT NULL,
  `PEDPROV_FECHAENTREGA` date NOT NULL,
  `PEDPROV_FECHAANULACION` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROVEEDORES`
--

CREATE TABLE `PROVEEDORES` (
  `PROVE_ID` int NOT NULL,
  `DOM_ID` int NOT NULL,
  `CONTACTO_ID` int NOT NULL,
  `PROVE_NOMBRE` varchar(100) NOT NULL,
  `PROVE_INFO` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `PROVEEDORES`
--

INSERT INTO `PROVEEDORES` (`PROVE_ID`, `DOM_ID`, `CONTACTO_ID`, `PROVE_NOMBRE`, `PROVE_INFO`) VALUES
(1, 3, 6, 'CordobaMotos', NULL),
(2, 4, 7, 'TabladaMotos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROVINCIA`
--

CREATE TABLE `PROVINCIA` (
  `PROVINCIA_ID` int NOT NULL,
  `PROVINCIA_NOMBRE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `PROVINCIA`
--

INSERT INTO `PROVINCIA` (`PROVINCIA_ID`, `PROVINCIA_NOMBRE`) VALUES
(1, 'Cordoba'),
(2, 'Buenos Aires');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ROL`
--

CREATE TABLE `ROL` (
  `ROL_ID` int NOT NULL,
  `ROL_PRIVILEGIO` int NOT NULL,
  `ROL_DESC` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `ROL`
--

INSERT INTO `ROL` (`ROL_ID`, `ROL_PRIVILEGIO`, `ROL_DESC`) VALUES
(1, 1, 'Administrador'),
(2, 2, 'Compras'),
(3, 3, 'Ventas'),
(4, 4, 'Almacen'),
(5, 5, 'Gerencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ROLES`
--

CREATE TABLE `ROLES` (
  `ID` int NOT NULL,
  `ROL` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `ROLES`
--

INSERT INTO `ROLES` (`ID`, `ROL`) VALUES
(1, 'Administrador'),
(2, 'Compras'),
(3, 'Ventas'),
(4, 'Almacen'),
(5, 'Gerencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `STOCK`
--

CREATE TABLE `STOCK` (
  `ART_ID` int NOT NULL,
  `CANT_STOCK` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `STOCK`
--

INSERT INTO `STOCK` (`ART_ID`, `CANT_STOCK`) VALUES
(1, 2),
(2, 4),
(3, 3),
(4, 34),
(5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TIPOINGRESO`
--

CREATE TABLE `TIPOINGRESO` (
  `TIPOINGRESO_ID` int NOT NULL,
  `TIPOINGRESO_NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `ID` int NOT NULL,
  `DOM_ID` int NOT NULL,
  `ROL_ID` int NOT NULL,
  `CONTACTO_ID` int NOT NULL,
  `IDROL` int NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDO` varchar(50) NOT NULL,
  `USUARIO` varchar(50) NOT NULL,
  `CLAVE` varchar(50) NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `IMAGEN` varchar(60) NOT NULL,
  `ACTIVO` int NOT NULL,
  `FECHACREACION` date NOT NULL,
  `SEXO` varchar(1) NOT NULL,
  `ULT_LOGIN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`ID`, `DOM_ID`, `ROL_ID`, `CONTACTO_ID`, `IDROL`, `NOMBRE`, `APELLIDO`, `USUARIO`, `CLAVE`, `EMAIL`, `IMAGEN`, `ACTIVO`, `FECHACREACION`, `SEXO`, `ULT_LOGIN`) VALUES
(1, 1, 2, 1, 2, 'Juan', 'Perez', 'j.perez', '2a1433abf5954a4f65b7aa0895b27a64', 'j.perez@sysmoto.com.ar', 'user-01.png', 1, '2023-04-24', 'O', '2023-05-17'),
(2, 1, 4, 2, 4, 'Cecilia', 'Ramirez', 'c.ramirez', '68bdc8bc82c7907f161f9bfd22ce48ab', 'c.ramirez@sysmoto.com.ar', 'user-02.png', 1, '2023-04-24', 'M', '2023-05-18'),
(3, 1, 1, 3, 1, 'Raul', 'Gonzalez', 'r.gonzalez', 'e4bb63f4528ea09c472855f543717b97', 'r.gonzalez@sysmoto.com.ar', 'user-03.png', 1, '2023-04-24', 'M', '2023-05-18'),
(4, 2, 3, 4, 3, 'Maria', 'Dominguez', 'm.dominguez', '1766b530772042e85dbcce3f35c923a4', 'm.domingez@sysmoto.com.ar', 'user-04.png', 1, '2023-04-24', 'F', '2023-05-17'),
(5, 2, 5, 5, 5, 'Roberto', 'Garcia', 'r.garcia', '2d5b8ccd9fab019bc5626d66b6b7aa70', 'r.garcia@sysmoto.com.ar', 'user-05.png', 1, '2023-04-24', 'M', '2023-05-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `VENTA`
--

CREATE TABLE `VENTA` (
  `VENTA_ID` int NOT NULL,
  `CLIENTE_ID` int NOT NULL,
  `ESTADOVENTA_ID` int NOT NULL,
  `VENTA_FECHAVENTA` date NOT NULL,
  `VENTA_FECHAENTREGA` date NOT NULL,
  `VENTA_FECHAANULACION` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ARTICULO`
--
ALTER TABLE `ARTICULO`
  ADD PRIMARY KEY (`ART_ID`),
  ADD KEY `PROVE_ID` (`PROVE_ID`),
  ADD KEY `MODELO_ID` (`MODELO_ID`),
  ADD KEY `ESTADOALERTA_ID` (`ESTADOALERTA_ID`),
  ADD KEY `EST_ART` (`EST_ART`);

--
-- Indices de la tabla `CIUDAD`
--
ALTER TABLE `CIUDAD`
  ADD PRIMARY KEY (`CIUDAD_ID`),
  ADD KEY `PROVINCIA_ID` (`PROVINCIA_ID`);

--
-- Indices de la tabla `CLIENTE`
--
ALTER TABLE `CLIENTE`
  ADD PRIMARY KEY (`CLIENTE_ID`),
  ADD KEY `DOM_ID` (`DOM_ID`),
  ADD KEY `CONTACTO_ID` (`CONTACTO_ID`);

--
-- Indices de la tabla `CONTACTO`
--
ALTER TABLE `CONTACTO`
  ADD PRIMARY KEY (`CONTACTO_ID`);

--
-- Indices de la tabla `DETALLEPEDPROVEEDOR`
--
ALTER TABLE `DETALLEPEDPROVEEDOR`
  ADD PRIMARY KEY (`PEDPROV_ID`);

--
-- Indices de la tabla `DETALLEVENTA`
--
ALTER TABLE `DETALLEVENTA`
  ADD PRIMARY KEY (`VENTA_ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `ART_ID` (`ART_ID`);

--
-- Indices de la tabla `DOMICILIO`
--
ALTER TABLE `DOMICILIO`
  ADD PRIMARY KEY (`DOM_ID`),
  ADD KEY `CIUDAD_ID` (`CIUDAD_ID`);

--
-- Indices de la tabla `ESTADOALERTA`
--
ALTER TABLE `ESTADOALERTA`
  ADD PRIMARY KEY (`ESTADOALERTA_ID`);

--
-- Indices de la tabla `ESTADOARTICULO`
--
ALTER TABLE `ESTADOARTICULO`
  ADD PRIMARY KEY (`EST_ART`);

--
-- Indices de la tabla `ESTADOPEDIDOPROVEEDOR`
--
ALTER TABLE `ESTADOPEDIDOPROVEEDOR`
  ADD PRIMARY KEY (`ESTPEDPROV_ID`);

--
-- Indices de la tabla `ESTADOVENTA`
--
ALTER TABLE `ESTADOVENTA`
  ADD PRIMARY KEY (`ESTADOVENTA_ID`);

--
-- Indices de la tabla `MARCA`
--
ALTER TABLE `MARCA`
  ADD PRIMARY KEY (`MARCA_ID`);

--
-- Indices de la tabla `MODELO`
--
ALTER TABLE `MODELO`
  ADD PRIMARY KEY (`MODELO_ID`),
  ADD KEY `MARCA_ID` (`MARCA_ID`);

--
-- Indices de la tabla `PEDIDOPROVEEDOR`
--
ALTER TABLE `PEDIDOPROVEEDOR`
  ADD PRIMARY KEY (`PEDPROV_ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `TIPOINGRESO_ID` (`TIPOINGRESO_ID`),
  ADD KEY `ESTPEDPROV_ID` (`ESTPEDPROV_ID`),
  ADD KEY `PROVE_ID` (`PROVE_ID`),
  ADD KEY `ART_ID` (`ART_ID`);

--
-- Indices de la tabla `PROVEEDORES`
--
ALTER TABLE `PROVEEDORES`
  ADD PRIMARY KEY (`PROVE_ID`),
  ADD KEY `DOM_ID` (`DOM_ID`),
  ADD KEY `CONTACTO_ID` (`CONTACTO_ID`);

--
-- Indices de la tabla `PROVINCIA`
--
ALTER TABLE `PROVINCIA`
  ADD PRIMARY KEY (`PROVINCIA_ID`);

--
-- Indices de la tabla `ROL`
--
ALTER TABLE `ROL`
  ADD PRIMARY KEY (`ROL_ID`);

--
-- Indices de la tabla `ROLES`
--
ALTER TABLE `ROLES`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IdRol` (`ID`);

--
-- Indices de la tabla `STOCK`
--
ALTER TABLE `STOCK`
  ADD PRIMARY KEY (`ART_ID`);

--
-- Indices de la tabla `TIPOINGRESO`
--
ALTER TABLE `TIPOINGRESO`
  ADD PRIMARY KEY (`TIPOINGRESO_ID`);

--
-- Indices de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DOM_ID` (`DOM_ID`),
  ADD KEY `ROL_ID` (`ROL_ID`),
  ADD KEY `CONTACTO_ID` (`CONTACTO_ID`);

--
-- Indices de la tabla `VENTA`
--
ALTER TABLE `VENTA`
  ADD PRIMARY KEY (`VENTA_ID`),
  ADD KEY `CLIENTE_ID` (`CLIENTE_ID`),
  ADD KEY `ESTADOVENTA_ID` (`ESTADOVENTA_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ARTICULO`
--
ALTER TABLE `ARTICULO`
  MODIFY `ART_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `CIUDAD`
--
ALTER TABLE `CIUDAD`
  MODIFY `CIUDAD_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `CLIENTE`
--
ALTER TABLE `CLIENTE`
  MODIFY `CLIENTE_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `CONTACTO`
--
ALTER TABLE `CONTACTO`
  MODIFY `CONTACTO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `DOMICILIO`
--
ALTER TABLE `DOMICILIO`
  MODIFY `DOM_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ESTADOALERTA`
--
ALTER TABLE `ESTADOALERTA`
  MODIFY `ESTADOALERTA_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ESTADOARTICULO`
--
ALTER TABLE `ESTADOARTICULO`
  MODIFY `EST_ART` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ESTADOPEDIDOPROVEEDOR`
--
ALTER TABLE `ESTADOPEDIDOPROVEEDOR`
  MODIFY `ESTPEDPROV_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ESTADOVENTA`
--
ALTER TABLE `ESTADOVENTA`
  MODIFY `ESTADOVENTA_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `MARCA`
--
ALTER TABLE `MARCA`
  MODIFY `MARCA_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `MODELO`
--
ALTER TABLE `MODELO`
  MODIFY `MODELO_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT de la tabla `PEDIDOPROVEEDOR`
--
ALTER TABLE `PEDIDOPROVEEDOR`
  MODIFY `PEDPROV_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `PROVEEDORES`
--
ALTER TABLE `PROVEEDORES`
  MODIFY `PROVE_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `PROVINCIA`
--
ALTER TABLE `PROVINCIA`
  MODIFY `PROVINCIA_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ROL`
--
ALTER TABLE `ROL`
  MODIFY `ROL_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ROLES`
--
ALTER TABLE `ROLES`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `TIPOINGRESO`
--
ALTER TABLE `TIPOINGRESO`
  MODIFY `TIPOINGRESO_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `VENTA`
--
ALTER TABLE `VENTA`
  MODIFY `VENTA_ID` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ARTICULO`
--
ALTER TABLE `ARTICULO`
  ADD CONSTRAINT `ARTICULO_ibfk_1` FOREIGN KEY (`PROVE_ID`) REFERENCES `PROVEEDORES` (`PROVE_ID`),
  ADD CONSTRAINT `ARTICULO_ibfk_2` FOREIGN KEY (`MODELO_ID`) REFERENCES `MODELO` (`MODELO_ID`),
  ADD CONSTRAINT `ARTICULO_ibfk_3` FOREIGN KEY (`ESTADOALERTA_ID`) REFERENCES `ESTADOALERTA` (`ESTADOALERTA_ID`),
  ADD CONSTRAINT `ARTICULO_ibfk_4` FOREIGN KEY (`EST_ART`) REFERENCES `ESTADOARTICULO` (`EST_ART`);

--
-- Filtros para la tabla `CIUDAD`
--
ALTER TABLE `CIUDAD`
  ADD CONSTRAINT `CIUDAD_ibfk_1` FOREIGN KEY (`PROVINCIA_ID`) REFERENCES `PROVINCIA` (`PROVINCIA_ID`);

--
-- Filtros para la tabla `CLIENTE`
--
ALTER TABLE `CLIENTE`
  ADD CONSTRAINT `CLIENTE_ibfk_1` FOREIGN KEY (`DOM_ID`) REFERENCES `DOMICILIO` (`DOM_ID`),
  ADD CONSTRAINT `CLIENTE_ibfk_2` FOREIGN KEY (`CONTACTO_ID`) REFERENCES `CONTACTO` (`CONTACTO_ID`);

--
-- Filtros para la tabla `DETALLEPEDPROVEEDOR`
--
ALTER TABLE `DETALLEPEDPROVEEDOR`
  ADD CONSTRAINT `DETALLEPEDPROVEEDOR_ibfk_1` FOREIGN KEY (`PEDPROV_ID`) REFERENCES `PEDIDOPROVEEDOR` (`PEDPROV_ID`);

--
-- Filtros para la tabla `DETALLEVENTA`
--
ALTER TABLE `DETALLEVENTA`
  ADD CONSTRAINT `DETALLEVENTA_ibfk_1` FOREIGN KEY (`VENTA_ID`) REFERENCES `VENTA` (`VENTA_ID`),
  ADD CONSTRAINT `DETALLEVENTA_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `USUARIOS` (`ID`),
  ADD CONSTRAINT `DETALLEVENTA_ibfk_3` FOREIGN KEY (`ART_ID`) REFERENCES `ARTICULO` (`ART_ID`);

--
-- Filtros para la tabla `DOMICILIO`
--
ALTER TABLE `DOMICILIO`
  ADD CONSTRAINT `DOMICILIO_ibfk_1` FOREIGN KEY (`CIUDAD_ID`) REFERENCES `CIUDAD` (`CIUDAD_ID`);

--
-- Filtros para la tabla `MODELO`
--
ALTER TABLE `MODELO`
  ADD CONSTRAINT `MODELO_ibfk_1` FOREIGN KEY (`MARCA_ID`) REFERENCES `MARCA` (`MARCA_ID`);

--
-- Filtros para la tabla `PEDIDOPROVEEDOR`
--
ALTER TABLE `PEDIDOPROVEEDOR`
  ADD CONSTRAINT `PEDIDOPROVEEDOR_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `USUARIOS` (`ID`),
  ADD CONSTRAINT `PEDIDOPROVEEDOR_ibfk_2` FOREIGN KEY (`TIPOINGRESO_ID`) REFERENCES `TIPOINGRESO` (`TIPOINGRESO_ID`),
  ADD CONSTRAINT `PEDIDOPROVEEDOR_ibfk_3` FOREIGN KEY (`ESTPEDPROV_ID`) REFERENCES `ESTADOPEDIDOPROVEEDOR` (`ESTPEDPROV_ID`),
  ADD CONSTRAINT `PEDIDOPROVEEDOR_ibfk_4` FOREIGN KEY (`PROVE_ID`) REFERENCES `PROVEEDORES` (`PROVE_ID`),
  ADD CONSTRAINT `PEDIDOPROVEEDOR_ibfk_5` FOREIGN KEY (`ART_ID`) REFERENCES `ARTICULO` (`ART_ID`);

--
-- Filtros para la tabla `PROVEEDORES`
--
ALTER TABLE `PROVEEDORES`
  ADD CONSTRAINT `PROVEEDORES_ibfk_1` FOREIGN KEY (`DOM_ID`) REFERENCES `DOMICILIO` (`DOM_ID`),
  ADD CONSTRAINT `PROVEEDORES_ibfk_2` FOREIGN KEY (`CONTACTO_ID`) REFERENCES `CONTACTO` (`CONTACTO_ID`);

--
-- Filtros para la tabla `STOCK`
--
ALTER TABLE `STOCK`
  ADD CONSTRAINT `STOCK_ibfk_1` FOREIGN KEY (`ART_ID`) REFERENCES `ARTICULO` (`ART_ID`);

--
-- Filtros para la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD CONSTRAINT `USUARIOS_ibfk_1` FOREIGN KEY (`DOM_ID`) REFERENCES `DOMICILIO` (`DOM_ID`),
  ADD CONSTRAINT `USUARIOS_ibfk_2` FOREIGN KEY (`ROL_ID`) REFERENCES `ROL` (`ROL_ID`),
  ADD CONSTRAINT `USUARIOS_ibfk_3` FOREIGN KEY (`CONTACTO_ID`) REFERENCES `CONTACTO` (`CONTACTO_ID`),
  ADD CONSTRAINT `USUARIOS_ibfk_4` FOREIGN KEY (`ID`) REFERENCES `ROLES` (`ID`);

--
-- Filtros para la tabla `VENTA`
--
ALTER TABLE `VENTA`
  ADD CONSTRAINT `VENTA_ibfk_1` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `CLIENTE` (`CLIENTE_ID`),
  ADD CONSTRAINT `VENTA_ibfk_2` FOREIGN KEY (`ESTADOVENTA_ID`) REFERENCES `ESTADOVENTA` (`ESTADOVENTA_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
