<?php
require 'config/conn.php';
@session_start();
$message = "";
if (isset($_POST['btEnviarProyecto'])) {
    if (proyectoIdExists($_POST['proyectoNombre']) == false) {
        //Si no existe en bd se inserta
        $sql = "INSERT INTO bentatecnologies_proyectos (id_proyecto, c_nombreProyecto, c_descripcionProyecto, c_responsableProyecto,f_fechaInicioProyecto, f_fechaFinProyecto, l_activoProyecto, c_ruta_imagen, c_ruta_archivo ) VALUES (:id_proyecto, :proyectoNombre, :proyectoDescripcion, :proyectoResponsable,:proyectoInicio, :proyectoFin, :proyectoEstado, :proyectoImage, :proyectoArchive )";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_proyecto', $_POST['id_proyecto']);
        $stmt->bindParam(':c_nombreProyecto', $_POST['proyectoNombre']);
        $stmt->bindParam(':c_descripcionProyecto', $_POST['proyectoDescripcion']);
        $stmt->bindParam(':c_responsableProyecto', $_POST['proyectoResponsable']);
        $stmt->bindParam(':f_fechaInicioProyecto', $_POST['proyectoInicio']);
        $stmt->bindParam(':f_fechaFinProyecto', $_POST['proyectoFin']);
        $stmt->bindParam(':c_ruta_imagen', $_POST['proyectoImage']);
        $stmt->bindParam(':c_ruta_archivo', $_POST['proyectoArchive']);
        $stmt->bindParam(':proyectoEstado', $_POST['proyectoEstado']);
        if ($stmt->execute()) {
            $message = 'Proyeto creado correctamente. ';
            header("Location: listadoProyectos.php");
        } else {
            $message = 'Lo sentimos, debe haber un problema al crear el proyecto o su cuenta ya existe. Porfavor, intentelo de nuevo.';
            header("Location: FormularioCreaEdiProyectos.php");
        }
       
    } else {
        $message = "El proyecto ya existe, escoge otro.";
        header("Location: FormularioCreaEdiProyectos.php");
        
    }
    $_SESSION['errores'] =  $message;
    
}

function proyectoIdExists($proyectoId)
{
    require 'config/conn.php';
    //Comprobamos que el email no exista
    $datos = $conn->prepare('SELECT id_proyecto FROM bentatecnologies_proyectos WHERE c_nombreProyecto = :proyectoNombre');
    $datos->bindParam(':proyectoNombre', $proyectoNombre);
    $datos->execute();
    $resultados = $datos->fetch(PDO::FETCH_ASSOC);

    if ($resultados !== false && count($resultados) > 0) {
        return true;
    } else {
        return false;
    }
}
