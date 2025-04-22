<?php
@session_start();
//Comprobamos que el usuario no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btEnviar'])) {
    if (comprobarNameEmail($_POST['username'],$_POST['emailrec'] ) == true) {
        $password=comprobarNameEmail($_POST['username'],$_POST['emailrec'] );
        $_SESSION['password'] = "Su contraseña es:".$password;
        
    }else{       
        $message= "Los datos introducidos son incorrectos, por favor intentalo de nuevo."; 
        $_SESSION['errores'] =  $message;
        
    }
    header("Location: login.php");
}

function comprobarNameEmail($username,$email)
{
    $storage = "data.json";
    $stored_users = json_decode(file_get_contents($storage), true);
    foreach ($stored_users as $user) {
        if ($user["username"] == $username && $user["email"] == $email) {            
            $password=$user["password"];
            return $password;
        }
    }
    return false;
}

