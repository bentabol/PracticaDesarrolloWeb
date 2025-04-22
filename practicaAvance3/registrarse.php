<?php
require 'config/conn.php';
require 'bootstrap.php';
require 'utils.php';

@session_start();
$message = "";
if (isset($_POST['btEnviar'])) {
    $UserRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_usuarios");
    $tipoUsuarioRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_tipo_usuarios");

    if ($UserRepository->usernameExists($_POST['username'], $_POST['email']) == false)  {
        $tipoUsuario = $tipoUsuarioRepository->findOneBy(['id_tipo_usuario' => $_POST['tipo']]);
        $datosUser = $UserRepository->newUser($_POST['username'], $_POST['email'], $_POST['nombre'], $_POST['apellidos'], $_POST['password'], $tipoUsuario);

        $_SESSION['n_idtipo_usuario'] = $_POST['tipo'];
        $message = 'Usuario creado correctamente. ';
        header("Location: login.php");
    } else {
        $message = "El usuario ya existe, escoge otro.";
        header("Location: registro.php");
    }
    $_SESSION['errores'] =  $message;
}