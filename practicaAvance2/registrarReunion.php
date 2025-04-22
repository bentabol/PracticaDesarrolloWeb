<?php
require 'config/conn.php';
require 'utils.php';
@session_start();
$message = "";
if (isset($_POST['btEnviarReunion'])) {
    if (nombreReunionExists($_POST['tituloReunion']) == false) {        
        $userCreator=getDatosUsuario($_SESSION['username']);    
        $idUsuario=$userCreator['id_usuario'];     
        //Si no existe en bd se inserta
        $sql = "INSERT INTO bentatecnologies_reuniones (c_tituloReunion, f_fechaReunion, t_horaReunion, c_lugarReunion, c_descripcionReunion, n_idusuario) VALUES (:c_tituloReunion, :f_fechaReunion, :t_horaReunion, :c_lugarReunion, :c_descripcionReunion, :n_idusuario)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':c_tituloReunion', $_POST['tituloReunion']);
        $stmt->bindParam(':f_fechaReunion', $_POST['fechaReunion']);
        $stmt->bindParam(':t_horaReunion', $_POST['horaReunion']);
        $stmt->bindParam(':c_lugarReunion', $_POST['lugarReunion']);
        $stmt->bindParam(':c_descripcionReunion', $_POST['descripcionReunion']);
        $stmt->bindParam(':n_idusuario', $idUsuario);
        //var_dump($stmt);
        //exit;
        if ($stmt->execute()) {
            $message = 'Reunion Registrada correctamente';
            header("Location: listadoProyectos.php");
        } else {
            $message = 'Lo sentimos, debe haber un problema al regostrar la reunion o ya existe';
            header("Location: FormularioConvReunion.php");
        }
    } else {
        $message = "Cambia el titulo de la reunion.";
        header("Location: FormularioConvReunion.php");
    }
    $_SESSION['errores'] =  $message;
}

function nombreReunionExists($tituloReunion)
{
    require 'config/conn.php';
    //Comprobamos que el email no exista
    $datos = $conn->prepare('SELECT c_tituloReunion FROM bentatecnologies_reuniones WHERE c_tituloReunion = :tituloReunion');
    $datos->bindParam(':tituloReunion', $tituloReunion);
    $datos->execute();
    $resultados = $datos->fetch(PDO::FETCH_ASSOC);

    if ($resultados !== false && count($resultados) > 0) {
        return true;
    } else {
        return false;
    }
}
