<?php 
require 'partials/header.php';
require 'config/conn.php';
require 'bootstrap.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\UserRepository;  
use model\Repository\ProyectRepository;

$UserRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_usuarios");
$ProyectRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_proyectos");

$arrayUsers = $UserRepository->getDatosUsuario($_SESSION['username']);
//id users cogerlo de session
$misProyect = $ProyectRepository->getMisProyectos($_SESSION['idUsuario']); ?>

<?php if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>
<span style="color:grey">Mis Proyectos</span>
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
    .button {
        background-color: pink;
    }
</style>

<div class="InformesUser">
    <div class="Apps2">
        <div class="navApps2">
        </div>
        <div class="bodyApps2">
            <div class="topApps2">
                <br></br>
                <table>
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
                    foreach ($misProyect as $misProyects) {
                        if ($misProyects->geti_activoProyecto()==1) {
                        echo "<tr>   
                              <td>". $misProyects->getid_proyecto(). "</td>
                              <td>". $misProyects->getc_nombreProyecto(). "</td>
                              <td>". $misProyects->getc_descripcionProyecto(). "</td>
                              <td>". $misProyects->getc_responsableProyecto(). "</td>
                              <td>". $misProyects->getf_fechaInicioProyecto()->format('Y-m-d'). "</td>
                              <td>". $misProyects->getf_fechaFinProyecto()->format('Y-m-d'). "</td>
                              <td>". $misProyects->geti_activoProyecto(). "</td>
                              <td>". $misProyects->getc_tamañoArchivo(). "</td>
                              <td>". $misProyects->getc_ruta_archivo(). "</td>
                              <td>". $misProyects->getn_idusuario()->getid_usuario(). "</td>";
                        echo"<td>
                                  <td> <div>
                                        <form name='nameForm' action='descargarProyecto.php' method='post'>
                                            <input type='hidden' name='idProyecto' value=" . $misProyects->getid_proyecto() . "/>
                                            <input type='hidden' name='idUsuario' value=" . $arrayUsers->getid_usuario() . "/>                                        
                                            <button type='submit' id='btEnviar' name='btDescargar'>Descargar</button>
                                        </form>                                
                                    </div>
                                    <div>
                                        <form name='nameForm' action='reportarError.php' method='post'>
                                            <input type='hidden' name='idProyecto' value=" . $misProyects->getid_proyecto() . " />
                                            <input type='hidden' name='idUsuario' value=" . $arrayUsers->getid_usuario() . " />                                        
                                            <button type='submit' id='btEnviar' name='btReportar'>ReportarError</button>
                                        </form>                                
                                    </div>
                                </td>   
                        </tr>";
      
                        }
                    } ?>
                </table>
                <table>
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
                          <th>ARCHIVO DE PROYECTO</th>
                          <th>ID USUARIO</th>

                        </tr>
                      </thead>
                      <tbody>";
                    foreach ($misProyect as $misProyects) {
                        if ($misProyects->geti_activoProyecto()==0) {
                        echo "<tr>   
                              <td>". $misProyects->getid_proyecto(). "</td>
                              <td>". $misProyects->getc_nombreProyecto(). "</td>
                              <td>". $misProyects->getc_descripcionProyecto(). "</td>
                              <td>". $misProyects->getc_responsableProyecto(). "</td>
                              <td>". $misProyects->getf_fechaInicioProyecto()->format('Y-m-d'). "</td>
                              <td>". $misProyects->getf_fechaFinProyecto()->format('Y-m-d'). "</td>
                              <td>". $misProyects->geti_activoProyecto(). "</td>
                              <td>". $misProyects->getc_tamañoArchivo(). "</td>
                              <td>". $misProyects->getc_ruta_archivo(). "</td>
                              <td>". $misProyects->getn_idusuario()->getid_usuario(). "</td>";
                        echo"<td>
                                  <td> <div>
                                        <form name='nameForm' action='descargarProyecto.php' method='post'>
                                            <input type='hidden' name='idProyecto' value=" . $misProyects->getid_proyecto() . "/>
                                            <input type='hidden' name='idUsuario' value=" . $arrayUsers->getid_usuario() . "/>                                        
                                            <button type='submit' id='btEnviar' name='btDescargar'>Descargar</button>
                                        </form>                                
                                    </div>
                                    <div>
                                        <form name='nameForm' action='reportarError.php' method='post'>
                                            <input type='hidden' name='idProyecto' value=" . $misProyects->getid_proyecto() . " />
                                            <input type='hidden' name='idUsuario' value=" . $arrayUsers->getid_usuario() . " />                                        
                                            <button type='submit' id='btEnviar' name='btReportar'>ReportarError</button>
                                        </form>                                
                                    </div>
                                    
                                </td>   
                        </tr>";
      
                        }
                        
                       
                    } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require 'partials/footer.php'; ?>