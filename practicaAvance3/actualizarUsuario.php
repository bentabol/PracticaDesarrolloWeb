<?php
require 'bootstrap.php';
require 'config/conn.php';
require 'utils.php';
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\UserRepository;    

@session_start();
//Comprobamos que el usuario no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btEnviar'])) {
    $UserRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_usuarios");

    //obtendria el repositoria de bentatecnologiesUsuarios y ya llamaria el metodo
     $datosUser = $UserRepository->updateUser($_POST['username3'],$_POST['email2'], $_POST['nombre2'], $_POST['apellidos2'], $_POST['password2']);
    
    $message = "Usuario editado correctamente";
    $_SESSION['message'] =  $message;    
    header("Location: usuario.php");
}

