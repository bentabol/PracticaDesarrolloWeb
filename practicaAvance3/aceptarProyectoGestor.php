<?php
require 'config/conn.php';
require 'utils.php';
require 'bootstrap.php';
@session_start();
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\SolicitudesRepository;
use model\Entity\bentatecnologies_solicitudes;


$message = "";
if (isset($_POST['btAceptar'])) {
    $SolicitudesRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_solicitudes");

    $SolicitudesRepository->aceptarSolicitudUsuarioProyecto($_POST['idUsuario'], $_POST['idProyecto']);
    
            $message = 'Solicitud Aceptada';
            header("Location:solicitudesGestor.php");

    
    $_SESSION['errores'] =  $message;
}
