<?php
@session_start();
//Comprobamos que el proyecto no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btEnviarProyecto'])) {
    if (proyectoIdExists($_POST['proyectoNombre']) == false) {
        if ($_POST['proyectoNombre'])
            $proyectoNuevo = [
                'proyectoId' => $_POST['proyectoId'],
                'proyectoNombre' => $_POST['proyectoNombre'],
                'proyectoDescripcion' => $_POST['proyectoDescripcion'],
                'proyectoResponsable' => $_POST['proyectoResponsable'],
                'proyectoInicio' => $_POST['proyectoInicio'],
                'proyectoFin' => $_POST['proyectoFin'],
                'proyectoEstado' => $_POST['proyectoEstado']
            ];
        $storage = "dataProyectos.json";
        $stored_proyects = json_decode(file_get_contents($storage), true);
        array_push($stored_proyects, $proyectoNuevo);
        file_put_contents($storage, json_encode($stored_proyects, JSON_PRETTY_PRINT));
        header("Location: listadoProyectos.php");
    }else{       
        $message= "El proyecto ya existe, escoge otro."; 
        $_SESSION['errores'] =  $message;
        header("Location: FormularioCreaEdiProyectos.php");
    }
}

function proyectoIdExists($proyectoId)
{
    $storage = "dataProyectos.json";
    $stored_proyects = json_decode(file_get_contents($storage), true);
    foreach ($stored_proyects as $clave => $proyectoNuevo) {
        if ($proyectoNuevo["proyectoNombre"] === $proyectoNombre) {            
            return true;
        }
    }
    return false;
}
         