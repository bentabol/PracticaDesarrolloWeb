<?php
require 'config/conn.php';
require 'bootstrap.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\ProyectRepository;

$ProyectRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_proyectos");

$id = $_GET['id'];
$proyecto = $ProyectRepository->findOneBy(['idProyecto' => $id]);

echo json_encode($proyecto);