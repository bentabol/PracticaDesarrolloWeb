<?php
require 'config/conn.php';

$searchProyectName = $_POST['searchProyectName'];

$query = "SELECT * FROM bentatecnologies_proyectos ";
$query .= "WHERE bentatecnologies_proyectos.c_nombreProyecto LIKE :searchProyectName ";
$query .= "ORDER BY bentatecnologies_proyectos.c_nombreProyecto";

$datos = $conn->prepare($query);
$datos->execute(['searchProyectName' => '%' . $searchProyectName . '%']);
$actives = $datos->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($actives);