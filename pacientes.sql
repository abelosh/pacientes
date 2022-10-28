-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2022 a las 15:21:37
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pacientes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` bigint(20) NOT NULL,
  `nombrecat` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `portada` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `ruta` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombrecat`, `descripcion`, `portada`, `datecreated`, `ruta`, `status`) VALUES
(1, 'Aseo Personal', 'Cepillo de dientes, pasta dental, papel higienico etc', 'img_a57b29ee186d83a22c346a1c74fbf676.jpg', '2022-09-13 20:16:17', 'aseo-personal', 1),
(2, 'Bebidas', 'Agua pura, Sueros, Sales Reidratantes', 'img_113c1fb2524e51c9dcf50ba8347a3f28.jpg', '2022-09-14 07:16:57', 'bebidas', 1),
(3, 'categoria 3', 'categoría tres', 'portada_categoria.png', '2022-09-14 16:46:23', 'categoria-3', 1),
(4, 'Medicamentos', 'Medicamentos presentacion de comprimidos, inyectables', 'img_b92d17e3c824c94c25c7d50d71da5085.jpg', '2022-09-17 13:06:55', 'medicamentos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` bigint(20) NOT NULL,
  `pedidoid` bigint(20) NOT NULL,
  `insumoid` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id`, `pedidoid`, `insumoid`, `cantidad`, `status`) VALUES
(1, 1, 14, 3, 1),
(2, 1, 13, 50, 1),
(3, 2, 14, 3, 0),
(4, 2, 13, 3, 1),
(5, 1, 10, 15, 0),
(6, 1, 11, 10, 1),
(7, 2, 2, 50, 1),
(8, 2, 3, 3, 1),
(9, 2, 4, 10, 1),
(10, 3, 13, 10, 0),
(11, 3, 12, 3, 0),
(12, 3, 10, 7, 0),
(13, 3, 8, 9, 0),
(14, 4, 11, 3, 1),
(15, 4, 10, 20, 0),
(16, 4, 13, 2, 1),
(17, 4, 14, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `id` bigint(20) NOT NULL,
  `insumoid` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` bigint(20) NOT NULL,
  `insumoid` bigint(20) NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `insumoid`, `img`) VALUES
(14, 4, 'pro_fbc109e43531c0d27bffbb239152ed06.jpg'),
(24, 14, 'pro_cc22f1778dd5d7a3038496b52cd39902.jpg'),
(25, 8, 'pro_20f54df8f395c19b3fc86a98fb10dd27.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `idinsumos` bigint(20) NOT NULL,
  `categoriaid` bigint(20) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `ruta` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`idinsumos`, `categoriaid`, `nombre`, `descripcion`, `datecreated`, `ruta`, `status`) VALUES
(2, 1, 'Limpieza', '<p>Articulos De Limpieza Personal</p>', '2022-09-16 20:38:55', 'limpieza', 1),
(3, 2, 'Medicamentos', '<p>Medicamentos Solicitados Por El Personal De Salud</p>', '2022-09-16 20:59:24', 'medicamentos', 1),
(4, 2, 'Suero Oral', '<p>Sobre De 500ml</p>', '2022-09-17 12:08:43', 'suero-oral', 1),
(5, 1, 'Cubiertos', '<p>Articulos Desechables Para Comida</p>', '2022-09-17 12:13:38', 'cubiertos', 1),
(6, 4, 'Ceftriaxona 1g Vial', '<p>Antibiotico De Amplio Espectro</p>', '2022-09-17 13:10:05', 'ceftriaxona-1g-vial', 1),
(7, 4, 'Ampicilina + Sulbactam', '<p>anti</p>', '2022-10-04 21:17:38', 'ampicilina-+-sulbactam', 1),
(8, 1, 'Papel Higienico', '<p>Rollo</p>', '2022-10-04 21:20:16', 'papel-higienico', 1),
(9, 1, 'Tuallas Sanitarias', '<p>diferentes Tallas</p>', '2022-10-04 21:21:50', 'tuallas-sanitarias', 1),
(10, 2, 'Menaje', '<p>Vaso, Cuchara</p>', '2022-10-04 22:10:54', 'menaje', 1),
(11, 1, 'Ropa De Bebe', '<p>Primera Mudada Para Recien Nacidos</p>', '2022-10-08 14:11:08', 'ropa-de-bebe', 1),
(12, 1, 'Nuevo Producto', '<p>producto Nuevo</p>', '2022-10-10 11:18:47', 'nuevo-producto', 1),
(13, 1, 'Producto De Prueba', '<p>descripcion Del Producto Prueba</p>', '2022-10-10 15:32:45', 'producto-de-prueba', 1),
(14, 4, 'Prueba Tres Cuatro Cinco', '<p>prueba Tres MAS CUATRO</p>', '2022-10-10 21:08:21', 'prueba-tres-cuatro-cinco', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` bigint(20) NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del sistema', 1),
(3, 'Pacientes', 'Pacientes ingresados', 1),
(4, 'Insumos', 'Insumos que requieren los pacientes ingresados', 1),
(5, 'Categorias', 'Categorias', 1),
(6, 'Pedidos', 'Pedidos', 1),
(7, 'Servicios', 'Servicios', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` bigint(20) NOT NULL,
  `personaid` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `servicioid` bigint(20) NOT NULL,
  `notas` text COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `personaid`, `fecha`, `servicioid`, `notas`, `status`) VALUES
(1, 7, '2022-10-24 22:58:12', 19, 'Ejemplo notas', 1),
(2, 5, '2022-10-24 23:05:32', 14, 'Otro ejemplo', 1),
(3, 11, '2022-10-28 06:35:12', 10, 'Actualización notas', 0),
(4, 7, '2022-10-28 07:08:54', 17, 'Actualizar nota', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` bigint(20) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(10, 4, 1, 1, 0, 0, 0),
(11, 4, 2, 1, 0, 0, 0),
(12, 4, 3, 1, 0, 0, 0),
(73, 3, 1, 1, 0, 1, 0),
(74, 3, 2, 1, 1, 1, 1),
(75, 3, 3, 1, 0, 0, 0),
(93, 1, 1, 1, 1, 1, 1),
(94, 1, 2, 1, 1, 1, 1),
(95, 1, 3, 1, 1, 1, 1),
(96, 1, 4, 1, 1, 1, 1),
(97, 1, 5, 1, 1, 1, 1),
(98, 1, 6, 1, 1, 1, 1),
(99, 1, 7, 1, 1, 1, 1),
(100, 2, 1, 1, 1, 1, 1),
(101, 2, 2, 1, 1, 1, 1),
(102, 2, 3, 1, 1, 1, 1),
(103, 2, 4, 1, 1, 1, 1),
(104, 2, 5, 1, 1, 1, 1),
(105, 2, 6, 1, 1, 1, 1),
(106, 2, 7, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` bigint(20) NOT NULL,
  `identificacion` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombres` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `edad` bigint(20) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email_user` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `responsable` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `telefonoResp` bigint(20) NOT NULL,
  `password` varchar(75) COLLATE utf8mb4_swedish_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `identificacion`, `nombres`, `apellidos`, `edad`, `telefono`, `email_user`, `direccion`, `responsable`, `telefonoResp`, `password`, `token`, `rolid`, `datecreated`, `status`) VALUES
(1, '1715285570901', 'Edvin Alberto', 'Letona', 0, 42016030, 'info@abelosh.com', '', '', 0, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '24077d459b2940a52c5a-60922b94e6339a34e23d-c56d06e9848db42840ac-744b285bc6c81b5b1a2a', 1, '2022-08-30 19:50:09', 1),
(2, '007', 'Usuario', 'Prueba', 0, 77632280, '007@gmail.com', '', '', 0, '5dd7f6ca0f438fa96ef8af41be180a9a876edb0ae80da34bdbb28a839ff03b86', '', 2, '2022-08-30 20:44:02', 1),
(3, '008', 'Prueba Dos', 'DOS', 0, 7894564, 'prueba@gmail.com', '', '', 0, '5dd7f6ca0f438fa96ef8af41be180a9a876edb0ae80da34bdbb28a839ff03b86', '937561344a64e4759a17-1d58d027250bd4ba307e-1376dfe39ca10f0754aa-0f1dfe0c7ed9a74b4dcc', 3, '2022-08-30 20:46:04', 1),
(4, '147258', 'Prueba', 'Pruebas', 0, 5555555, 'prueba11@gmail.com', '', '', 0, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '', 4, '2022-09-06 18:19:32', 1),
(5, '00001', 'Juan Jose', 'Perez Lopez', 30, 77632280, 'juan@gmail.com', 'Quetzaltenango', 'Juana De Arco', 78542162, '83c8e1b7320960e6153b116d92c2cf0a466d56790af7fbb1c61e1e51a4a7a022', '', 5, '2022-09-10 13:31:44', 1),
(6, '0000000000901', 'Luis Armando', 'Tezó Cayax', 0, 78945684, 'ltezoc@miumg.edu.gt', '', '', 0, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 2, '2022-09-10 20:29:35', 1),
(7, '00002', 'Jorge', 'Arias', 70, 22558877, '', 'Guatemala', 'Benildo Molina', 77885544, '', '', 5, '2022-09-11 20:41:53', 1),
(8, '1717255550907', 'Maria', 'Lopez', 50, 78966666, '', 'dfadfadfasdfsadf', 'Maria Delgado', 78541232, '', '', 5, '2022-09-13 17:16:06', 0),
(9, '0003', 'Usuario', 'Usuario', 0, 78541223, 'usuario3@gmail.com', '', '', 0, '5dd7f6ca0f438fa96ef8af41be180a9a876edb0ae80da34bdbb28a839ff03b86', '', 4, '2022-10-15 18:08:53', 1),
(10, '786432', 'Juan', 'Peres', 87, 78542163, '', 'coatepeque, Quetzaltenango', 'Juan Perez Hijo', 7854445, '', '', 5, '2022-10-15 18:15:01', 0),
(11, '2409', 'Jorge', 'Maldonado', 20, 4567898, '', 'Ciudad', 'Fernando Mora', 55468796, '', '', 5, '2022-10-28 06:32:22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `nombrerol` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'SuperUsuario', 'administrador del sistema Backend y Frondend', 1),
(2, 'Administrador', 'Encargado de administrar el sistema', 1),
(3, 'Digitador', 'Ingresar datos obtenidos', 1),
(4, 'prueba', 'prueba', 1),
(5, 'Paciente', 'Paciente ingresado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idservicio` bigint(20) NOT NULL,
  `nombreservicio` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idservicio`, `nombreservicio`, `datecreated`, `status`) VALUES
(1, 'AREA POST PARTO', '2022-09-24 15:53:26', 1),
(2, 'GINECOLOGÍA', '2022-09-24 15:53:48', 1),
(3, 'ALTO RIESGO', '2022-09-24 15:54:08', 1),
(4, 'CIRUGÍA DE HOMBRES', '2022-09-24 15:54:17', 1),
(5, 'CIRUGÍA DE MUJERES', '2022-09-24 15:54:25', 1),
(6, 'ESPECIALIDAD DE HOMBRES', '2022-09-24 15:54:33', 1),
(7, 'ESPECIALIDAD DE MUJERES', '2022-09-24 15:54:41', 1),
(8, 'INTENSIVO A', '2022-09-24 15:54:49', 1),
(9, 'INTENSIVO B', '2022-09-24 15:54:56', 1),
(10, 'MEDICINA DE HOMBRES', '2022-09-24 15:55:03', 1),
(11, 'MEDICINA DE MUJERES', '2022-09-24 15:55:11', 1),
(12, 'MINIMO RIESGO', '2022-09-24 15:55:25', 1),
(13, 'PRE ESCOLARES', '2022-09-24 15:55:33', 1),
(14, 'SALA CUNA', '2022-09-24 15:55:41', 1),
(15, 'TRAUMATOLOGÍA', '2022-09-24 15:55:51', 1),
(16, 'TRAUMATOLOGÍA DE HOMBRES', '2022-09-24 15:55:58', 1),
(17, 'TRAUMATOLOGÍA DE MUJERES', '2022-09-24 15:56:06', 1),
(18, 'prueba', '2022-09-24 16:40:02', 0),
(19, 'EMERGENCIA', '2022-10-15 18:20:33', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidoid` (`pedidoid`),
  ADD KEY `productoid` (`insumoid`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productoid` (`insumoid`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insumoid` (`insumoid`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`idinsumos`),
  ADD KEY `categoriaid` (`categoriaid`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `personaid` (`personaid`),
  ADD KEY `servicioid` (`servicioid`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `moduloid` (`moduloid`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `rolid` (`rolid`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idservicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `idinsumos` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idservicio` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedidoid`) REFERENCES `pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`insumoid`) REFERENCES `insumos` (`idinsumos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`insumoid`) REFERENCES `insumos` (`idinsumos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`insumoid`) REFERENCES `insumos` (`idinsumos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD CONSTRAINT `insumos_ibfk_1` FOREIGN KEY (`categoriaid`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`personaid`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`servicioid`) REFERENCES `servicio` (`idservicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
