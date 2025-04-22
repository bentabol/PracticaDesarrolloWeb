
<?php
    require 'partials/header.php';
    require 'config/conn.php';
    require 'bootstrap.php';

    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\EntityManagerInterface;
    use model\Repository\UserRepository;  
    use model\Repository\ProyectRepository;
    use model\Repository\TareaRepository;
    use model\Repository\InformesRepository; 



    $UserRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_usuarios");
    $ProyectRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_proyectos");
    //$TareaRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_tarea");
    $InformesRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_informes");

    //$tarea = $TareaRepository->getAllTareas();
    $proyects = $ProyectRepository->getAllProyects();
        // Ordenar proyectos por tamaño de proyecto en orden decreciente
        usort($proyects, function($a, $b) {
            return $b->getc_tamañoArchivo() <=> $a->getc_tamañoArchivo();
        });
    $downloads = $InformesRepository->getInformesDescargas();
    $arrayUsers = $UserRepository->getDatosUsuario($_SESSION['username']);        
?>

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
</style>

<div class="InformesUser">
    <div>
        <div>
            <div class="tituloCatalogo">Informes de Administrador</div>
        </div>
        <div>
            <div class="topApps3">
                <br></br>
                <table class='informes'>
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
                          <th>ARCHIVOS DE PROYECTO</th>
                          <th>ID USUARIO</th>                 
                        </tr>
                      </thead>
                      <tbody>";
                    foreach ($proyects as $proyecto) {
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
                              <td>". $proyecto->getn_idusuario()->getid_usuario(). "</td>    
                            </tr>";
                        }
                    }?>
                </table>

                <table class='informes'>
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
                          <th>ARCHIVOS DE PROYECTO</th>
                          <th>ID USUARIO</th>                 
                        </tr>
                      </thead>
                      <tbody>";
                    foreach ($proyects as $proyecto) {
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

                <table