-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2024 a las 01:26:37
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `be_contable`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `carpeta` int(11) NOT NULL,
  `f_cliente` date NOT NULL,
  `ruc` int(11) NOT NULL,
  `dv` int(11) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `fantasia` text COLLATE utf8_unicode_ci NOT NULL,
  `telefono` text COLLATE utf8_unicode_ci NOT NULL,
  `direccion` text COLLATE utf8_unicode_ci NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `id_oblig` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `ruc` int(11) NOT NULL,
  `dv` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `telefono` text NOT NULL,
  `email` text NOT NULL,
  `direccion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `ruc`, `dv`, `nombre`, `razon_social`, `telefono`, `email`, `direccion`) VALUES
(1, 4702274, 4, 'BE Contable', 'Barreto Escobar', '0973585477', 'oficinabe@gmail.com', 'Luz de Luna esq. Avda. Dorado - Ayolas - Misiones - Py');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obligacion`
--

CREATE TABLE `obligacion` (
  `id` int(11) NOT NULL,
  `obligacion` int(11) NOT NULL,
  `monto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `obligacion`
--

INSERT INTO `obligacion` (`id`, `obligacion`, `monto`, `vencimiento`) VALUES
(3, 1, '150000', '2024-06-30'),
(4, 1, '15000', '2024-07-03'),
(5, 2, '150000', '2024-07-17'),
(6, 2, '150000', '2024-07-17'),
(7, 2, '15048516', '2024-07-02'),
(8, 1, '0', '0000-00-00'),
(9, 1, '0', '0000-00-00'),
(10, 1, '0', '0000-00-00'),
(11, 1, '0', '0000-00-00'),
(12, 1, '0', '0000-00-00'),
(13, 2, '0', '2024-07-09'),
(14, 2, '0', '2024-07-09'),
(15, 2, '', '2024-07-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recep_visita`
--

CREATE TABLE `recep_visita` (
  `id` int(11) NOT NULL,
  `cliente` text COLLATE utf8_unicode_ci NOT NULL,
  `atendido` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `comentario` text COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `recep_visita`
--

INSERT INTO `recep_visita` (`id`, `cliente`, `atendido`, `fecha`, `comentario`, `id_user`, `estatus`) VALUES
(1, 'Susana Camacho', '8', '2024-07-03 01:31:55', 'dgfdwsfdf', 3, 1),
(2, 'Susana Camacho', '4', '2024-07-03 01:38:42', 'eqw ewqeqw', 3, 1),
(3, 'Susana Camacho', '8', '2024-07-10 03:12:28', 'dfdfdsf', 1, 1),
(4, 'gsdfgf', '4', '2024-07-13 02:30:15', 'dfgsdgfdsg', 1, 1),
(5, 'gsdfgf', '4', '2024-07-13 02:31:03', 'dfgsdgfdsg', 1, 1),
(6, 'gsdfgf', '4', '2024-07-13 02:31:47', 'dfgsdgfdsg', 1, 1),
(7, 'fawefew', '8', '2024-07-13 02:31:55', 'fewfeF', 1, 1),
(8, 'fawefew', '1', '2024-07-13 02:37:47', 'fewfeF', 1, 1),
(9, 'fawefew', '1', '2024-07-13 02:38:44', 'ddwdq', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Gerente'),
(3, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_obligacion`
--

CREATE TABLE `tipo_obligacion` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_obligacion`
--

INSERT INTO `tipo_obligacion` (`id`, `nombre`) VALUES
(1, 'IVA'),
(2, 'IRP-RSP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `username` text NOT NULL,
  `correo` text NOT NULL,
  `clave` text NOT NULL,
  `rol` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre`, `username`, `correo`, `clave`, `rol`, `state`) VALUES
(1, 'Admin BE', 'admin', 'oficinabe@gmail.com', '$2y$10$UiYreaiSuO4zHGe55T7Js..43eG16BHmSO05QkcFqijyIkmVImrJC', 1, 1),
(3, 'Jose Villar', 'josema', 'josema95035@gmail.com', '$2y$10$AJbEww.4UXj6hhKnJT9/0e/V84GGPM0ApqFZXpeT8bKBya.QoFkke', 2, 1),
(4, 'Priscila Lugo', 'priscila', '', '414e773d5b7e5c06d564f594bf6384d0', 2, 1),
(8, 'Edgar Baez', 'edgar', 'edgarbaez@gmail.com', '333222170ab9edca4785c39f55221fe7', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_oblig` (`id_oblig`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `obligacion`
--
ALTER TABLE `obligacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre` (`obligacion`);

--
-- Indices de la tabla `recep_visita`
--
ALTER TABLE `recep_visita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_obligacion`
--
ALTER TABLE `tipo_obligacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `obligacion`
--
ALTER TABLE `obligacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `recep_visita`
--
ALTER TABLE `recep_visita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_obligacion`
--
ALTER TABLE `tipo_obligacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`id_oblig`) REFERENCES `obligacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `obligacion`
--
ALTER TABLE `obligacion`
  ADD CONSTRAINT `obligacion_ibfk_1` FOREIGN KEY (`obligacion`) REFERENCES `tipo_obligacion` (`id`);

--
-- Filtros para la tabla `recep_visita`
--
ALTER TABLE `recep_visita`
  ADD CONSTRAINT `recep_visita_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
