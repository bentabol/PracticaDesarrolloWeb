<?php
require 'config/conn.php';
require 'utils.php';
require 'bootstrap.php';
@session_start();
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\SolicitudesRepository;
use model\Repository\UserRepository;
use model\Repository\ProyectRepository;
use model\Entity\bentatecnologies_solicitudes;


$message = "";
if (isset($_POST['btUnirse'])) {
    $ProyectRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_proyectos");
    $UserRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_usuarios");
    $SolicitudesRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_solicitudes");

    $proyecto = $ProyectRepository->getProyectById($_POST['idProyecto']);
    $usuario = $UserRepository->getUserById($_SESSION['idUsuario']);

    if ( $proyecto != NULL) {

        $SolicitudesRepository->addSolicitud($usuario, $proyecto, bentatecnologies_solicitudes::STATUS_PENDIENTE_PROFESOR);
            $message = 'Solicitud de union enviada';
            header("Location: backofficeProyectos.php");
    } else {
        $message = "El proyecto no existe";
        header("Location: backofficeProyectos.php");
    }
    $_SESSION['errores'] =  $message;
}
