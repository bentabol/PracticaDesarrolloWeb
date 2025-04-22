<?php require 'partials/header.php';

$proyects = getAllProyects();

// Ordenar proyectos por tamaño de proyecto en orden decreciente
usort($proyects, function($a, $b) {
    return $b['c_ruta_archivo'] <=> $a['c_ruta_archivo'];
});

$downloads = getInformesDescargas();
$tarea = getAllTareas();
$arrayUsers = getDatosUsuario($_SESSION['username']);
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
                          <th>ID USUARIO</th>                 
                        </tr>
                      </thead>
                      <tbody>";
                    foreach ($proyects as $proyecto) {
                        if ($proyecto['l_activoProyecto'] == 1) {
                            echo "<tr>   
                              <td>". $proyecto['id_proyecto']. "</td>
                              <td>". $proyecto['c_nombreProyecto']. "</td>
                              <td>". $proyecto['c_descripcionProyecto']. "</td>
                              <td>". $proyecto['c_responsableProyecto']. "</td>
                              <td>". $proyecto['f_fechaInicioProyecto']. "</td>
                              <td>". $proyecto['f_fechaFinProyecto']. "</td>
                              <td>". $proyecto['l_activoProyecto']. "</td>
                              <td>". $proyecto['c_ruta_archivo']. "</td>
                              <td>". $proyecto['n_idusuario']. "</td>    
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
                          <th>ID USUARIO</th>                 
                        </tr>
                      </thead>
                      <tbody>";
                    foreach ($proyects as $proyecto) {
                        if ($proyecto['l_activoProyecto'] == 0) {
                            echo "<tr>   
                              <td>". $proyecto['id_proyecto']. "</td>
                              <td>". $proyecto['c_nombreProyecto']. "</td>
                              <td>". $proyecto['c_descripcionProyecto']. "</td>
                              <td>". $proyecto['c_responsableProyecto']. "</td>
                              <td>". $proyecto['f_fechaInicioProyecto']. "</td>
                              <td>". $proyecto['f_fechaFinProyecto']. "</td>
                              <td>". $proyecto['l_activoProyecto']. "</td>
                              <td>". $proyecto['c_ruta_archivo']. "</td>
                              <td>". $proyecto['n_idusuario']. "</td>    
                            </tr>";
                        }
                    }?>
                </table>

                <table