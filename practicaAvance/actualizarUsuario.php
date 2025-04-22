<?php
@session_start();
//Comprobamos que el usuario no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btEnviar'])) {
    actualizarUsuario($_SESSION['username']);
    header("Location: usuario.php");
}

function actualizarUsuario($username)
{
    $storage = "data.json";
    $stored_users = json_decode(file_get_contents($storage), true);
    foreach ($stored_users as $clave => $user) {        
        if ($user["username"] === $username) {            
            $user2 = [
                'username' => $username,
                'email' => $_POST['email2'],
                'nombre' => $_POST['nombre2'],
                'apellidos' => $_POST['apellidos2'],
                'password' => $_POST['password2'],
                'rango' => $user['rango']
            ];  
            unset($stored_users[$clave]);    
        }             
    }
    $message = "Usuario editado correctamente";
    $_SESSION['message'] =  $message;
    
    array_push($stored_users, $user2);
    file_put_contents($storage, json_encode($stored_users, JSON_PRETTY_PRINT));
}
