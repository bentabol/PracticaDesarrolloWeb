<?php
require 'config/conn.php';
require 'utils.php';
@session_start();
$message = "";
if (isset($_POST['btDescargar'])) {
    if (isset($_POST['idProyecto']) && isset($_POST['idUsuario'])) {

        $descargas = getDescargasUser($_POST['idProyecto'], $_POST['idUsuario']);
        if (informeUserExist($_POST['idProyecto'], $_POST['idUsuario']) == true) {
            $descargas2 = $descargas['t_descargas'] + 1;              
            $sql = "UPDATE bentatecnologies_informes SET t_descargas=:descargas WHERE n_idProyecto=:n_idapp AND n_idusuario=:n_iduser";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':descargas', $descargas2);
            $stmt->bindParam(':n_idapp', $_POST['idProyecto']);
            $stmt->bindParam(':n_iduser', $_POST['idUsuario']);            
            if ($stmt->execute()) {
                header("Content-disposition: attachment; filename=archivosProyectos/" . getUrlProyect($_POST['idProyecto']));
                header("Content-type: application/zip");
                readfile("archivosProyectos/" . getUrlProyect($_POST['idProyecto']));
                $message = 'Proyecto descargado correctamente. ';
                header("Location: misProyectos.php");
            } else {
                $message = 'Lo sentimos, debe haber un problema al descargar el proyecto. Porfavor, intentelo de nuevo.';
                header("Location: misProyectos.php");
            }
        } else {  
            $fecha= date("Y-m-d");         
            $sql = "INSERT INTO bentatecnologies_informes (f_fecha, t_descargas, n_idproyecto, n_idusuario) VALUES (:fecha, :descargas, :idproyecto, :idusuario)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fecha',$fecha);
            $stmt->bindParam(':descargas', $descargas);
            $stmt->bindParam(':idProyecto', $_POST['idProyecto']);
            $stmt->bindParam(':idusuario', $_POST['idUsuario']);

            if ($stmt->execute()) {
                header("Content-disposition: attachment; filename=archivosProyectos/" . getUrlPlugin($_POST['idProyecto']));
                header("Content-type: application/zip");
                readfile("archivosProyectos/" . getUrlProyect($_POST['idProyecto']));
                $message = 'Proyecto descargado correctamente. ';
                header("Location: misProyectos.php");
            } else {
                $message = 'Lo sentimos, debe haber un problema al descargar proyecto. Porfavor, intentelo de nuevo.';
                header("Location: misProyectos.php");
            }
        }
        $_SESSION['errores'] =  $message;
    }
}

function getDescargasUser($idProyecto, $idUsuario)
{
    require 'config/conn.php';
    //Comprobamos las descargas
    $datos = $conn->prepare('SELECT t_descargas FROM bentatecnologies_informes WHERE n_idproyecto=:n_idproyecto AND n_idusuario=:n_idusuario');
    $datos->bindParam(':n_idProyecto', $idProyecto);
    $datos->bindParam(':n_idusuario', $idUsuario);
    $datos->execute();
    $resultados = $datos->fetch(PDO::FETCH_ASSOC);
    if ($resultados !== false && count($resultados) > 0) {
        return $resultados;
    } else {
        return 1;
    }
}

function informeUserExist($idApp, $idUser)
{
    require 'config/conn.php';
    //Comprobamos las descargas
    $datos = $conn->prepare('SELECT * FROM bentatecnologies_informes WHERE n_idProyecto=:n_idProyecto AND n_idusuario=:n_idusuario');
    $datos->bindParam(':n_idProyecto', $idApp);
    $datos->bindParam(':n_idusuario', $idUser);
    $datos->execute();
    $resultados = $datos->fetch(PDO::FETCH_ASSOC);
    if ($resultados !== false && count($resultados) > 0) {
        return true;
    } else {
        return false;
    }
}
