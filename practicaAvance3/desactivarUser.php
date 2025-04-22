<?php
/*
require 'config/conn.php';
require 'utils.php';
@session_start();
$message = "";
if (isset($_POST['btDesactivar'])) {
    $actividad = esActivo($_POST['idUsuario']);
    //Si no existe en bd se inserta
    $sql = "UPDATE bentatecnologies_usuarios SET l_activo=:l_activo WHERE id_usuario=:id_usuario ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':l_activo', $actividad);
    $stmt->bindParam(':id_usuario', $_POST['idUsuario']);

    if ($stmt->execute()) {
        if ($actividad == 2) {
            $message = 'Usuario desactivado. ';
        } else {
            $message = 'Usuario activado. ';
        }
        header("Location: informesAdministradorUsuario.php");
    } else {
        $message = 'Lo sentimos, debe haber un problema. Porfavor, intentelo de nuevo.';
        header("Location: informesAdministradorUsuario.php");
    }
    $_SESSION['errores'] =  $message;
}

function esActivo($idUsuario)
{
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT l_activo FROM bentatecnologies_usuarios WHERE id_usuario = :id_usuario');
    $datos->bindParam(':id_usuario', $idUsuario);
    $datos->execute();
    $resultados = $datos->fetch(PDO::FETCH_ASSOC);
    if ($resultados['l_activo'] == 1) {
        return 0; // Inactivo
    } else {
        return 1; // Activo
    }
}
*/
require 'config/conn.php';
require 'utils.php';
require 'bootstrap.php';
@session_start();
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\UserRepository;

$message = "";
if (isset($_POST['btDesactivar'])) {
    $UserRepository = $em->getRepository("\Model\Entity\bentatecnologies_usuarios");
    $user = $UserRepository->find($_POST['idUsuario']);
    if ($user) {
        $actividad = $user->geti_activo() == 1? 0 : 1; // Toggle active status
        $user->seti_activo($actividad);
        $em->flush();
        $message = $actividad == 0? 'Usuario desactivado.' : 'Usuario activado.';
        $_SESSION['message'] = $message;
        header("Location: informesAdministradorUsuario.php");
        exit;
    } else {
        $message = 'Lo sentimos, debe haber un problema. Porfavor, intentelo de nuevo.';
        $_SESSION['errores'] = $message;
        header("Location: informesAdministradorUsuario.php");
        exit;
    }
}