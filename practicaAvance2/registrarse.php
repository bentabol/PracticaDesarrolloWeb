<?php
require 'config/conn.php';
@session_start();
$message = "";
if (isset($_POST['btEnviar'])) {
    if (usernameExists($_POST['username'], $_POST['email']) == false) {
        //Si no existe en bd se inserta
        $sql = "INSERT INTO bentatecnologies_usuarios (c_nickname, c_email, c_nombre, c_apellidos, c_password, n_idtipo_usuario) VALUES (:c_nickname, :c_email, :c_nombre, :c_apellidos, :c_password, :n_idtipo_usuario)";    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':c_nickname', $_POST['username']);
        $stmt->bindParam(':c_email', $_POST['email']);
        $stmt->bindParam(':c_nombre', $_POST['nombre']);
        $stmt->bindParam(':c_apellidos', $_POST['apellidos']);
        $stmt->bindParam(':c_password', $_POST['password']);
        $stmt->bindParam(':n_idtipo_usuario', $_POST['tipo']);

        if ($stmt->execute()) {
            $message = 'Usuario creado correctamente. ';
            header("Location: login.php");
        } else {
            $message = 'Lo sentimos, debe haber un problema al crear su cuenta o su cuenta ya existe. Porfavor, intentelo de nuevo.';
            header("Location: registro.php");
        }
       
    } else {
        $message = "El usuario ya existe, escoge otro.";
        header("Location: registro.php");
        
    }
    $_SESSION['errores'] =  $message;
    
}

function usernameExists($nickname, $email)
{
    require 'config/conn.php';
    //Comprobamos que el email no exista
    $datos = $conn->prepare('SELECT id_usuario FROM bentatecnologies_usuarios WHERE c_email = :email OR c_nickname = :nickname');
    $datos->bindParam(':email', $email);
    $datos->bindParam(':nickname', $nickname);
    $datos->execute();
    $resultados = $datos->fetch(PDO::FETCH_ASSOC);

    if ($resultados !== false && count($resultados) > 0) {
        return true;
    } else {
        return false;
    }
}
