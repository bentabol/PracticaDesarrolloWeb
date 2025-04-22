<?php
@session_start();
//Comprobamos que el usuario no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btEnviarProyecto'])) {
    actualizarProyecto($_SESSION['proyectoId']);
    header("Location: FormularioCreaEdiProyectos.php");
}

function actualizarProyecto($proyects)
{
    $storage = "dataProyectos.json";
    $stored_proyects = json_decode(file_get_contents($storage), true);
    foreach ($stored_proyects as $clave => $proyectoNuevo) {        
        if ($proyectoNuevo["proyectoId"] === $proyectoId) {            
            $$proyectoNuevo2 = [
                'proyectoId' => $proyectoId,
                'proyectoNombre' => $_POST['proyectoNombre2'],
                'proyectoDescripcion' => $_POST['proyectoDescripcion2'],
                'proyectoResponsable' => $_POST['proyectoResponsable2'],
                'proyectoInicio' => $_POST['proyectoInicio2'],
                'proyectoFin' => $_POST['proyectoFin2'],
                'proyectoEstado' => $_POST['proyectoEstado2']
            ];  
            unset($stored_proyects[$clave]);    
        }             
    }
    $message = "Proyecto editado correctamente";
    $_SESSION['message'] =  $message;
    
    array_push($stored_proyects2, $proyectoNuevo2);
    file_put_contents($storage, json_encode($stored_proyects, JSON_PRETTY_PRINT));
}
