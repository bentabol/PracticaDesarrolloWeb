<?php
require 'config/conn.php';
require 'utils.php';
@session_start();
$message = "";
if (isset($_POST['btEliminar'])) {
    if ($_POST['idProyecto']!=null) {

        //Si no existe en bd se inserta
        $sql = "DELETE FROM bentatecnologies_proyectos WHERE id_proyecto=:id_proyecto";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_proyecto', $_POST['id_proyecto']);

        if ($stmt->execute()) {
            $message = 'Proyecto eliminado correctamente. ';
            header("Location: informesGestor.php");
        } else {
            $message = 'Lo sentimos, debe haber un problema al eliminar el proyecto o no existe. Porfavor, intentelo de nuevo.';
            header("Location: informesGestor.php");
        }
    } else {
        $message = "El id del proyecto no existe.";
        header("Location: informesGestor.php");
    }
    $_SESSION['errores'] =  $message;
}
