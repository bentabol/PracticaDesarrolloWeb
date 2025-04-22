<?php 
require 'partials/header.php';
require 'config/conn.php';
require 'bootstrap.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\UserRepository;  

$UserRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_usuarios");


?>
<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Rol</th>
    </tr>    
    <?php
    getDatosUsuario($_SESSION['username']);
    function getDatosUsuario($username)
    {
        $storage = "data.json";
        $stored_users = json_decode(file_get_contents($storage), true);
        echo "<tr>";
               
        foreach ($stored_users as $user) {
            if ($user["username"] == $username) {
                echo "<td>" . $user["username"]. "</td>";
                echo "<td>" . $user["email"] . "</td>";
                echo "<td>" . $user["nombre"] . "</td>";
                echo "<td>" . $user["rango"] . "</td>";
            }
        }echo "</tr></table>";
    }


    ?>


    <?php require 'partials/footer.php' ?>