<?php 
require 'partials/header.php';
require 'config/conn.php';
require 'bootstrap.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\UserRepository;  
use model\Repository\ProyectRepository;
use model\Repository\InformesRepository; 
use model\Repository\TareaRepository;
use model\Repository\ReunionesRepository;


$UserRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_usuarios");
$ProyectRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_proyectos");
$InformesRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_informes");
$TareaRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_tarea");
$ReunionesRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_reuniones");


$activeUsers = $UserRepository->getUsersOrderActives();
$proyects = $ProyectRepository->getAllProyects();
$downloads = $InformesRepository->getInformesDescargas();
$arrayUsers = $UserRepository->getDatosUsuario($_SESSION['username']);
$getMisProyectos = $ProyectRepository->getMisProyectos($arrayUsers->getid_usuario());

?>
<?php if (!empty($_SESSION['errores'])) : ?>
  <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>
<span style="color:grey">Informes</span>
</div>
<div class="catalogo">
  <div class="Apps2">
    <div class="navApps2">
      <div class="tituloCatalogo">Informes de Gestor</div>
    </div>
    <div class="bodyApps3">
      <div class="topApps3">
        <br></br>
        <table class='informes2'>
          <caption>
            <h2>PROYECTOS</h2>
          </caption>
          <?php echo "<thead>
                        <tr>
                          <th>ID </th>
                          <th>FECHA </th>
                          <th>NOMBRE PROYECTO</th>
                          <th>DESCRIPCION</th>
                          <th>RESPONSABLE</th>
                        </tr>
                      </thead>
                      <tbody>";
          foreach ($getMisProyectos as $getMiProyectos) {
            $nick = getUserById($getMiProyectos->getN_idusuario());
            $appName = getAppNameById($getMiProyectos->getid_proyecto());
            echo "<tr>
                          <td>" . $getMiProyectos->getId_Proyecto() . "</td>
                          <td>" . $getMiProyectos->getF_fechaInicioProyecto() . "</td>
                          <td>" . $proyectName->getc_nombreProyecto() . "</td>
                          <td>" . $proyectName->getc_descripcionProyecto() . "</td>
                          <td>" . $nick->getc_nickname() . "</td>                          
                        </tr>";
          } ?>
        </table>

      </div>
    </div>
  </div>
</div>
</div>
<?php require 'partials/footer.php'; ?>