<?php
require 'config/conn.php';

$searchNickname = $_POST['searchNickname'];

$query = "SELECT * FROM bentatecnologies_usuarios ";
$query.= "INNER JOIN bentatecnologies_tipo_usuarios ON bentatecnologies_usuarios.n_idtipo_usuario = bentatecnologies_tipo_usuarios.id_tipo_usuario ";
$query.= "WHERE bentatecnologies_usuarios.c_nickname LIKE :searchNickname ";
$query.= "ORDER BY bentatecnologies_usuarios.c_nickname";

$datos = $conn->prepare($query);
$datos->execute(['searchNickname' => '%'. $searchNickname. '%']);
$actives = $datos->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($actives);
?>