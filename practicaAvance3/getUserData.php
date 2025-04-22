<?php
require 'config/conn.php';
require 'bootstrap.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\UserRepository;

$UserRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_usuarios");

$idUsuario = isset($_POST['idUsuario']) ? intval($_POST['idUsuario']) : 0;
$userData = $UserRepository->getDatosUsuario($idUsuario);

header('Content-Type: application/json');
echo json_encode($userData);