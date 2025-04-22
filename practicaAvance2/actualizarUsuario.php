<?php
@session_start();
//Comprobamos que el usuario no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btEnviar'])) {
    require 'config/conn.php';    
    $datos = $conn->prepare('UPDATE bentatecnologies_usuarios SET c_email=:c_email, c_nombre=:c_nombre, c_apellidos=:c_apellidos,c_password=:c_password WHERE c_nickname=:c_username');
    $datos->bindParam(':c_username', $_SESSION['username']);
    $datos->bindParam(':c_email', $_POST['email2']);
    $datos->bindParam(':c_nombre', $_POST['nombre2']);
    $datos->bindParam(':c_apellidos', $_POST['apellidos2']);
    $datos->bindParam(':c_password', $_POST['password2']);
    $datos->execute();
    $resultados = $datos->fetchAll(PDO::FETCH_ASSOC);
    
    $message = "Usuario editado correctamente";
    $_SESSION['message'] =  $message;    
    header("Location: usuario.php");
}