INSERT INTO `bentatecnologies_tipo_usuarios` (`id_tipo_usuario`, `c_descripcion`) VALUES
(1, 'Administrador'),
(2, 'Gestor'),
(3, 'Cliente');

INSERT INTO `bentatecnologies_usuarios` (`id_usuario`, `c_nickname`, `c_email`, `c_nombre`, `c_apellidos`, `c_password`, `c_telefono`, `c_direccion`, `l_activo`, `t_conexiones`, `n_idtipo_usuario`) VALUES
(1, 'admin', 'admin@bentatecnologies.com', 'Guillermo', 'Bentabola', 'admin', 'vacío', 'vacío', 1, 28, 1),
(2, 'gestor', 'joe@gmail.com', 'Joe', 'Candela Montes', 'gestor', 'vacío', 'vacío', 1, 8, 2),
(3, 'cliente', 'mani@gmail.com', 'Mani', 'Calavera', 'cliente', 'vacío', 'vacío', 1, 12, 3),
(4, 'Gestorr', 'Gestor@gmail.com', 'GestorNombre', 'GestorApellido', 'Gestor123', 'vacío', 'vacío', 1, 3, 2),
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
