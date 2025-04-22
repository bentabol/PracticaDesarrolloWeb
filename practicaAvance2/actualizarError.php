<?php
@session_start();
//Comprobamos que el usuario no existe, que los campos no están vacios, que el campo de email tenga el formato con una expresión regular.
if (isset($_POST['btValorar'])) {
    require 'config/conn.php';    
    $datos = $conn->prepare('UPDATE bentatecnologies_informes SET c_errores=:c_errores WHERE n_idproyecto=:n_idproyecto AND n_idusuario=:n_idusuario');
    $datos->bindParam(':n_idproyecto', $_POST['idProyecto']); 
    $datos->bindParam(':n_idusuario', $_POST['idUsuario']); 
    $datos->bindParam(':c_errores', $_POST['errores']);
    var_dump($_POST['idProyecto']); 
    var_dump($_POST['idUsuario']); 
    var_dump($_POST['errores']);       
    $datos->execute();
    $resultados = $datos->fetchAll(PDO::FETCH_ASSOC);

    $message = "Error registrado correctamente";
    $_SESSION['message'] =  $message;    
    header("Location: misProyectos.php");
}