
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bentatecnologies_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bentatecnologies_proyectos`
--

CREATE TABLE `bentatecnologies_proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `c_nombreProyecto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_descripcionProyecto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_responsableProyecto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `f_fechaInicioProyecto` date NOT NULL,
  `f_fechaFinProyecto` date NOT NULL,
  `l_activoProyecto` tinyint(1) NOT NULL DEFAULT 1,
  `c_ruta_archivo` varchar(100) COLLATE utf8_spanish_ci NULL,
  `n_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bentatecnologies_tareas`
--

CREATE TABLE `bentatecnologies_tarea` (
  `id_tarea` int(11) NOT NULL,
  `c_nombreTarea` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_descripcionTarea` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_responsableTarea` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `f_fechaInicioTarea` date NOT NULL,
  `f_fechaFinTarea` date NOT NULL,
  `l_activoTarea` tinyint(1) NOT NULL DEFAULT 1,
  `n_idproyecto` int(11) NOT NULL,
  `n_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `bentatecnologies_reuniones`
--
CREATE TABLE `bentatecnologies_reuniones` (
  `id_convocatoria` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `c_tituloReunion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `f_fechaReunion` date NOT NULL,
  `t_horaReunion` time NOT NULL,
  `c_lugarReunion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_descripcionReunion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `n_idproyecto` int(11) NOT NULL,
  `n_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `bentatecnologies_informes`
--

CREATE TABLE `bentatecnologies_informes` (
  `id_informe` int(11) NOT NULL,
  `f_fecha` date NOT NULL,
  `c_errores` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `t_descargas` tinyint(2) NOT NULL,
  `t_exportaciones` int(100) NOT NULL,
  `n_idproyecto` int(11) NOT NULL,
  `n_idtarea` int(11) NOT NULL,
  `n_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bentatecnologies_tipo_usuarios`
--

CREATE TABLE `bentatecnologies_tipo_usuarios` (
  `id_tipo_usuario` int(11) NOT NULL,
  `c_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bentatecnologies_tipo_usuarios`
--

INSERT INTO `bentatecnologies_tipo_usuarios` (`id_tipo_usuario`, `c_descripcion`) VALUES
(1, 'Administrador'),
(2, 'Gestor'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bentatecnologies_usuarios`
--

CREATE TABLE `bentatecnologies_usuarios` (
  `id_usuario` int(10) NOT NULL,
  `c_nickname` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_apellidos` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `c_telefono` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'vacío',
  `c_direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'vacío',
  `l_activo` tinyint(1) NOT NULL DEFAULT 1,
  `t_conexiones` tinyint(2) NOT NULL DEFAULT 1,
  `n_idtipo_usuario` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bentatecnologies_usuarios`
--

INSERT INTO `bentatecnologies_usuarios` (`id_usuario`, `c_email`, `c_nombre`, `c_apellidos`, `c_password`, `c_telefono`, `c_direccion`, `l_activo`, `t_conexiones`, `n_idtipo_usuario`) VALUES
(1, 'admin@bentatecnologies.com', 'Guillermo', 'Bentabol', 'abcd1234', 'vacío', 'vacío', 1, 6, 1),
(2, 'joe@gmail.com', 'Joe', 'Candela Montez', '6262', 'vacío', 'vacío', 1, 6, 2),
(3, 'mani@gmail.com', 'Mani', 'Calavera', 'Ca6262.-.', 'vacío', 'vacío', 1, 5, 3);

-- --------------------------------------------------------
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bentatecnologies_proyectos`
--
ALTER TABLE `bentatecnologies_proyectos`
  ADD PRIMARY KEY (`id_proyecto`);
--
-- Indices de la tabla `bentatecnologies_tarea`
--
ALTER TABLE `bentatecnologies_tarea`
  ADD PRIMARY KEY (`id_tarea`);
--
-- Indices de la tabla `bentatecnologies_reuniones`
--
ALTER TABLE `bentatecnologies_reuniones`
  ADD PRIMARY KEY (`id_convocatoria`);
--
-- Indices de la tabla `bentastore_informes`
--
ALTER TABLE `bentatecnologies_informes`
  ADD PRIMARY KEY (`id_informe`);
--
-- Indices de la tabla `bentatecnologies_tipo_usuarios`
--
ALTER TABLE `bentatecnologies_tipo_usuarios`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `bentatecnologies_usuarios`
--
ALTER TABLE `bentatecnologies_usuarios`
  ADD PRIMARY KEY (`id_usuario`);
--
-- AUTO_INCREMENT de la tabla `bentatecnologies_proyectos`
--
ALTER TABLE `bentatecnologies_proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `bentatecnologies_tarea`
--
ALTER TABLE `bentatecnologies_tarea`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
  
--
-- AUTO_INCREMENT de la tabla `bentatecnologies_reuniones`
--
ALTER TABLE `bentatecnologies_reuniones`
  MODIFY `id_convocatoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `bentatecnologies_informes`
--
ALTER TABLE `bentatecnologies_informes`
  MODIFY `id_informe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `bentatecnologies_tipo_usuarios`
--
ALTER TABLE `bentatecnologies_tipo_usuarios`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `bentatecnologies_usuarios`
--
ALTER TABLE `bentatecnologies_usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bentatecnologies_proyectos`
--
ALTER TABLE `bentatecnologies_proyectos`
  ADD CONSTRAINT `bentatecnologies_proyectos_ibfk_1` FOREIGN KEY (`n_idusuario`) REFERENCES `bentatecnologies_usuarios` (`id_usuario`),
--
-- Filtros para la tabla `bentatecnologies_tarea`
--
ALTER TABLE `bentatecnologies_tarea`
  ADD CONSTRAINT `bentatecnologies_tarea_ibfk_1` FOREIGN KEY (`n_idproyecto`) REFERENCES `bentatecnologies_proyectos` (`id_proyecto`),
  ADD CONSTRAINT `bentatecnologies_tarea_ibfk_2` FOREIGN KEY (`n_idusuario`) REFERENCES `bentatecnologies_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bentatecnologies_informes`
--
ALTER TABLE `bentatecnologies_informes`
  ADD CONSTRAINT `bentatecnologies_informes_ibfk_1` FOREIGN KEY (`n_idusuario`) REFERENCES `bentatecnologies_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bentatecnologies_informes_ibfk_2` FOREIGN KEY (`n_idproyecto`) REFERENCES `bentatecnologies_proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bentatecnologies_informes_ibfk_3` FOREIGN KEY (`n_idtarea`) REFERENCES `bentatecnologies_tarea` (`id_tarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bentatecnologies_usuarios`
--
ALTER TABLE `bentatecnologies_usuarios`
  ADD CONSTRAINT `bentatecnologies_usuarios_ibfk_1` FOREIGN KEY (`n_idtipo_usuario`) REFERENCES `bentatecnologies_tipo_usuarios` (`id_tipo_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `bentatecnologies_reuniones`
--
ALTER TABLE `bentatecnologies_reuniones`
  ADD CONSTRAINT `bentatecnologies_reuniones_ibfk_1` FOREIGN KEY (`n_idusuario`) REFERENCES `bentatecnologies_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bentatecnologies_reuniones_ibfk_2` FOREIGN KEY (`n_idproyecto`) REFERENCES `bentatecnologies_proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
