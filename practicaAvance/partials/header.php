<?php
@session_start(); //El @ evita que esta linea pinte los errores por pantalla. En este caso si la session se ha iniciado en otro archivo.
require 'utils.php';
if (!empty($_SESSION['username'])) {
    getDatosUsuario($_SESSION['username']);
    $arrayUsers = getDatosUsuario($_SESSION['username']);
}elseif(!isset($evitaRedireccion) || $evitaRedireccion == false) {
        header('Location: login.php');
} ?>

<?php if (!empty($_SESSION['message'])) : ?>
      <h2 style="text-align:center;color:green;"> <?= $_SESSION['message'] ?></h2>
    <?php endif; unset($_SESSION['message'])
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>https://www.BentaTecnologies.com</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

</head>

<body class="contenidoPagina">
    <header>
        <nav class="barra">
            <div class="principal"><a href="index.php"><img src="assets/LogoPagina.PNG" width="75" height="90"></a><img src="assets/BentaTecnologies.gif" width="375" height="90"></div>
            <div class="divisores">
                <a class="botones" href="login.php"><img src="assets/user.PNG" width="30" height="30">
                    <FONT COLOR="white" SIZE=4>Login</FONT>
                </a>
                <a class="botones" href="registro.php"><img src="assets/user.PNG" width="30" height="30">
                    <FONT COLOR="white" SIZE=4>Registro</FONT>
                </a>
                <?php if (!empty($_SESSION['username'])) {
                    echo "<a class='botones' href='usuario.php'><img src='assets/user.PNG' width='30' height='30'>
                    <FONT COLOR='white' SIZE=4>Mi Perfil</FONT></a>";
                } ?>
            
                <?php if (isset($arrayUsers)) {
                    if ($arrayUsers[5] == "Administrador" || $arrayUsers[5] == "Gestor") {
                        echo "<a class='botones' href='desarrollador.php'><img src='assets/user.PNG' width='30' height='30'>
                    <FONT COLOR='white' SIZE=4>Gestor</FONT></a>";
                    }
                } ?>
                
            </div>
        </nav>
    </header>
    <hr>
    <div class="dropdown">
        <button class="dropbtn"><img class="botonFiltro" src="assets/filtrado.png"><FONT COLOR='white'>Utilidades</FONT></button>
        <div class="dropdown-content">
            <a href="FormularioCreaEdiProyectos.php"><img class="filtrado" src="assets/editar.png"><span class="tabulacion">Formularios de proyectos</span></a>
            <a href="listadoProyectos.php"><img class="filtrado" src="assets/editar.png"><span class="tabulacion">Listado Proyectos</span></a>
            <a href="FormularioCreaEdiTareas.php"><img class="filtrado" src="assets/editar.png"><span class="tabulacion">Formularios Tareas</span></a>
                <a href="FormularioConvReunion.php"><img class="filtrado" src="assets/editar.png"><span class="tabulacion">Convocar Reunion</span></a>
        </div>
    </div>
    <a class="usuario" href="usuario.php"><?php if (!empty($_SESSION['username'])) : ?>
            <h2> USUARIO: <?= $_SESSION['username']
                            ?></h2><a class="usuario" href="logout.php">SALIR</a>
        <?php endif; ?>
    </a>