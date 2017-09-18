-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2017 a las 21:39:58
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gob_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_docs`
--

CREATE TABLE `t_docs` (
  `id` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `fch_emision` datetime NOT NULL,
  `str_dependencia` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `str_remitente` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_docs`
--

INSERT INTO `t_docs` (`id`, `id_tipo`, `id_user`, `fch_emision`, `str_dependencia`, `str_remitente`) VALUES
(1, 1, 2, '2017-09-18 13:10:56', 'Dependencia', 'asdfasdfasdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_docs_tipo`
--

CREATE TABLE `t_docs_tipo` (
  `id` int(11) NOT NULL,
  `str_tipo` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_docs_tipo`
--

INSERT INTO `t_docs_tipo` (`id`, `str_tipo`) VALUES
(1, 'Prestacion Social'),
(2, 'Tramite'),
(3, 'Reclamo'),
(4, 'Expediente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_expediente`
--

CREATE TABLE `t_expediente` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `str_dependencia` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `fch_creacion` datetime NOT NULL,
  `fch_mod` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_prest_social`
--

CREATE TABLE `t_prest_social` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `str_nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fch_creacion` datetime NOT NULL,
  `fch_mod` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_prest_social`
--

INSERT INTO `t_prest_social` (`id`, `id_doc`, `str_nombre`, `fch_creacion`, `fch_mod`) VALUES
(1, 1, 'NombrePrueba', '2017-09-18 13:10:56', '2017-09-18 13:53:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_reclamo`
--

CREATE TABLE `t_reclamo` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `str_nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fch_reclamo` datetime NOT NULL,
  `fch_creacion` datetime NOT NULL,
  `fch_mod` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tramite`
--

CREATE TABLE `t_tramite` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `str_tipo` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `fch_creacion` datetime NOT NULL,
  `fch_mod` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_users`
--

CREATE TABLE `t_users` (
  `id` int(11) NOT NULL,
  `str_user` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `str_pass` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `int_lvl` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_users`
--

INSERT INTO `t_users` (`id`, `str_user`, `str_pass`, `int_lvl`) VALUES
(1, 'Jlfb1989', '1798a15d09fd38eaaa10af3e06cd39c98c484501', 1),
(2, 'ADMINuno', '35d741213654279e1e66367c98f3b7ca2709895f', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_users_dat`
--

CREATE TABLE `t_users_dat` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `str_nombre` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `str_apellido` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `str_ced` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `str_mail` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_users_dat`
--

INSERT INTO `t_users_dat` (`id`, `id_user`, `str_nombre`, `str_apellido`, `str_ced`, `str_mail`) VALUES
(1, 1, 'Jose', 'Fonseca', '19930075', '19930075'),
(2, 2, 'ADMIN', 'ADMIN', '1234560', '1234560');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_users_tipo`
--

CREATE TABLE `t_users_tipo` (
  `id` int(11) NOT NULL,
  `str_lvl` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_users_tipo`
--

INSERT INTO `t_users_tipo` (`id`, `str_lvl`) VALUES
(1, 'Comun'),
(2, 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_docs`
--
ALTER TABLE `t_docs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `t_docs_tipo`
--
ALTER TABLE `t_docs_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_expediente`
--
ALTER TABLE `t_expediente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doc` (`id_doc`);

--
-- Indices de la tabla `t_prest_social`
--
ALTER TABLE `t_prest_social`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doc` (`id_doc`);

--
-- Indices de la tabla `t_reclamo`
--
ALTER TABLE `t_reclamo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doc` (`id_doc`);

--
-- Indices de la tabla `t_tramite`
--
ALTER TABLE `t_tramite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doc` (`id_doc`);

--
-- Indices de la tabla `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `int_lvl` (`int_lvl`);

--
-- Indices de la tabla `t_users_dat`
--
ALTER TABLE `t_users_dat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `t_users_tipo`
--
ALTER TABLE `t_users_tipo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_docs`
--
ALTER TABLE `t_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `t_docs_tipo`
--
ALTER TABLE `t_docs_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `t_expediente`
--
ALTER TABLE `t_expediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_prest_social`
--
ALTER TABLE `t_prest_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `t_reclamo`
--
ALTER TABLE `t_reclamo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_tramite`
--
ALTER TABLE `t_tramite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `t_users_dat`
--
ALTER TABLE `t_users_dat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `t_users_tipo`
--
ALTER TABLE `t_users_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_docs`
--
ALTER TABLE `t_docs`
  ADD CONSTRAINT `t_docs_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `t_docs_tipo` (`id`),
  ADD CONSTRAINT `t_docs_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `t_users` (`id`);

--
-- Filtros para la tabla `t_expediente`
--
ALTER TABLE `t_expediente`
  ADD CONSTRAINT `t_expediente_ibfk_1` FOREIGN KEY (`id_doc`) REFERENCES `t_docs` (`id`);

--
-- Filtros para la tabla `t_prest_social`
--
ALTER TABLE `t_prest_social`
  ADD CONSTRAINT `t_prest_social_ibfk_1` FOREIGN KEY (`id_doc`) REFERENCES `t_docs` (`id`);

--
-- Filtros para la tabla `t_reclamo`
--
ALTER TABLE `t_reclamo`
  ADD CONSTRAINT `t_reclamo_ibfk_1` FOREIGN KEY (`id_doc`) REFERENCES `t_docs` (`id`);

--
-- Filtros para la tabla `t_tramite`
--
ALTER TABLE `t_tramite`
  ADD CONSTRAINT `t_tramite_ibfk_1` FOREIGN KEY (`id_doc`) REFERENCES `t_docs` (`id`);

--
-- Filtros para la tabla `t_users`
--
ALTER TABLE `t_users`
  ADD CONSTRAINT `t_users_ibfk_1` FOREIGN KEY (`int_lvl`) REFERENCES `t_users_tipo` (`id`);

--
-- Filtros para la tabla `t_users_dat`
--
ALTER TABLE `t_users_dat`
  ADD CONSTRAINT `t_users_dat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
