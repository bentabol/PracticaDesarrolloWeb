<?php
require 'config/conn.php';
require 'utils.php';
@session_start();
$message = "";
if (isset($_POST['btEnviarProyecto'])) {
    $proyectoArchive = $_FILES['proyectoArchive']['name'];    
    if (nombreProyectoExists($_POST['proyectoNombre']) == false) {        
        //Obtenemos algunos datos necesarios sobre el archivo del proyecto
        $tipoArchivo = $_FILES['proyectoArchive']['type'];
        $tamanoArchivo = $_FILES['proyectoArchive']['size'];
        $tempArchivo = $_FILES['proyectoArchive']['tmp_name'];

        if (move_uploaded_file($tempArchivo, 'archivosProyectos/' . $proyectoArchive)) {
            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
            chmod('archivosProyectos/' . $proyectoArchive, 0777);
        }
        $userCreator=getDatosUsuario($_SESSION['username']);    
        $idUsuario=$userCreator['id_usuario'];     
        //Si no existe en bd se inserta
        $sql = "INSERT INTO bentatecnologies_proyectos (c_nombreProyecto, c_descripcionProyecto, c_responsableProyecto, f_fechaInicioProyecto, f_fechaFinProyecto, l_activoProyecto, c_ruta_archivo, n_idusuario) VALUES (:c_nombre, :c_descripcion, :c_responsableProyecto, :f_fechaInicioProyecto, :f_fechaFinProyecto,  :l_activoProyecto,:c_ruta_archivo, :n_idusuario)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':c_nombreProyecto', $_POST['proyectoNombre']);
        $stmt->bindParam(':c_descripcionProyecto', $_POST['proyectoDescripcion']);
        $stmt->bindParam(':c_responsableProyecto', $_POST['proyectoResponsable']);
        $stmt->bindParam(':f_fechaInicioProyecto', $_POST['proyectoInicio']);
        $stmt->bindParam(':f_fechaFinProyecto', $_POST['proyectoFin']);
        $stmt->bindParam(':l_activoProyecto', $_POST['proyectoEstado']);
        $stmt->bindParam(':c_ruta_archivo', $proyectoArchive);
        $stmt->bindParam(':n_idusuario', $idUsuario);
        var_dump($stmt);
        exit;
        if ($stmt->execute()) {
            $message = 'Proyecto subido correctamente. ';
            header("Location: listadoProyectos.php");
        } else {
            $message = 'Lo sentimos, debe haber un problema al subir el proyecto o ya existe. Porfavor, intentelo de nuevo.';
            header("Location: subirProyecto.php");
        }
    } else {
        $message = "El nombre del proyecto ya existe, escoge otro.";
        header("Location: subirProyecto.php");
    }
    $_SESSION['errores'] =  $message;
}

function nombreProyectoExists($proyectoNombre)
{
    require 'config/conn.php';
    //Comprobamos que el email no exista
    $datos = $conn->prepare('SELECT c_nombreProyecto FROM bentatecnologies_proyectos WHERE c_nombreProyecto = :proyectoNombre');
    $datos->bindParam(':proyectoNombre', $proyectoNombre);
    $datos->execute();
    $resultados = $datos->fetch(PDO::FETCH_ASSOC);

    if ($resultados !== false && count($resultados) > 0) {
        return true;
    } else {
        return false;
    }
}
