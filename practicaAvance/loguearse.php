<?php
@session_start();
//Comprobamos que el usuario no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btEnviar'])) {
    if (usuarioExiste($_POST['username'],$_POST['password'] ) == true) {
        $_SESSION['username'] = $_POST['username'];
        header("Location: index.php");
    }else{       
        $message= "Los datos introducidos son incorrectos, por favor intentalo de nuevo."; 
        $_SESSION['errores'] =  $message;
        header("Location: login.php");
    }
}

function usuarioExiste($username, $password)
{
    $storage = "data.json";
    $stored_users = json_decode(file_get_contents($storage), true);
    foreach ($stored_users as $user) {
        if ($user["username"] == $username && $user["password"] == $password) {            
            return true;
        }
    }
    return false;
}
