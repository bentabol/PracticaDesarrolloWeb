<?php
@session_start();
//Comprobamos que la tarea no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btEnviarTarea'])) {
    if (tareaIdExists($_POST['tareaNombre']) == false) {
        if ($_POST['tareaNombre'])
            $tareaNuevo = [
                'tareaId' => $_POST['tareaId'],
                'tareaNombre' => $_POST['tareaNombre'],
                'tareaDescripcion' => $_POST['tareaDescripcion'],
                'tareaResponsable' => $_POST['tareaResponsable'],
                'tareaInicio' => $_POST['tareaInicio'],
                'tareaFin' => $_POST['tareaFin'],
                'tareaEstado' => $_POST['tareaEstado']
            ];
        $storage = "dataTareas.json";
        $stored_tareas = json_decode(file_get_contents($storage), true);
        array_push($stored_tareas, $tareaNuevo);
        file_put_contents($storage, json_encode($stored_tareas, JSON_PRETTY_PRINT));
        header("Location: listadoProyectos.php");
    }else{       
        $message= "La tarea ya existe, escoge otra."; 
        $_SESSION['errores'] =  $message;
        header("Location: FormularioCreaEdiTareas.php");
    }
}

function tareaIdExists($tareaId)
{
    $storage = "dataTareas.json";
    $stored_tareas = json_decode(file_get_contents($storage), true);
    foreach ($stored_tareas as $clave => $tareaNuevo) {
        if ($tareaNuevo["tareaNombre"] === $tareaNombre) {            
            return true;
        }
    }
    return false;
}
         