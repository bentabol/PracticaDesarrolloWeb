<?php
/*
function getDatosUsuario($usermane)
{
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT usuarios.*,tipos.c_descripcion tipo FROM bentatecnologies_usuarios usuarios INNER JOIN bentatecnologies_tipo_usuarios tipos ON (tipos.id_tipo_usuario = usuarios.n_idtipo_usuario) WHERE c_nickname=:c_nickname');
    $datos->bindParam(':c_nickname', $usermane);
    $datos->execute();
    $stored_users = $datos->fetchAll(PDO::FETCH_ASSOC);

    return $stored_users[0];
}



function getAllProyects()
{
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT * FROM bentatecnologies_proyectos ORDER BY c_ruta_archivo ASC ');
    $datos->execute();
    $proyectos = $datos->fetchAll(PDO::FETCH_ASSOC);

    return $proyectos;
}

function getAllTareas()
{
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT * FROM bentatecnologies_tarea');
    $datos->execute();
    $tarea = $datos->fetchAll(PDO::FETCH_ASSOC);

    return $tarea;
}

function getMyProyects($userID)
{
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT * FROM bentatecnologies_proyectos WHERE id_proyecto IN(SELECT n_idproyecto FROM bentatecnologies_tarea
     WHERE n_idusuario=:id_usuario)');
    $datos->bindParam(':id_usuario', $userID);
    $datos->execute();
    $proyectos = $datos->fetchAll(PDO::FETCH_ASSOC);

    return $proyectos;
}

function getMyTareas($userID)
{
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT * FROM bentatecnologies_tarea WHERE id_tarea IN(SELECT n_idtarea FROM bentatecnologies_proyectos
     WHERE n_idusuario=:id_usuario)');
    $datos->bindParam(':id_usuario', $userID);
    $datos->execute();
    $tarea = $datos->fetchAll(PDO::FETCH_ASSOC);

    return $tarea;
}




function usuarioActivo($activo)
{
    if ($activo == 1) {
        return "Activo";
    } else {
        return "Inactivo";
    }
}

function tipoUsuario($tipoUser)
{
    if ($tipoUser == 2) {
        return "Gestor";
    } else if($tipoUser == 3) {
        return "Cliente";
    } else if($tipoUser == 1) {
        return "Administrador";
    }
}

function getInformesDescargas()
{
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT * FROM bentatecnologies_informes ORDER BY t_descargas ASC');
    $datos->execute();
    $descargas = $datos->fetchAll(PDO::FETCH_ASSOC);

    return $descargas;
}

function getCreadorApp($userID)
{
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT c_nickname FROM bentatecnologies_usuarios WHERE id_usuario=:id_usuario');
    $datos->bindParam(':id_usuario', $userID);
    $datos->execute();
    $plugins = $datos->fetch(PDO::FETCH_ASSOC);

    return $plugins;
}


function getNicknameById($idUsuario)
{
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT c_nickname FROM bentatecnologies_usuarios WHERE id_usuario=:id_usuario');
    $datos->bindParam(':id_usuario', $idUsuario);
    $datos->execute();
    $nick = $datos->fetch(PDO::FETCH_ASSOC);

    return $nick;
}

function getProyectNameById($idProyecto)
{
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT * FROM bentatecnologies_proyectos WHERE id_proyecto=:id_proyecto');
    $datos->bindParam(':id_proyecto', $idApp);
    $datos->execute();
    $nick = $datos->fetch(PDO::FETCH_ASSOC);

    return $nick;
}

function getTareaNameById($idTarea)
{
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT * FROM bentatecnologies_tarea WHERE id_tarea=:id_tarea');
    $datos->bindParam(':id_tarea', $idApp);
    $datos->execute();
    $nick = $datos->fetch(PDO::FETCH_ASSOC);

    return $nick;
}
*/


