<?php
require 'config/conn.php';
require 'bootstrap.php'; 
@session_start();
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\ProyectRepository;

$message = "";
if (isset($_POST['btActivar'])) {
    $ProyectRepository = $em->getRepository("Model\Entity\bentatecnologies_proyectos");
    $proyect = $ProyectRepository->find($_POST['idProyecto']);
    if ($proyect) {
        $activo = $proyect->getI_activoProyecto() == 1 ? 0 : 1;
        $proyect->setI_activoProyecto($activo);
        $em->flush();
        $message = $activo == 1 ? 'Proyecto activado.' : 'Proyecto desactivado.';
        $_SESSION['message'] = $message;
        header("Location: backofficeProyectos.php");
        exit;
    } else {
        $message = 'Lo sentimos, debe haber un problema. Por favor, inténtelo de nuevo.';
        $_SESSION['errores'] = $message;
        header("Location: backofficeProyectos.php");
        exit;
    }
}