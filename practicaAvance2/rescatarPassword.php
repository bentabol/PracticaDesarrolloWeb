<?php $evitaRedireccion = true;
@session_start();
//Comprobamos que el usuario no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btEnviar'])) {    
        $password=comprobarNameEmail($_POST['username'],$_POST['emailrec'] );
        $_SESSION['password'] = "Su contraseña es:".$password;       
        
    }else{       
        $message= "Los datos introducidos son incorrectos, por favor intentalo de nuevo."; 
        $_SESSION['errores'] =  $message;        
    }

    header("Location: login.php");

function comprobarNameEmail($nombreusuario,$correo)
{
    require 'config/conn.php';    
    $datos = $conn->prepare('SELECT c_password FROM bentatecnologies_usuarios WHERE c_nickname = :c_nickname AND c_email = :c_email');
    $datos->bindParam(':c_nickname', $nombreusuario);
    $datos->bindParam(':c_email', $correo);
    $datos->execute();
    $resultados = $datos->fetch(PDO::FETCH_ASSOC);    
    if ($resultados !== false && count($resultados) > 0) {  
       
        return $resultados['c_password'];
    } else {       
        return false;
    }
   
}

