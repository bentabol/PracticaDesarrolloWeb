<?php
require 'config/conn.php';

$idUsuario = $_POST['idUsuario'];

// Get user data from the database
$stmt = $conn->prepare('SELECT * FROM bentatecnologies_usuarios WHERE id_usuario = :idUsuario');
$stmt->bindParam(':idUsuario', $idUsuario);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

// Output the user data as a JSON string
echo json_encode($userData);