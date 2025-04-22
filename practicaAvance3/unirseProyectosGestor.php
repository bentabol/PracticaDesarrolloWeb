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
if (isset($_POST['btUnirseGestor'])) {
    $SolicitudesRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_solicitudes");
    $ProyectRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_proyectos");
    $UserRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_usuarios");

    $proyectos = $ProyectRepository->getMisProyectos($_SESSION['idUsuario']);
    $usuario = $UserRepository->getUserById($_POST['idUsuario']);

    
    
    foreach($proyectos as $proyecto) {
         $SolicitudesRepository->addSolicitud($usuario, $proyecto, bentatecnologies_solicitudes::STATUS_PENDIENTE_USUARIO);
    }        
       
            $message = 'Solicitud de union enviada';
            header("Location: backofficegestor.php");

       
    
    $_SESSION['errores'] =  $message;
}
