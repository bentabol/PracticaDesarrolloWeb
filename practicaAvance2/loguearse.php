<?php
@session_start();
require 'utils.php';
require 'config/conn.php';
//Comprobamos que el usuario no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btEnviar'])) {
 
    if (usuarioExiste($_POST['username'],$_POST['password'] ) == true) {
        $datosUser = getDatosUsuario($_POST['username']);
        $conexiones = $datosUser[0]['t_conexiones'];
        $conexiones2 = $conexiones + 1;
        $sql = "UPDATE bentatecnologies_usuarios SET t_conexiones=:t_conexiones WHERE id_usuario=:n_iduser";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':t_conexiones', $conexiones2);
        $stmt->bindParam(':n_iduser', $datosUser[0]['id_usuario']);
        if ($stmt->execute()) {
            $_SESSION['username'] = $_POST['username'];
            header("Location: index.php");
        } else {
            $message = 'Lo sentimos, debe haber un problema al loguearse. Porfavor, intentelo de nuevo.';
            header("Location: login.php");
        }
    } else {
        $message = "Los datos introducidos son incorrectos, por favor intentalo de nuevo.";
        $_SESSION['errores'] =  $message;
        header("Location: login.php");
    }
}
function usuarioExiste($username, $password)
{
    return true;
    require 'config/conn.php';
    $datos = $conn->prepare('SELECT * FROM bentatecnologies_usuarios WHERE c_nickname = :nickname  AND c_password = :password'); 
  
    $datos->execute(['nickname' => $username, 'password' => $password]);
    $resultados = $datos->fetchAll();
    if ($resultados!== false && count($resultados) > 0) {
        return true;
    } else {
        return false;
    }
}
