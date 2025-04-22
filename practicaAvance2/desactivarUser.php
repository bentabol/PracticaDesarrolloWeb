<?php
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
