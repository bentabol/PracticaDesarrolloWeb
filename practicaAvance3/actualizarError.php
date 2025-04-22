<?php
require 'bootstrap.php';
require 'config/conn.php';    

@session_start();
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use model\Repository\InformesRepository;
if (isset($_POST['btValorar'])) {
    $InformesRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_informes");
    //$datos = $conn->prepare('UPDATE bentatecnologies_informes SET c_errores=:c_errores WHERE n_idproyecto=:n_idproyecto AND n_idusuario=:n_idusuario');
    
     $InformesRepository->updateError($_POST['idProyecto'], $_POST['idUsuario'], $_POST['errores']);

    $message = "Error registrado correctamente";
    $_SESSION['message'] =  $message;    
    header("Location: misProyectos.php");
}