<?php
@session_start();
//Comprobamos que el usuario no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btEnviar'])) {
    if (usernameExists($_POST['username']) == false) {
        if ($_POST['username'])
            $user = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'password' => $_POST['password'],
                'rango' => $_POST['tipo']

            ];
        $storage = "data.json";
        $stored_users = json_decode(file_get_contents($storage), true);
        array_push($stored_users, $user);
        file_put_contents($storage, json_encode($stored_users, JSON_PRETTY_PRINT));
        header("Location: login.php");
    }else{       
        $message= "El usuario ya existe, escoge otro."; 
        $_SESSION['errores'] =  $message;
        header("Location: registro.php");
    }
}

function usernameExists($username)
{
    $storage = "data.json";
    $stored_users = json_decode(file_get_contents($storage), true);
    foreach ($stored_users as $clave => $user) {
        if ($user["username"] === $username) {            
            return true;
        }
    }
    return false;
}


