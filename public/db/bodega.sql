SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `bodega`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodegas`
--

CREATE TABLE `bodegas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bodegas`
--

INSERT INTO `bodegas` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES(1, 'Centro', 'A', '2020-07-04 00:00:00', NULL);
INSERT INTO `bodegas` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES(2, 'Norte', 'A', '2020-07-04 00:00:00', NULL);
INSERT INTO `bodegas` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES(3, 'Sur', 'A', '2020-07-04 00:00:00', NULL);
INSERT INTO `bodegas` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES(4, 'Este', 'A', '2020-07-04 00:00:00', NULL);
INSERT INTO `bodegas` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES(5, 'Oeste', 'A', '2020-07-04 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bodega` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `existencia` int(5) UNSIGNED NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_bodega`, `codigo`, `nombre`, `descripcion`, `existencia`, `estado`, `created_at`, `updated_at`) VALUES(1, 1, '1000000000', 'Producto 1', 'Descripción Producto 1', 5, 'A', '2020-07-04 00:00:00', NULL);
INSERT INTO `productos` (`id`, `id_bodega`, `codigo`, `nombre`, `descripcion`, `existencia`, `estado`, `created_at`, `updated_at`) VALUES(2, 1, '2000000000', 'Producto 2', 'Descripción Producto 2', 5, 'A', '2020-07-04 00:00:00', NULL);
INSERT INTO `productos` (`id`, `id_bodega`, `codigo`, `nombre`, `descripcion`, `existencia`, `estado`, `created_at`, `updated_at`) VALUES(3, 1, '3000000000', 'Producto 3', 'Descripción Producto 3', 5, 'A', '2020-07-04 00:00:00', NULL);
INSERT INTO `productos` (`id`, `id_bodega`, `codigo`, `nombre`, `descripcion`, `existencia`, `estado`, `created_at`, `updated_at`) VALUES(4, 1, '4000000000', 'Producto 4', 'Descripción Producto 4', 5, 'A', '2020-07-04 00:00:00', NULL);
INSERT INTO `productos` (`id`, `id_bodega`, `codigo`, `nombre`, `descripcion`, `existencia`, `estado`, `created_at`, `updated_at`) VALUES(5, 1, '5000000000', 'Producto 5', 'Descripción Producto 5', 5, 'A', '2020-07-04 00:00:00', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productos_unq1` (`codigo`),
  ADD KEY `productos_FKIndex1` (`id_bodega`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `producto_bodega` FOREIGN KEY (`id_bodega`) REFERENCES `bodegas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;