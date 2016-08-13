-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2016 a las 17:06:42
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `yii2advanced`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE `comisiones` (
  `id_comision` int(11) NOT NULL,
  `id_transaccion` varchar(50) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `id_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `estado` bigint(20) DEFAULT '0' COMMENT '0:pendiente 1: confirmada 2: finalizada',
  `empresa_id` int(11) DEFAULT NULL,
  `fecha_vencimiento` timestamp NULL DEFAULT NULL COMMENT 'MM/AA que esta activo para comisiones',
  `Id_confirmacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `fecha_registro`, `id_usuario`, `id_paquete`, `estado`, `empresa_id`, `fecha_vencimiento`, `Id_confirmacion`) VALUES
(28, '2016-08-10 09:08:01', 1, 1, 0, 1, NULL, NULL),
(29, '2016-08-12 14:08:43', 20, 1, 0, 1, NULL, NULL),
(30, '2016-08-12 14:08:02', 20, 3, 0, 1, NULL, NULL),
(31, '2016-08-12 14:08:44', 20, 2, 0, 1, NULL, NULL),
(32, '2016-08-12 14:08:01', 20, 2, 0, 1, NULL, NULL),
(33, '2016-08-12 15:08:57', 20, 3, 0, 1, '2016-08-12 15:08:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `confirmacion_compra`
--

CREATE TABLE `confirmacion_compra` (
  `Id_confirmacion` int(11) NOT NULL,
  `observacion` varchar(50) NOT NULL,
  `fecha_confirmacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla que almacena los datos de confirmacion de un pago realizado';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `Id` int(11) NOT NULL,
  `cardId` varchar(38) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`Id`, `cardId`, `nombre`) VALUES
(1, 'direccion bit weif', 'weifastpay');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1469399882),
('m130524_201442_init', 1469399888);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `id_upline` int(11) NOT NULL COMMENT 'id_usuario del upline',
  `nivel` int(11) NOT NULL COMMENT 'nivel del upline',
  `usuarios_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `descripcion`) VALUES
(1, 'Colombia'),
(2, 'USA'),
(3, 'España');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `id_paquete` int(11) NOT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id_paquete`, `costo`, `nombre`) VALUES
(1, '7.00', 'Paquete 1 - $7 USD'),
(2, '14.00', 'Paquete 2 - $14 USD'),
(3, '21.00', 'Paquete 3 - $21 USD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patrocinador` int(11) NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pais` int(11) NOT NULL,
  `direccion_billetera` varchar(38) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre_completo`, `username`, `patrocinador`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `pais`, `direccion_billetera`, `status`, `created_at`, `updated_at`) VALUES
(1, '', 'mauroshek', 1, '', '$2y$13$UZC1WzBY/THRTu2bDp.vaO8DH0h1U7HhHj2Y/DGjDQhJM1BKad1.O', NULL, 'mauroshek@gmail.com', 1, '', 10, 0, 0),
(2, 'ANDRES MAURICIO', 'maoshek', 1, 'DyEW3YBo1nHzOtQYsr-CKL02iid_yNQ-', '$2y$13$4sHrgVHt8jK5UPNy4ge0vOXAu9WQQNvgt5RQKLQL.jHapXelXzS/G', NULL, 'mauroshek@icloud.com', 1, '', 10, 1469589375, 1469589375),
(3, 'ANDRES MAURICIO SHEK', 'asdasd', 1, 'EF5duk5nDh1-rETMcqKzF8Z0msukv3Ha', '$2y$13$ZUoJ2LatFNOJ0NMA8INnxuv9TbWN/WWbm.kWHJnkinCm99E4D1tva', NULL, 'a@gmsdail.com', 3, 'CRA 27 BIS # 40 -08', 10, 1469711176, 1469711176);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `pais` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(250) NOT NULL,
  `authKey` varchar(250) NOT NULL,
  `patrocinador` int(11) NOT NULL,
  `direccion_billetera` varchar(100) NOT NULL,
  `accessToken` varchar(250) NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT '0',
  `estado` int(11) NOT NULL DEFAULT '0' COMMENT '0: inactivo, 1: activo, 2: activado, 3: desactivado',
  `verification_code` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `nombre_completo`, `pais`, `email`, `password`, `authKey`, `patrocinador`, `direccion_billetera`, `accessToken`, `activate`, `estado`, `verification_code`) VALUES
(1, 'mauroshek', 'Andres Mauricio Shek', 1, 'asdasd@asdadsds.coms', '', '', 1, '', '', 1, 0, ''),
(20, 'ivansalazar', 'ivan salazar', 1, 'ivan-salazar@hotmail.com', 'fsPIowGcf4hx2', '4bc63811f3eb5de0db222f3faf493cdb3b0a6e703b3272ea7a9d04d5a6c7000d89ab024ee0f7e543785557d9fbb3229d35ab0479e40ab70ad38c082cbdfda39a4f0863f2568bf62f9c1017ecce9591e6b8c421e9155a83b1b303830a4cabdd908eed3d3f', 1, '33323332', '43877f9238534e76190f78a8b265b7d2cf22c8d11b02775154d1701d444a9fe3b81b8f7e5c1e0e99ecf1e6e1348ed552f0729578fb89f32fe38fab23822f791fa52708d1f8514623476bcdb33e2f6a4bb93aeaa85488e786faa55da0487ccad41bbb19cc', 1, 0, '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD PRIMARY KEY (`id_comision`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `fk_compra_paquetes` (`id_paquete`),
  ADD KEY `fk_compra_Empresa` (`empresa_id`),
  ADD KEY `fk_compra_users` (`id_usuario`),
  ADD KEY `fk_compra_confirmacion_compra` (`Id_confirmacion`);

--
-- Indices de la tabla `confirmacion_compra`
--
ALTER TABLE `confirmacion_compra`
  ADD PRIMARY KEY (`Id_confirmacion`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id_upline`,`nivel`,`usuarios_id_usuario`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id_paquete`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `id` (`id`),
  ADD KEY `patrocinador` (`patrocinador`),
  ADD KEY `id_2` (`id`),
  ADD KEY `pais` (`pais`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patrocinador` (`patrocinador`),
  ADD KEY `pais` (`pais`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  MODIFY `id_comision` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_Empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_confirmacion_compra` FOREIGN KEY (`Id_confirmacion`) REFERENCES `confirmacion_compra` (`Id_confirmacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_paquetes` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`patrocinador`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`pais`) REFERENCES `paises` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`patrocinador`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`pais`) REFERENCES `paises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
