<?php
require 'partials/header.php';
require 'config/conn.php';
require 'bootstrap.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\UserRepository;  
use model\Repository\ProyectRepository;
use model\Repository\TareaRepository;
use model\Repository\InformesRepository; $UserRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_usuarios");
$ProyectRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_proyectos");
//$TareaRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_tarea");
$InformesRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_informes");

$searchProyectName = isset($_POST['searchProyectName']) ? $_POST['searchProyectName'] : '';

if (!empty($searchProyectName)) {
    $activeProyectsQuery = $em->createQuery('
        SELECT p
        FROM Model\Entity\bentatecnologies_proyectos p
        WHERE p.c_nombreProyecto LIKE :searchProyectName
        ORDER BY p.c_nombreProyecto
    ');
    $activeProyectsQuery->setParameter('searchProyectName', '%' . $searchProyectName . '%');

    $activeProyects = $activeProyectsQuery->getResult();
} else {
    $activeProyects = $ProyectRepository->getAllProyects();
}

$downloads = $InformesRepository->getInformesDescargas();
$arrayUsers = $UserRepository->getDatosUsuario($_SESSION['username']);
?>

<form id="searchForm" method="post" action="">
    <center>
        <input type="text" name="searchProyectName" id="searchProyectName" placeholder="Buscar por nombre Proyecto">
        <button type="submit" name="search" value="Buscar">Buscar</button>
    </center>
</form>

<?php if (!empty($_SESSION['errores'])) :?>
    <h2> <?= $_SESSION['errores']?></h2>
<?php endif;
unset($_SESSION['errores'])?>

<span style="color:grey">Informes</span>

<style>
   .InformesUser {
        display: flex;
        justify-content: center;
        align-items: center;
        border: solid 1px white;
        background-color: #9999FF;
        border-radius: 5px;
        margin-left: 10%;
        margin-right: 10%;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .informes {
        text-align: center;
    }
</style>

<div class="InformesUser">
    <div>
        <div>
            <div class="tituloCatalogo">Buscador Proyectos</div>
        </div>
        <div>
            <div class="topApps3">
                <br></br>
               <table class='informes' id="tblProyectos">
                    <caption>
                        <h2>Informe proyectos Activos</h2>
                    </caption>
                    <?php echo "<thead>
                        <tr>
                          <th>ID PROYECTO</th>
                          <th>NOMBRE PROYECTO</th>
                          <th>DESCRIPCION PROYECTO</th>
                          <th>RESPONSABLE PROYECTO</th>
                          <th>FECHA INICIO</th>
                          <th>FECHA FIN</th>
                          <th>ACTIVO</th>
                          <th>TAMAÑO DE PROYECTO(MB)</th>
                          <th>ARCHIVO DE PROYECTO</th>
                          <th>ID USUARIO</th>                 
                        </tr>
                      </thead>
                      <tbody>";
                    foreach ($activeProyects as $proyecto) { 
                        if ($proyecto->geti_activoProyecto() == 1) {
                            echo "<tr>   
                              <td>". $proyecto->getid_proyecto(). "</td>
                              <td>". $proyecto->getc_nombreProyecto(). "</td>
                              <td>". $proyecto->getc_descripcionProyecto(). "</td>
                              <td>". $proyecto->getc_responsableProyecto(). "</td>
                              <td>". $proyecto->getf_fechaInicioProyecto()->format('Y-m-d'). "</td>
                              <td>". $proyecto->getf_fechaFinProyecto()->format('Y-m-d'). "</td>
                              <td>". $proyecto->geti_activoProyecto(). "</td>
                              <td>". $proyecto->getc_tamañoArchivo(). "</td>   
                              <td>". $proyecto->getc_ruta_archivo(). "</td>
                              <td>". $proyecto->getn_idusuario()->getid_usuario(). "</td>";
                            echo"<td>
                                  <td> 
                                    <div>
                                        <form name='nameForm' action='unirseProyecto.php' method='post'>
                                            <input type='hidden' name='idUsuario' value=" . $proyecto->getn_idusuario()->getid_usuario() . " />       
                                            <input type='hidden' name='idProyecto' value=" . $proyecto->getid_proyecto() . " />                                        
                                            <button type='submit' id='btEnviar' name='btUnirse'>Unirse Proyectos Gestor</button>
                                        </form>                                
                                    </div>
                                </td>   
                        </tr>";
                        }
                    }?>
                </table>

                <table class='informes' id="tblProyectos">
                    <caption>
                        <h2>Informe proyectos Inactivos</h2>
                    </caption>
                    <?php echo "<thead>
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
                        </tr>
                      </thead>
                      <tbody>";
                    foreach ($activeProyects as $proyecto) { 
                        if ($proyecto->geti_activoProyecto() == 0) {
                            echo "<tr>   
                              <td>". $proyecto->getid_proyecto(). "</td>
                              <td>". $proyecto->getc_nombreProyecto(). "</td>
                              <td>". $proyecto->getc_descripcionProyecto(). "</td>
                              <td>". $proyecto->getc_responsableProyecto(). "</td>
                              <td>". $proyecto->getf_fechaInicioProyecto()->format('Y-m-d'). "</td>
                              <td>". $proyecto->getf_fechaFinProyecto()->format('Y-m-d'). "</td>
                              <td>". $proyecto->geti_activoProyecto(). "</td>
                              <td>". $proyecto->getc_tamañoArchivo(). "</td>   
                              <td>". $proyecto->getc_ruta_archivo(). "</td>
                              <td>". $proyecto->getn_idusuario()->getid_usuario(). "</td>
                            
                        </tr>";
                        }
                    }?>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
  $('#searchForm').submit(function(e) {
    e.preventDefault();
    const searchProyectName = $('#searchProyectName').val();

    $.ajax({
        url: 'getProyectsActives.php', 
        type: 'POST',
        data: { searchProyectName: searchProyectName },
        success: function(response) {
            const proyects = JSON.parse(response);
            let html = '';

            if (proyects.length > 0) {
                proyects.forEach(proyect => {
                    html += `<tr>
                              <td>${proyect.id_proyecto}</td>
                              <td>${proyect.c_nombreProyecto}</td>
                              <td>${proyect.c_descripcionProyecto}</td>
                              <td>${proyect.c_responsableProyecto}</td>
                              <td>${proyect.f_fechaInicioProyecto}</td>
                              <td>${proyect.f_fechaFinProyecto}</td>
                              <td>${proyect.i_activoProyecto}</td>
                              <td>${proyect.c_tamañoArchivo}</td>
                              <td>${proyect.c_ruta_archivo}</td>
                              <td>
                                  <td> 
                                    <div>
                                        <form name='nameForm' action='unirseProyecto.php' method='post'>
                                            <input type='hidden' name='idProyecto' value=" . $proyecto->getid_proyecto() . " />
                                            <input type='hidden' name='idUsuario' value=" . $proyecto->getn_idusuario()->getid_usuario() . " />                                        
                                            <button type='submit' id='btEnviar' name='btUnirse'>Unirse Proyecto</button>
                                        </form>                                
                                    </div>
                                </td> 
                              <td>

                              </td>
                            </tr>`;
                });
            } else {
                html = '<tr><td colspan="10" align="center">No se encontraron proyectos con esos datos.</td></tr>';
            }

            $('#tblProyectos').html(html);
        }
    });
});
    
</script>