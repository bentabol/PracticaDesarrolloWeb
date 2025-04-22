-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 12:37:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
-- Estructura de tabla para la tabla `bentatecnologies_informes`
--

CREATE TABLE `bentatecnologies_informes` (
  `id_informe` int(11) NOT NULL,
  `f_fecha` date NOT NULL,
  `c_errores` varchar(100) NOT NULL,
  `t_descargas` tinyint(2) NOT NULL,
  `t_exportaciones` int(100) NOT NULL,
  `n_idproyecto` int(11) NOT NULL,
  `n_idtarea` int(11) NOT NULL,
  `n_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bentatecnologies_proyectos`
--

CREATE TABLE `bentatecnologies_proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `c_nombreProyecto` varchar(100) NOT NULL,
  `c_descripcionProyecto` varchar(100) NOT NULL,
  `c_responsableProyecto` varchar(100) NOT NULL,
  `f_fechaInicioProyecto` date NOT NULL,
  `f_fechaFinProyecto` date NOT NULL,
  `l_activoProyecto` tinyint(1) NOT NULL DEFAULT 1,
  `c_tamañoArchivo` varchar(100) DEFAULT NULL,
  `c_ruta_archivo` varchar(100) DEFAULT NULL,
  `n_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bentatecnologies_proyectos`
--

INSERT INTO `bentatecnologies_proyectos` (`id_proyecto`, `c_nombreProyecto`, `c_descripcionProyecto`, `c_responsableProyecto`, `f_fechaInicioProyecto`, `f_fechaFinProyecto`, `l_activoProyecto`, `c_tamañoArchivo`, `c_ruta_archivo`, `n_idusuario`) VALUES
(17, 'ProyectoAdministrador1', 'Descripcion', 'admin', '2021-05-22', '2025-05-22', 1, '7000', 'archivosProyectos/ArchivoProyecto.txt', 1),
(18, 'ProyectoAdministrador2', 'Descripcion', 'admin', '2000-05-10', '2025-12-12', 1, '500', 'archivosProyectos/ArchivoProyecto.txt', 1),
(19, 'ProyectoAdministrador3', 'Descripcion', 'admin', '2001-11-11', '2005-11-11', 1, '70', 'archivosProyectos/ArchivoProyecto.txt', 1),
(20, 'ProyectoJoe', 'Descripcion', 'joe', '2024-05-01', '2024-05-31', 0, '500', 'archivosProyectos/ArchivoProyecto.txt', 2),
(21, 'ProyectoJoe2', 'Descripcion', 'joe', '2024-05-01', '2024-05-05', 0, '50', 'archivosProyectos/ArchivoProyecto.txt', 2),
(22, 'ProyectoGestor1', 'Descripcion', 'Gestor', '2021-05-04', '2025-02-17', 1, '8500', 'archivosProyectos/ArchivoProyecto.txt', 4),
(23, 'ProyectoGestor2', 'Descripcion', 'Gestor', '2023-08-11', '2025-04-30', 1, '100', 'archivosProyectos/ArchivoProyecto.txt', 4),
(24, 'ProyectoGestorGestor', 'Descripcion', 'Gestor', '2024-02-29', '2024-05-30', 1, '98', 'archivosProyectos/Practica3.pdf', 5),
(25, 'ProyectoGestorGestor2', 'Descripcion', 'Gestor', '2020-01-02', '2023-05-12', 1, '8400', 'archivosProyectos/Practica3.pdf', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bentatecnologies_reuniones`
--

CREATE TABLE `bentatecnologies_reuniones` (
  `id_convocatoria` int(11) NOT NULL,
  `c_tituloReunion` varchar(100) NOT NULL,
  `f_fechaReunion` date NOT NULL,
  `t_horaReunion` time NOT NULL,
  `c_lugarReunion` varchar(100) NOT NULL,
  `c_descripcionReunion` varchar(100) NOT NULL,
  `n_idproyecto` int(11) NOT NULL,
  `n_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bentatecnologies_solicitudes`
--

CREATE TABLE `bentatecnologies_solicitudes` (
  `n_idusuario` int(11) NOT NULL,
  `n_idproyecto` int(11) NOT NULL,
  `status` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bentatecnologies_tarea`
--

CREATE TABLE `bentatecnologies_tarea` (
  `id_tarea` int(11) NOT NULL,
  `c_nombreTarea` varchar(100) NOT NULL,
  `c_descripcionTarea` varchar(100) NOT NULL,
  `c_responsableTarea` varchar(100) NOT NULL,
  `f_fechaInicioTarea` date NOT NULL,
  `f_fechaFinTarea` date NOT NULL,
  `l_activoTarea` tinyint(1) NOT NULL DEFAULT 1,
  `n_idproyecto` int(11) NOT NULL,
  `n_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bentatecnologies_tipo_usuarios`
--

CREATE TABLE `bentatecnologies_tipo_usuarios` (
  `id_tipo_usuario` int(11) NOT NULL,
  `c_descripcion` varchar(100) NOT NULL
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
  `c_nickname` varchar(100) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_nombre` varchar(100) NOT NULL,
  `c_apellidos` varchar(100) NOT NULL,
  `c_password` varchar(100) NOT NULL,
  `c_telefono` varchar(100) NOT NULL DEFAULT 'vacío',
  `c_direccion` varchar(100) NOT NULL DEFAULT 'vacío',
  `l_activo` tinyint(1) NOT NULL DEFAULT 1,
  `t_conexiones` tinyint(2) NOT NULL DEFAULT 1,
  `n_idtipo_usuario` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bentatecnologies_usuarios`
--

INSERT INTO `bentatecnologies_usuarios` (`id_usuario`, `c_nickname`, `c_email`, `c_nombre`, `c_apellidos`, `c_password`, `c_telefono`, `c_direccion`, `l_activo`, `t_conexiones`, `n_idtipo_usuario`) VALUES
(1, 'admin', 'admin@bentatecnologies.com', 'Guillermo', 'Bentabola', 'abcd1234', 'vacío', 'vacío', 1, 28, 1),
(2, 'joe', 'joe@gmail.com', 'Joe', 'Candela Montes', '6262', 'vacío', 'vacío', 1, 8, 2),
(3, 'mani', 'mani@gmail.com', 'Mani', 'Calavera', 'Ca6262', 'vacío', 'vacío', 1, 12, 3),
(4, 'Gestor', 'Gestor@gmail.com', 'GestorNombre', 'GestorApellido', 'Gestor123', 'vacío', 'vacío', 1, 3, 2),
(5, 'Gestor2', 'Gestor@gmail.com', 'GestorNombreP', 'GestorApellido', 'Gestor123', 'vacío', 'vacío', 1, 5, 2),
(10, 'Guillermo2', 'Guillermo2@gmail.com', 'Guillermo', 'Guillermo', 'Guillermo234', 'vacío', 'vacío', 1, 2, 2),
(11, 'Guillermo3', 'Guillermo@gmail.com', 'Guillermo', 'Guillermo', 'Guillermo12345', 'vacío', 'vacío', 1, 1, 1),
(12, 'Inactivo', 'Inactivo@gmail.com', 'PruebaEditado', 'ApellidosPrueba', 'Inactivo123', 'vacío', 'vacío', 0, 4, 3),
(13, 'Inactivo', 'Inactivo@gmail.com', 'Paco', 'Mendez', 'Inactivo123', 'vacío', 'vacío', 0, 4, 3),
(14, 'Inactivo2', 'Inactivo2@gmail.com', 'Leo', 'Inactivo', 'Inactivo1234', 'vacío', 'vacío', 1, 5, 3),
(15, 'Alumno', 'Alumno@gmail.com', 'Alumno', 'Lopez', 'Alumno12345', 'vacío', 'vacío', 1, 5, 3),
(16, 'DefensaPractica2', 'DefensaPractica2@gmail.com', 'Defensaprueba', 'DefensaPractica', 'DefensaPractica2123', 'vacío', 'vacío', 1, 1, 3),
(17, 'PruebaRegistro', 'PruebaRegistro@gmail.com', 'PruebaRegistro', 'PruebaRegistro', 'PruebaRegistro123', 'vacío', 'vacío', 1, 1, 3),
(18, 'PruebaRegistro2', 'PruebaRegistro@gmail.com', 'PruebaRegistro', 'PruebaRegistro', 'PruebaRegistro123', 'vacío', 'vacío', 1, 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bentatecnologies_informes`
--
ALTER TABLE `bentatecnologies_informes`
  ADD PRIMARY KEY (`id_informe`),
  ADD KEY `bentatecnologies_informes_ibfk_1` (`n_idusuario`),
  ADD KEY `bentatecnologies_informes_ibfk_2` (`n_idproyecto`),
  ADD KEY `bentatecnologies_informes_ibfk_3` (`n_idtarea`);

--
-- Indices de la tabla `bentatecnologies_proyectos`
--
ALTER TABLE `bentatecnologies_proyectos`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `n_idusuario` (`n_idusuario`);

--
-- Indices de la tabla `bentatecnologies_reuniones`
--
ALTER TABLE `bentatecnologies_reuniones`
  ADD PRIMARY KEY (`id_convocatoria`),
  ADD KEY `bentatecnologies_reuniones_ibfk_1` (`n_idusuario`),
  ADD KEY `bentatecnologies_reuniones_ibfk_2` (`n_idproyecto`);

--
-- Indices de la tabla `bentatecnologies_solicitudes`
--
ALTER TABLE `bentatecnologies_solicitudes`
  ADD PRIMARY KEY (`n_idusuario`,`n_idproyecto`),
  ADD KEY `bentatecnologies_usuarios_proyectos_ibfk_2` (`n_idproyecto`);

--
-- Indices de la tabla `bentatecnologies_tarea`
--
ALTER TABLE `bentatecnologies_tarea`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `n_idusuario` (`n_idusuario`),
  ADD KEY `bentatecnologies_tarea_ibfk_1` (`n_idproyecto`);

--
-- Indices de la tabla `bentatecnologies_tipo_usuarios`
--
ALTER TABLE `bentatecnologies_tipo_usuarios`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `bentatecnologies_usuarios`
--
ALTER TABLE `bentatecnologies_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `n_idtipo_usuario` (`n_idtipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bentatecnologies_informes`
--
ALTER TABLE `bentatecnologies_informes`
  MODIFY `id_informe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `bentatecnologies_proyectos`
--
ALTER TABLE `bentatecnologies_proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `bentatecnologies_reuniones`
--
ALTER TABLE `bentatecnologies_reuniones`
  MODIFY `id_convocatoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `bentatecnologies_tarea`
--
ALTER TABLE `bentatecnologies_tarea`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `bentatecnologies_tipo_usuarios`
--
ALTER TABLE `bentatecnologies_tipo_usuarios`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `bentatecnologies_usuarios`
--
ALTER TABLE `bentatecnologies_usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bentatecnologies_informes`
--
ALTER TABLE `bentatecnologies_informes`
  ADD CONSTRAINT `bentatecnologies_informes_ibfk_1` FOREIGN KEY (`n_idusuario`) REFERENCES `bentatecnologies_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bentatecnologies_informes_ibfk_2` FOREIGN KEY (`n_idproyecto`) REFERENCES `bentatecnologies_proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bentatecnologies_informes_ibfk_3` FOREIGN KEY (`n_idtarea`) REFERENCES `bentatecnologies_tarea` (`id_tarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bentatecnologies_proyectos`
--
ALTER TABLE `bentatecnologies_proyectos`
  ADD CONSTRAINT `bentatecnologies_proyectos_ibfk_1` FOREIGN KEY (`n_idusuario`) REFERENCES `bentatecnologies_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bentatecnologies_reuniones`
--
ALTER TABLE `bentatecnologies_reuniones`
  ADD CONSTRAINT `bentatecnologies_reuniones_ibfk_1` FOREIGN KEY (`n_idusuario`) REFERENCES `bentatecnologies_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bentatecnologies_reuniones_ibfk_2` FOREIGN KEY (`n_idproyecto`) REFERENCES `bentatecnologies_proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bentatecnologies_solicitudes`
--
ALTER TABLE `bentatecnologies_solicitudes`
  ADD CONSTRAINT `bentatecnologies_solicitudes_ibfk_1` FOREIGN KEY (`n_idusuario`) REFERENCES `bentatecnologies_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bentatecnologies_solicitudes_ibfk_2` FOREIGN KEY (`n_idproyecto`) REFERENCES `bentatecnologies_proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bentatecnologies_tarea`
--
ALTER TABLE `bentatecnologies_tarea`
  ADD CONSTRAINT `bentatecnologies_tarea_ibfk_1` FOREIGN KEY (`n_idproyecto`) REFERENCES `bentatecnologies_proyectos` (`id_proyecto`),
  ADD CONSTRAINT `bentatecnologies_tarea_ibfk_2` FOREIGN KEY (`n_idusuario`) REFERENCES `bentatecnologies_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bentatecnologies_tipo_usuarios`
--
ALTER TABLE `bentatecnologies_tipo_usuarios`
  ADD CONSTRAINT `bentatecnologies_tipo_usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `bentatecnologies_usuarios` (`n_idtipo_usuario`);

--
-- Filtros para la tabla `bentatecnologies_usuarios`
--
ALTER TABLE `bentatecnologies_usuarios`
  ADD CONSTRAINT `bentatecnologies_usuarios_ibfk_1` FOREIGN KEY (`n_idtipo_usuario`) REFERENCES `bentatecnologies_tipo_usuarios` (`id_tipo_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bentatecnologies_usuarios_ibfk_2` FOREIGN KEY (`n_idtipo_usuario`) REFERENCES `bentatecnologies_tipo_usuarios` (`id_tipo_usuario`),
  ADD CONSTRAINT `bentatecnologies_usuarios_ibfk_3` FOREIGN KEY (`n_idtipo_usuario`) REFERENCES `bentatecnologies_tipo_usuarios` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
