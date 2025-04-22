<?php

function getDatosUsuario($username)
{
    $storage = "data.json";
    $stored_users = json_decode(file_get_contents($storage), true);

    foreach ($stored_users as $user) {
        if ($user["username"] == $username) {
            $nick = $user["username"];
            $email = $user["email"];
            $nombre = $user["nombre"];
            $apellidos = $user["apellidos"];
            $password = $user["password"];
            $rango = $user["rango"];

            $arrayUsers = [$nick, $email, $nombre, $apellidos, $password, $rango];
        }
    }
    return $arrayUsers;
}

function getDatosProyecto($proyectoNombre)
{
    $storage = "dataProyectos.json";
    $stored_proyects= json_decode(file_get_contents($storage), true);           

    foreach ($stored_proyects as $proyectoNuevo) {
        if ($proyectoNuevo["proyectoNombre"] == $proyectoNombre) {        
            $proyectoId == $proyectoNuevo["proyectoId"];
            $proyectoNombre == $proyectoNuevo["proyectoNombre"];
            $proyectoDescripcion == $proyectoNuevo["proyectoDescripcion"];
            $proyectoResponsable == $proyectoNuevo["proyectoResponsable"];
            $proyectoInicio == $proyectoNuevo["proyectoInicio"];
            $proyectoFin == $proyectoNuevo["proyectoFin"];
            $proyectoEstado == $proyectoNuevo["proyectoEstado"];

                $arrayProyects = [$proyectoId, $proyectoNombre, $proyectoDescripcion, $proyectoResponsable, $proyectoInicio,  $proyectoFin,  $proyectoEstado];
            }
        }
        return $arrayProyects;        
}
