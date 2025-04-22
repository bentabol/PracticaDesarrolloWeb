<?php
@session_start();
require 'config/conn.php';

if (isset($_POST['btEnviar'])) {
    $datos = $conn->prepare('SELECT * FROM bentatecnologies_tipo_usuarios WHERE id_tipo_usuario = :editRole');
    $datos->bindParam(':editRole', $_POST['editRole']);
    $datos->execute();
    $resultado = $datos->fetch(PDO::FETCH_ASSOC);

    if (!$resultado) {
        $message = "El rol seleccionado no existe";
        $_SESSION['errores'] = $message;
        header("Location: informesAdministradorUsuario.php");
        exit;
    }

    if (empty($_POST['userId']) || empty($_POST['editEmail']) || empty($_POST['editName']) || empty($_POST['editLastname']) || empty($_POST['editPassword'])) {
        $message = "Por favor, complete todos los campos";
        $_SESSION['errores'] =$message;
        header("Location: informesAdministradorUsuario.php");
        exit;
    }

    $datos = $conn->prepare('UPDATE bentatecnologies_usuarios SET c_email=:editEmail, c_nombre=:editName, c_apellidos=:editLastname, c_password=:editPassword, l_activo=:editActive, n_idtipo_usuario=:editRole WHERE id_usuario=:userId');
    $datos->bindParam(':userId', $_POST['userId']);
    $datos->bindParam(':editEmail', $_POST['editEmail']);
    $datos->bindParam(':editName', $_POST['editName']);
    $datos->bindParam(':editLastname', $_POST['editLastname']);
    $datos->bindParam(':editPassword', $_POST['editPassword']);
    $datos->bindParam(':editActive', $_POST['editActive']);
    $datos->bindParam(':editRole', $resultado['id_tipo_usuario'], PDO::PARAM_INT);

    try {
        $datos->execute();
    } catch (PDOException $e) {
        echo 'Error al ejecutar la consulta: '. $e->getMessage();
        exit;
    }

    $message= "Usuario editado correctamente";
    $_SESSION['message'] = $message;
    header("Location: informesAdministradorUsuario.php");
    exit;
}