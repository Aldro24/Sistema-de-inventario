-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2021 a las 16:45:00
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_tesis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `idarticulo` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `descripción` varchar(256) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `condicion` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`idarticulo`, `idcategoria`, `codigo`, `nombre`, `stock`, `descripción`, `imagen`, `condicion`) VALUES
(59, 4, '47896523', 'cama', 500, 'Camas para dormir', '1638232309.jpg', 1),
(60, 4, '5645478', 'Pijama', -1, 'aaasa', '1639888034.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripción` varchar(256) DEFAULT NULL,
  `condición` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripción`, `condición`) VALUES
(3, 'Ropa interior nueva 2', 'Ropa interior de Sports', 1),
(4, 'Ropa de cama', 'Accesorios para cama', 1),
(5, 'klkllk', 'llkkl', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_articulo`
--

CREATE TABLE `detalle_articulo` (
  `id_detalle_articulo` int(11) NOT NULL,
  `talla` varchar(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `fk_idarticulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `iddetalle_ingreso` int(11) NOT NULL,
  `idingreso` int(11) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `cantidad_articulos` int(11) NOT NULL,
  `precio_compra` decimal(11,2) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_ingreso`
--

INSERT INTO `detalle_ingreso` (`iddetalle_ingreso`, `idingreso`, `idarticulo`, `cantidad_articulos`, `precio_compra`, `precio_venta`) VALUES
(22, 33, 59, 1000, '10.00', '1.00'),
(23, 34, 60, 100, '10.50', '11.25');

--
-- Disparadores `detalle_ingreso`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockIngreso` AFTER INSERT ON `detalle_ingreso` FOR EACH ROW BEGIN
 UPDATE articulo SET stock = stock + NEW.cantidad_articulos 
 WHERE articulo.idarticulo = NEW.idarticulo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `iddetalle_venta` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `descuento` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`iddetalle_venta`, `idventa`, `idarticulo`, `cantidad`, `precio_venta`, `descuento`) VALUES
(30, 33, 59, 500, '1.00', '0.00'),
(31, 34, 60, 1, '11.25', '0.00'),
(32, 35, 60, 100, '11.25', '3.00');

--
-- Disparadores `detalle_venta`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockVenta` AFTER INSERT ON `detalle_venta` FOR EACH ROW BEGIN
 UPDATE articulo SET stock = stock - NEW.cantidad 
 WHERE articulo.idarticulo = NEW.idarticulo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `idingreso` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `serie_comprobante` varchar(7) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total_compra` decimal(11,2) NOT NULL,
  `tipo_comprobante` varchar(20) NOT NULL,
  `num_comprobante` varchar(10) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`idingreso`, `idproveedor`, `idusuario`, `serie_comprobante`, `fecha_hora`, `impuesto`, `total_compra`, `tipo_comprobante`, `num_comprobante`, `estado`) VALUES
(15, 2, 8, 'lll', '2021-11-28 00:00:00', '18.00', '20.00', 'Factura', 'lmomo', 'Anulado'),
(16, 1, 8, 'm,m,', '2021-11-28 00:00:00', '18.00', '8000.00', 'Factura', 'kkkm', 'Anulado'),
(18, 2, 8, 'lklk', '2021-11-28 00:00:00', '18.00', '60.00', 'Factura', 'poo', 'Anulado'),
(22, 2, 8, 'hhh', '2021-11-28 00:00:00', '0.12', '34.00', 'Factura', 'hkh', 'Anulado'),
(24, 2, 8, '001', '2021-11-29 00:00:00', '0.12', '200.00', 'Factura', '0001', 'Anulado'),
(25, 2, 8, '001', '2021-11-29 00:00:00', '0.12', '100.00', 'Factura', '0002', 'Anulado'),
(26, 2, 8, 'prueba', '2021-11-29 00:00:00', '0.12', '20.00', 'Factura', '1', 'Anulado'),
(27, 2, 8, 'mmm', '2021-11-29 00:00:00', '0.12', '100.00', 'Factura', 'jjj', 'Anulado'),
(28, 2, 8, '0101', '2021-11-29 00:00:00', '0.12', '7.00', 'Factura', '0202', 'Anulado'),
(29, 1, 8, '111', '2021-11-29 00:00:00', '0.12', '2.00', 'Factura', '222', 'Anulado'),
(30, 2, 8, 'bbbb', '2021-11-29 00:00:00', '0.00', '200.00', 'Boleta', 'bbb', 'Anulado'),
(31, 2, 8, '44444', '2021-11-29 00:00:00', '0.12', '91.00', 'Factura', '55555', 'Anulado'),
(32, 2, 8, 'nnn', '2021-11-29 00:00:00', '0.12', '80000.00', 'Factura', 'nnnnn', 'Anulado'),
(33, 2, 8, 'AAAA', '2021-12-18 00:00:00', '0.12', '10000.00', 'Factura', 'DDD', 'Aceptado'),
(34, 2, 8, 'aaaaaa', '2021-12-18 00:00:00', '0.12', '1050.00', 'Factura', 'q55555', 'Aceptado');

--
-- Disparadores `ingreso`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockIngresoAnular` AFTER UPDATE ON `ingreso` FOR EACH ROW BEGIN
UPDATE articulo a
JOIN detalle_ingreso di
ON di.idarticulo = a.idarticulo
AND di.idingreso = new.idingreso
set a.stock = a.stock - di.cantidad_articulos;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `fecha` date NOT NULL,
  `cantidad` decimal(11,2) NOT NULL,
  `precio` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`fecha`, `cantidad`, `precio`, `idproducto`) VALUES
('2021-12-18', '1000.00', 10, 59),
('2021-12-18', '100.00', 11, 60),
('2021-12-18', '-500.00', 1, 59),
('2021-12-18', '-1.00', 11, 60),
('2021-12-18', '-100.00', 11, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'Escritorio'),
(2, 'Almacen'),
(3, 'Compras'),
(4, 'Ventas'),
(5, 'Acceso'),
(6, 'Consulta compras'),
(7, 'Consulta Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `tipo_persona` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `tipo_persona`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`) VALUES
(1, 'Proveedor', 'Hola mundo', 'Pasaporte', '845878488555656656', 'Calle Pedro Vicente Maldonado, parque metropolitano del sur', '0987751209', 'alejoarroyo24@outlook.com'),
(2, 'Proveedor', 'Javier Mera', 'Cédula', '1305919688', 'Calle Pedro Vicente Maldonado, parque metropolitano del sur', '0987751209', 'alejoeldarkknight@hotmail.com'),
(4, 'Cliente', 'Patricio Estrella', 'Cédula', '5478932155', 'Fondo de bikini', '01010101', 'alejoarroyo24@outlook.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `condicion` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `cargo`, `login`, `clave`, `imagen`, `condicion`) VALUES
(6, 'Javier Alejandro Arroyo Mera', 'cedula', '1723794655', 'Calle Pedro Vicente Maldonado, parque metropolitano del sur', '0987751209', 'alejoarroyo24@outlook.com', 'Empleado', 'Aldro24', '5267cbfb621513a5fe3da6b8fe75c404bcee87715e2af7ac8ea232b3141fa06e', '1636592429.png', 1),
(7, 'ale', 'cedula', '1723794655', 'cacacacacaca', '525252', 'alejoarroyo24@outlook.com', 'jefe 2', 'aldro1', '010b2df0fba2d85fdbc4bd931863e5449852b9a27f6e5f17b6d7b86015beff9e', '1636512832.jpg', 1),
(8, 'admin', 'cedula', '17548', 'Calle Pedro Vicente Maldonado, parque metropolitano del sur', '00000000', 'alejo@outlook.com', '', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1636600568.jpg', 1),
(9, 'Javier Mera', 'cedula', '852585205852', 'Calle Pedro Vicente Maldonado, parque metropolitano del sur', '0987751209', 'alejoeldarkknight@hotmail.com', 'pepino', 'alejo1', '542b96a0665d8efd3cb219cc0675601b3659dd9c8ee019ff17e8054b80d38d07', '1636513028.jpg', 1),
(10, 'Victor Ocampo', 'cedula', '131884463', 'Nuevo Israel', '09851512036', 'victorocampo15@hotmail.com', 'Sub gerente', 'Victor15', '5267cbfb621513a5fe3da6b8fe75c404bcee87715e2af7ac8ea232b3141fa06e', '1636513167.jpg', 1),
(11, 'Prueba de usuario', 'cedula', '1305919688', 'Calle Pedro Vicente Maldonado, parque metropolitano del sur', '0987751209', 'aaaaa@vendedor.com', 'vendedor', 'vendedor1', 'b5c0e0582a0ea6d6be8323a6625a15ff47bf0a74fb462ae0ef8d10f5f42ad0d8', '1636513864.jpg', 1),
(12, 'Patricia Arroyo', 'cedula', '1305919688', 'Calle Pedro Vicente Maldonado, parque metropolitano del sur', '0987738642', 'nicole@hotmail.com', 'encargada de ventas', 'Nicole1', '5267cbfb621513a5fe3da6b8fe75c404bcee87715e2af7ac8ea232b3141fa06e', '1636770104.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(0, 0, 1),
(0, 0, 2),
(0, 0, 3),
(0, 0, 1),
(0, 0, 2),
(0, 0, 3),
(0, 0, 1),
(0, 0, 2),
(0, 0, 3),
(0, 0, 1),
(0, 0, 2),
(0, 0, 3),
(0, 0, 1),
(0, 0, 2),
(0, 0, 3),
(0, 2, 1),
(0, 2, 2),
(0, 1, 7),
(0, 0, 1),
(0, 0, 6),
(0, 4, 2),
(0, 5, 2),
(0, 9, 1),
(0, 9, 2),
(0, 7, 1),
(0, 7, 2),
(0, 11, 1),
(0, 11, 7),
(0, 10, 2),
(0, 10, 5),
(0, 8, 1),
(0, 8, 2),
(0, 8, 3),
(0, 8, 4),
(0, 8, 5),
(0, 8, 6),
(0, 8, 7),
(0, 12, 1),
(0, 12, 2),
(0, 12, 3),
(0, 12, 4),
(0, 6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `tipo_comprobante` varchar(20) DEFAULT NULL,
  `serie_comprobante` varchar(7) DEFAULT NULL,
  `num_comprobante` varchar(10) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `impuesto` decimal(4,2) DEFAULT NULL,
  `total_venta` decimal(11,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `idcliente`, `idusuario`, `tipo_comprobante`, `serie_comprobante`, `num_comprobante`, `fecha_hora`, `impuesto`, `total_venta`, `estado`) VALUES
(31, 4, 8, 'Factura', 'mmmmm', 'kkkk', '2021-11-29 00:00:00', '0.12', '285.00', 'Aceptado'),
(32, 4, 8, 'Factura', 'opopop', '7777', '2021-11-29 00:00:00', '0.12', '10.00', 'Aceptado'),
(33, 4, 8, 'Factura', '45', '03', '2021-12-18 00:00:00', '0.12', '500.00', 'Anulado'),
(34, 4, 8, 'Factura', 'aaaa', '0303', '2021-12-18 00:00:00', '0.12', '11.25', 'Aceptado'),
(35, 4, 8, 'Factura', 'aaaa2', '0636', '2021-12-18 00:00:00', '0.12', '1122.00', 'Aceptado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idarticulo`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  ADD KEY `fk_articulo_categoria_idx` (`idcategoria`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `detalle_articulo`
--
ALTER TABLE `detalle_articulo`
  ADD PRIMARY KEY (`id_detalle_articulo`),
  ADD KEY `articulo_detalle_articulo` (`fk_idarticulo`);

--
-- Indices de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`iddetalle_ingreso`),
  ADD KEY `fk_detalle_ingreso_ingreso_idx` (`idingreso`),
  ADD KEY `fk_detalle_ingreso_articulo_idx` (`idarticulo`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`iddetalle_venta`),
  ADD KEY `fk_detalle_venta_idx` (`idventa`),
  ADD KEY `fk_detalle_venta_articulo_idx` (`idarticulo`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idingreso`),
  ADD KEY `fk_ingreso_persona_idx` (`idproveedor`),
  ADD KEY `fk_ingreso_usuario_idx` (`idusuario`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `fk_venta_persona_idx` (`idcliente`),
  ADD KEY `fk_venta_usuario_idx` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idarticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_articulo`
--
ALTER TABLE `detalle_articulo`
  MODIFY `id_detalle_articulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  MODIFY `iddetalle_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `iddetalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `fk_articulo_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_articulo`
--
ALTER TABLE `detalle_articulo`
  ADD CONSTRAINT `articulo_detalle_articulo` FOREIGN KEY (`fk_idarticulo`) REFERENCES `articulo` (`idarticulo`);

--
-- Filtros para la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `fk_detalle_ingreso_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ingreso_ingreso` FOREIGN KEY (`idingreso`) REFERENCES `ingreso` (`idingreso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `fk_ingreso_persona` FOREIGN KEY (`idproveedor`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ingreso_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_persona` FOREIGN KEY (`idcliente`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
