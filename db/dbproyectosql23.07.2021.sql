-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2021 a las 07:57:24
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbproyectosql`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bus`
--

CREATE TABLE `bus` (
  `id_bus` int(11) NOT NULL,
  `placa` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `estado`, `id_usuario`) VALUES
(2, 'aceites', '1', 1),
(6, 'jabones', '1', 1),
(7, 'harinas', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `cedula_cliente` varchar(100) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `apellido_cliente` varchar(100) NOT NULL,
  `telefono_cliente` varchar(100) NOT NULL,
  `correo_cliente` varchar(100) NOT NULL,
  `direccion_cliente` varchar(100) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `cedula_cliente`, `nombre_cliente`, `apellido_cliente`, `telefono_cliente`, `correo_cliente`, `direccion_cliente`, `fecha_ingreso`, `estado`, `id_usuario`) VALUES
(1, '1', 'ninguno', 'ninguno', '0', 'ninguno', 'ninguno', '2021-07-16', '1', 1),
(5, '159966666', 'Jorge', 'Rodriguez', '459966666', 'jorge@gmail.com', 'california', '2018-02-05', '0', 1),
(6, '45', 'karla', 'rodriguez', '789', 'karla@gmail.com', 'chicago', '2018-02-13', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cmx_estado`
--

CREATE TABLE `cmx_estado` (
  `id_estado_cumplimiento` int(11) NOT NULL,
  `estado_cumplimiento` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cmx_estado`
--

INSERT INTO `cmx_estado` (`id_estado_cumplimiento`, `estado_cumplimiento`) VALUES
(1, 'cumplido'),
(2, 'no cumplido'),
(3, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cmx_matriz`
--

CREATE TABLE `cmx_matriz` (
  `id_matriz` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_entidad` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `compromiso` varchar(1000) NOT NULL,
  `entidad_responsable` varchar(1000) NOT NULL,
  `contacto` varchar(500) NOT NULL,
  `fecha_cumplimiento` varchar(500) NOT NULL,
  `observaciones` varchar(1000) NOT NULL,
  `estado_cumplimiento` int(11) NOT NULL,
  `fecha_actualizacion` datetimcmx_matrize NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cmx_matriz`
--

INSERT INTO `cmx_matriz` (`id_matriz`, `id_tema`, `id_entidad`, `id_pais`, `compromiso`, `entidad_responsable`, `contacto`, `fecha_cumplimiento`, `observaciones`, `estado_cumplimiento`, `fecha_actualizacion`, `id_usuario`) VALUES
(1, 1, 1, 4, 'compromiso 1', 'entidad 1', 'contacto 1', '2021-07-19', 'observaciones 1', 1, '2021-07-19 00:00:00', 3),
(2, 1, 1, 4, 'compromiso 2', 'entidad 2', 'contacto 2', '2021-07-19', 'ibservaciones 2', 1, '2021-07-19 00:00:00', 1),
(3, 2, 3, 4, '85', '3', '3', '3', 'observación 3', 1, '2021-07-19 17:13:33', 3),
(4, 1, 4, 4, 'comp4', 'ent4', 'cont4|', 'fecha4', 'obs4 cumplido', 1, '2021-07-20 04:02:39', 4),
(5, 1, 3, 2, 'c5', 'en5', 'con5', 'f5', 'observacion 5', 1, '2021-07-20 05:51:35', 3),
(6, 1, 5, 2, '5', '5', '5', '5', '5', 1, '2021-07-20 06:02:08', 3),
(7, 1, 6, 2, '6', '6', '6', '6', '6', 1, '2021-07-20 06:04:02', 3),
(8, 1, 0, 0, 'prueba  v7', 'prueba  v7', 'prueba  v7', 'prueba  v7', 'prueba  v7', 1, '2021-07-22 17:13:36', 5),
(9, 2, 0, 4, 'prueba v7', 'prueba v7', 'prueba v7', 'prueba v7', 'se realizo el cambio', 1, '2021-07-22 17:31:14', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cmx_tema`
--

CREATE TABLE `cmx_tema` (
  `id_tema` int(11) NOT NULL,
  `tema` varchar(1000) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cmx_tema`
--

INSERT INTO `cmx_tema` (`id_tema`, `tema`, `id_usuario`) VALUES
(1, 'Mesa 1. Reducción de la oferta', 1),
(2, 'Mesa 2. Reducción de la demanda', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compras` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `numero_compra` varchar(100) NOT NULL,
  `proveedor` varchar(100) NOT NULL,
  `cedula_proveedor` varchar(100) NOT NULL,
  `comprador` varchar(100) NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `subtotal` varchar(100) NOT NULL,
  `total_iva` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tipo_pago` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compras`, `fecha_compra`, `numero_compra`, `proveedor`, `cedula_proveedor`, `comprador`, `moneda`, `subtotal`, `total_iva`, `total`, `tipo_pago`, `estado`, `id_usuario`, `id_proveedor`) VALUES
(1, '2018-01-31', 'F000001', 'luis lopez', '14789', 'eyter', 'USD$', '100', '20', '120', 'CHEQUE', '0', 1, 3),
(2, '2018-02-06', 'F000002', 'luis lopez', '14789', 'eyter', 'USD$', '400', '80', '480', 'CHEQUE', '0', 1, 3),
(3, '2018-02-07', 'F000003', 'luis lopez', '14789', 'eyter', 'USD$', '400', '80', '480', 'EFECTIVO', '1', 1, 3),
(4, '2018-02-07', 'F000004', 'luis lopez', '14789', 'eyter', 'USD$', '160', '32', '192', 'EFECTIVO', '1', 1, 3),
(7, '2018-10-26', 'F000005', 'roberto perez', '45965', 'eyter', 'USD$', '280', '56', '336', 'CHEQUE', '0', 1, 4),
(8, '2021-07-15', 'F000006', 'roberto perez', '45965', 'eyter', 'USD$', '100', '20', '120', 'CHEQUE', '1', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductor`
--

CREATE TABLE `conductor` (
  `id_conductor` int(11) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `licencia` varchar(200) NOT NULL,
  `telefono` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `id_detalle_compras` int(11) NOT NULL,
  `numero_compra` varchar(100) NOT NULL,
  `cedula_proveedor` varchar(100) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `precio_compra` varchar(100) NOT NULL,
  `cantidad_compra` varchar(100) NOT NULL,
  `descuento` varchar(100) NOT NULL,
  `importe` varchar(100) NOT NULL,
  `fecha_compra` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_compras`
--

INSERT INTO `detalle_compras` (`id_detalle_compras`, `numero_compra`, `cedula_proveedor`, `id_producto`, `producto`, `moneda`, `precio_compra`, `cantidad_compra`, `descuento`, `importe`, `fecha_compra`, `id_usuario`, `id_proveedor`, `estado`, `id_categoria`) VALUES
(1, 'F000001', '14789', 4, 'jabon ACE', 'USD$', '100', '1', '0', '100', '2018-01-31', 1, 3, '0', 6),
(2, 'F000002', '14789', 9, 'jabon casa', 'USD$', '80', '5', '0', '400', '2018-02-06', 1, 3, '0', 6),
(3, 'F000003', '14789', 4, 'jabon ACE', 'USD$', '100', '4', '0', '400', '2018-02-07', 1, 3, '1', 6),
(4, 'F000004', '14789', 7, 'harina pan', 'USD$', '60', '1', '0', '60', '2018-02-07', 1, 3, '1', 7),
(5, 'F000004', '14789', 4, 'jabon ACE', 'USD$', '100', '1', '0', '100', '2018-02-07', 1, 3, '1', 6),
(9, 'F000005', '45965', 4, 'jabon ACE', 'USD$', '100', '2', '0', '200', '2018-10-26', 1, 4, '0', 6),
(10, 'F000005', '45965', 9, 'jabon casa', 'USD$', '80', '1', '0', '80', '2018-10-26', 1, 4, '0', 6),
(11, 'F000006', '45965', 4, 'jabon ACE', 'USD$', '100', '1', '0', '100', '2021-07-15', 1, 4, '1', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id_detalle_ventas` int(11) NOT NULL,
  `numero_venta` varchar(100) NOT NULL,
  `cedula_cliente` varchar(100) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `precio_venta` varchar(100) NOT NULL,
  `cantidad_venta` varchar(100) NOT NULL,
  `descuento` varchar(100) NOT NULL,
  `importe` varchar(100) NOT NULL,
  `fecha_venta` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id_detalle_ventas`, `numero_venta`, `cedula_cliente`, `id_producto`, `producto`, `moneda`, `precio_venta`, `cantidad_venta`, `descuento`, `importe`, `fecha_venta`, `id_usuario`, `id_cliente`, `estado`) VALUES
(2, 'F000001', '159966666', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(3, 'F000002', '159966666', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(4, 'F000002', '159966666', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(5, 'F000002', '159966666', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2018-02-07', 1, 5, '1'),
(12, 'F000003', '159966666', 4, 'jabon ACE', 'USD$', '200', '2', '0', '400', '2018-10-26', 1, 5, '0'),
(13, 'F000003', '159966666', 8, 'pan ', 'USD$', '81', '1', '0', '81', '2018-10-26', 1, 5, '0'),
(14, 'F000004', '159966666', 4, 'jabon ACE', 'USD$', '200', '2', '0', '400', '2021-07-14', 1, 5, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `cedula_empresa` varchar(100) NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `direccion_empresa` varchar(100) NOT NULL,
  `correo_empresa` varchar(100) NOT NULL,
  `telefono_empresa` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `cedula_empresa`, `nombre_empresa`, `direccion_empresa`, `correo_empresa`, `telefono_empresa`, `id_usuario`) VALUES
(1, '1223459988', 'eyter', 'california san jose', 'eyterdaniel@gmail.com', '12899665588', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlace`
--

CREATE TABLE `enlace` (
  `id_enlace` int(11) NOT NULL,
  `enlace` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `abrev` varchar(20) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_pais`, `pais`, `abrev`, `id_usuario`) VALUES
(1, 'Bolivia', 'BO', 1),
(2, 'Chile', 'CHI', 1),
(3, 'Colombia', 'CO', 1),
(4, 'Rusia', 'RU', 1),
(5, 'Argentina', 'ARG', 3),
(6, 'Peru', 'PE', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre`) VALUES
(1, 'Categoria'),
(2, 'Productos'),
(3, 'Proveedores'),
(4, 'Compras'),
(5, 'Clientes'),
(6, 'Ventas'),
(7, 'Reporte de Compras'),
(8, 'Reporte de Ventas'),
(9, 'Usuarios'),
(10, 'Empresa'),
(11, 'Salidas'),
(12, 'Matriz'),
(13, 'pais'),
(14, 'matrizpais');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `presentacion` varchar(100) NOT NULL,
  `unidad` varchar(45) NOT NULL,
  `moneda` varchar(45) NOT NULL,
  `precio_compra` varchar(45) NOT NULL,
  `precio_venta` varchar(45) NOT NULL,
  `stock` varchar(45) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `id_categoria`, `producto`, `presentacion`, `unidad`, `moneda`, `precio_compra`, `precio_venta`, `stock`, `estado`, `imagen`, `fecha_vencimiento`, `id_usuario`) VALUES
(4, 6, 'jabon ACE', 'Caja', 'kilo', 'USD$', '100', '200', '19', '1', '1982969361.jpg', '2018-01-31', 1),
(6, 2, 'aceite carro', 'Caja', 'kilo', 'USD$', '100', '300', '20', '0', '216717336.jpg', '2018-01-25', 1),
(7, 7, 'harina pan', 'Saco', 'kilo', 'USD$', '60', '90', '20', '1', '234611002.jpg', '2018-01-30', 1),
(8, 7, 'pan ', 'Saco', 'kilo', 'USD$', '60', '81', '20', '1', '1407078505.jpg', '2018-01-24', 1),
(9, 6, 'jabon casa', 'Saco', 'kilo', 'USD$', '80', '200', '20', '1', '1121250455.jpg', '2018-01-29', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `fecha` date NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `cedula`, `razon_social`, `telefono`, `correo`, `direccion`, `fecha`, `estado`, `id_usuario`) VALUES
(3, '14789', 'luis lopez', '12399888', 'luis@gmail.com', 'california', '2018-01-29', '1', 1),
(4, '45965', 'roberto perez', '48859', 'roberto@gmail.com', 'texas', '2018-02-13', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

CREATE TABLE `salida` (
  `id_salida` int(11) NOT NULL,
  `id_bus` int(11) NOT NULL,
  `id_conductor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `horario` datetime NOT NULL,
  `total_asientos` int(11) NOT NULL,
  `libres` int(11) NOT NULL,
  `vendido` int(11) NOT NULL,
  `reservado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salida`
--

INSERT INTO `salida` (`id_salida`, `id_bus`, `id_conductor`, `fecha`, `horario`, `total_asientos`, `libres`, `vendido`, `reservado`) VALUES
(1, 1, 1, '2021-07-15', '2021-07-15 04:00:00', 14, 10, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cargo` enum('0','1') NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password2` varchar(100) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `cedula`, `telefono`, `correo`, `direccion`, `cargo`, `usuario`, `password`, `password2`, `fecha_ingreso`, `estado`) VALUES
(1, 'eyter', 'higuera', '1', '123456', 'eyter@gmail.com', 'san jose', '1', 'daniel', 'Qw/*12345678', 'Qw/*12345678', '2017-12-26', '1'),
(2, 'alejandro', 'perez', '12', '12968566', 'alejandro@gmail.com', 'california', '0', 'alejandro', 'Qw/*12345678', 'Qw/*12345678', '2018-02-13', '1'),
(3, 'admin', 'admin', '1', '1', 'admin@gmail.com', 'admin', '1', 'admin', 'admin', 'admin', '2021-07-18', '1'),
(4, 'Usuario', 'Usuario', '123', '123', 'User1@gmail.com', 'dir user', '1', 'Usuario', '1', '1', '2021-07-20', '1'),
(5, 'FELCN', 'FELCN', '123456', '1234564', 'FELCN@gmail.com', 'FELCN', '1', 'FELCN', 'FELCN123', 'FELCN123', '2021-07-22', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `id_usuario_permiso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`id_usuario_permiso`, `id_usuario`, `id_permiso`) VALUES
(32, 2, 1),
(33, 2, 2),
(110, 1, 1),
(111, 1, 2),
(112, 1, 3),
(113, 1, 4),
(114, 1, 5),
(115, 1, 6),
(116, 1, 7),
(117, 1, 8),
(118, 1, 9),
(119, 1, 10),
(120, 1, 11),
(131, 4, 5),
(132, 4, 9),
(133, 4, 12),
(134, 3, 1),
(135, 3, 2),
(136, 3, 3),
(137, 3, 4),
(138, 3, 5),
(139, 3, 6),
(140, 3, 7),
(141, 3, 8),
(142, 3, 9),
(143, 3, 10),
(144, 3, 11),
(145, 3, 12),
(146, 3, 13),
(147, 3, 14),
(153, 5, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `numero_venta` varchar(100) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `cedula_cliente` varchar(100) NOT NULL,
  `vendedor` varchar(100) NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `subtotal` varchar(100) NOT NULL,
  `total_iva` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tipo_pago` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `fecha_venta`, `numero_venta`, `cliente`, `cedula_cliente`, `vendedor`, `moneda`, `subtotal`, `total_iva`, `total`, `tipo_pago`, `estado`, `id_usuario`, `id_cliente`) VALUES
(2, '2018-02-07', 'F000001', 'Jorge', '159966666', 'eyter', 'USD$', '200', '40', '240', 'EFECTIVO', '1', 1, 5),
(3, '2018-02-07', 'F000002', 'Jorge', '159966666', 'eyter', 'USD$', '490', '98', '588', 'EFECTIVO', '1', 1, 5),
(7, '2018-10-26', 'F000003', 'Jorge', '159966666', 'eyter', 'USD$', '481', '96', '577', 'CHEQUE', '1', 1, 5),
(8, '2021-07-14', 'F000004', 'Jorge', '159966666', 'eyter', 'USD$', '400', '80', '480', 'EFECTIVO', '1', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_salida`
--

CREATE TABLE `venta_salida` (
  `id_pasajero` int(11) NOT NULL,
  `id_salida` int(11) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Efectivo` int(11) NOT NULL,
  `cambio` int(11) NOT NULL,
  `nro_asiento` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id_bus`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_categoria_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_clientes_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `cmx_estado`
--
ALTER TABLE `cmx_estado`
  ADD PRIMARY KEY (`id_estado_cumplimiento`);

--
-- Indices de la tabla `cmx_matriz`
--
ALTER TABLE `cmx_matriz`
  ADD PRIMARY KEY (`id_matriz`);

--
-- Indices de la tabla `cmx_tema`
--
ALTER TABLE `cmx_tema`
  ADD PRIMARY KEY (`id_tema`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compras`),
  ADD KEY `fk_compras_usuario_idx` (`id_usuario`),
  ADD KEY `fk_compras_proveedor_idx` (`id_proveedor`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id_detalle_compras`),
  ADD KEY `fk_detalle_compras_producto_idx` (`id_producto`),
  ADD KEY `fk_detalle_compras_usuario_idx` (`id_usuario`),
  ADD KEY `fk_detalle_compras_proveedor_idx` (`id_proveedor`),
  ADD KEY `fk_detalle_compras_categoria_idx` (`id_categoria`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id_detalle_ventas`),
  ADD KEY `fk_detalle_ventas_producto_idx` (`id_producto`),
  ADD KEY `fk_detalle_ventas_usuario_idx` (`id_usuario`),
  ADD KEY `fk_detalle_ventas_clientes_idx` (`id_cliente`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `fk_empresa_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `enlace`
--
ALTER TABLE `enlace`
  ADD PRIMARY KEY (`id_enlace`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_producto_categoria_idx` (`id_categoria`),
  ADD KEY `fk_producto_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `fk_proveedor_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `salida`
--
ALTER TABLE `salida`
  ADD PRIMARY KEY (`id_salida`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`id_usuario_permiso`),
  ADD KEY `fk_usuario_permiso_usuario_idx` (`id_usuario`),
  ADD KEY `fk_usuario_permiso_permiso_idx` (`id_permiso`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `fk_ventas_usuario_idx` (`id_usuario`),
  ADD KEY `fk_ventas_cliente_idx` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bus`
--
ALTER TABLE `bus`
  MODIFY `id_bus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cmx_estado`
--
ALTER TABLE `cmx_estado`
  MODIFY `id_estado_cumplimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cmx_matriz`
--
ALTER TABLE `cmx_matriz`
  MODIFY `id_matriz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cmx_tema`
--
ALTER TABLE `cmx_tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id_detalle_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id_detalle_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `enlace`
--
ALTER TABLE `enlace`
  MODIFY `id_enlace` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `salida`
--
ALTER TABLE `salida`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `id_usuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compras_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD CONSTRAINT `fk_detalle_compras_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_compras_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_compras_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_compras_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `fk_detalle_ventas_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ventas_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ventas_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_empresa_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `fk_proveedor_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_permiso_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
cmx_matrizcmx_matrizcmx_matrizcmx_matriz