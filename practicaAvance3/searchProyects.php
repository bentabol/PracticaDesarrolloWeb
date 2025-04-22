<?php
require 'config/conn.php';
require 'bootstrap.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\ProyectRepository;

$ProyectRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_proyectos");

$search_query = $_POST['search_query'];
$projects = $ProyectRepository->searchProjects($search_query);

echo "<table class='informes'>
  <caption>
    <h2>Search Results</h2>
  </caption>
  <thead>
    <tr>
      <th>ID PROYECTO</th>
      <th>NOMBRE PROYECTO</th>
      <th>DESCRIPCION PROYECTO</th>
      <th>RESPONSABLE PROYECTO</th>
      <th>FECHA INICIO</th>
      <th>FECHA FIN</th>
      <th>ACTIVO</th>
      <th>TAMAÑO DE PROYECTO(MB)</th>
      <th>ID USUARIO</th>
      <th>ACCIONES</th>
    </tr>
  </thead>
  <tbody>";
foreach ($projects as $project) {
    echo "<tr>
    <td>". $project->getid_proyecto(). "</td>
    <td>". $project->getc_nombreProyecto(). "</td>
    <td>". $project->getc_descripcionProyecto(). "</td>
    <td>". $project->getc_responsableProyecto(). "</td>
    <td>". $project->getf_fechaInicioProyecto()->format('Y-m-d'). "</td>
    <td>". $project->getf_fechaFinProyecto()->format('Y-m-d'). "</td>
    <td>". $project->geti_activoProyecto(). "</td>
    <td>". $project->getc_tamañoArchivo(). "</td>
    <td>". $project->getc_ruta_archivo(). "</td>
    <td>". $project->getn_idusuario()->getid_usuario(). "</td>
    <td>
    </td>
  </tr>";
}
echo "</tbody></table>";