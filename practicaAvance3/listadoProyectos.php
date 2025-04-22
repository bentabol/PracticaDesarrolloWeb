<?php 
require 'partials/header.php';
require 'config/conn.php';
require 'bootstrap.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\UserRepository;  
use model\Repository\ProyectRepository;  

$UserRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_usuarios");
$ProyectRepository = $em-> getRepository("\\Model\\Entity\\bentatecnologies_proyectos");

$dataProyectos = $ProyectRepository->getAllProyects();
$arrayUsers = $UserRepository->getDatosUsuario($_SESSION['username']); ?>

<?php if (!empty($_SESSION['errores'])) : ?>
    <h2> <?= $_SESSION['errores'] ?></h2>
<?php endif;
unset($_SESSION['errores']) ?>

?>
<style>
    table {
        border-collapse: collapse;
        width: 75%;
        margin-left: 15%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        background-color: white
    }

    th {
        background-color: #9999FF;
    }

    .active-projects-table {
        margin-bottom: 20px;
    }
    
    .btnDescargarProyecto {
    border-radius: 10px;
    padding: 5px 20px;
    margin: 0 20px;
    background-color: rgb(56, 214, 82);
    font-size: 10px;
    margin-left: 70px;

}
</style>
<header>
    <h1><FONT COLOR="white">-   Listado de Proyectos</FONT></h1>
</header>


<div class="containerCatalogo">
    <h2><center><FONT COLOR="white">Proyectos activos</FONT></center></h2>
    <table id="activeProyectosTable">
        <tr>
            <th>ID</th>
            <th>Nombre del Proyecto</th>
            <th>Descripcion del Proyecto</th>
            <th>Responsable del Proyecto</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
            <th>Estado</th>
            <th>Archivos</th>
        </tr>
        <?php
        foreach ($dataProyectos as $proyecto) {
            if (strtolower($proyecto['l_activoProyecto']) === 'activo') {
                echo '<tr>';
                echo '<td>' . $proyecto['proyectoId'] . '</td>';
                echo '<td>' . $proyecto['proyectoNombre'] . '</td>';
                echo '<td>' . $proyecto['proyectoDescripcion'] . '</td>';
                echo '<td>' . $proyecto['proyectoResponsable'] . '</td>';
                echo '<td>' . $proyecto['proyectoInicio'] . '</td>';
                echo '<td>' . $proyecto['proyectoFin'] . '</td>';
                echo '<td>' . $proyecto['proyectoArchive'] . '</td>';
                echo '<td>' . $proyecto['proyectoEstado'] . '</td>';
                echo "<td>
                            <div class='btnDescargarProyecto'>
                                <form name='nameForm' action='descargarProyecto.php' method='post'>
                                    <input type='hidden' name='idProyecto' value=" . $proyecto['proyectoId'] . "/>
                                    <input type='hidden' name='idUsuario' value=" . $arrayUsers[0]["id_usuario"] . "/>                                        
                                    <button type='submit' id='btEnviar' name='btDescargar'>Descargar</button>
                                </form>                                
                            </div>
                            <div class='btnDescargarProyecto'>
                                <form name='nameForm' action='reportarError.php' method='post'>
                                    <input type='hidden' name='idProyecto' value=" . $proyecto['proyectoId'] . " />
                                    <input type='hidden' name='idUsuario' value=" . $arrayUsers[0]["id_usuario"] . " />                                        
                                    <button type='submit' id='btEnviar' name='btReportar'>ReporarError</button>
                                </form>                                
                            </div>
                </td>";
                echo '</tr>';
            }
        }
        ?>
    </table>

    <h2><center><FONT COLOR="white">Proyectos inactivos</FONT></center></h2>
    <table id="inactiveProyectosTable">
        <tr>
            <th>ID</th>
            <th>Nombre del Proyecto</th>
            <th>Descripcion del Proyecto</th>
            <th>Responsable del Proyecto</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
            <th>Estado</th>
        </tr>
        <?php
        foreach ($dataProyectos as $proyecto) {
            if (strtolower($proyecto['l_activoProyecto']) === 'inactivo') {
                echo '<tr>';
                echo '<td>' . $proyecto['proyectoId'] . '</td>';
                echo '<td>' . $proyecto['proyectoNombre'] . '</td>';
                echo '<td>' . $proyecto['proyectoDescripcion'] . '</td>';
                echo '<td>' . $proyecto['proyectoResponsable'] . '</td>';
                echo '<td>' . $proyecto['proyectoInicio'] . '</td>';
                echo '<td>' . $proyecto['proyectoFin'] . '</td>';
                echo '<td>' . $proyecto['proyectoEstado'] . '</td>';
                echo '</tr>';
                
            }
        }
        ?>
    </table>
</div>
<br><br><br>
<?php
$storage = "dataTareas.json";
$rawdata = file_get_contents($storage);
$dataTareas = $rawdata ? json_decode($rawdata, true) : [];
?>
    <style>
        table {
            border-collapse: collapse;
            width: 75%;
            margin-left: 15%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            background-color: white
        }

        th {
            background-color: #9999FF;
        }

        .active-projects-table {
            margin-bottom: 20px;
        }
    </style>
    <header>
        <h1><FONT COLOR="white">-   Listado de Tareas</FONT></h1>
    </header>


    <div class="containerCatalogo">
        <h3><center><FONT COLOR="white">Tareas Pendientes</FONT></center></h3>
        <table id="pendienteTareasTable">
            <tr>
                <th>ID</th>
                <th>Nombre Tarea</th>
                <th>Descripcion Tarea</th>
                <th>Responsable Tarea</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Estado</th>
            </tr>
            <?php
            foreach ($dataTareas as $tarea) {
                if (strtolower($tarea['tareaEstado']) == 'pendiente') {
                    echo '<tr>';
                    echo '<td>' . $tarea['tareaId'] . '</td>';
                    echo '<td>' . $tarea['tareaNombre'] . '</td>';
                    echo '<td>' . $tarea['tareaDescripcion'] . '</td>';
                    echo '<td>' . $tarea['tareaResponsable'] . '</td>';
                    echo '<td>' . $tarea['tareaInicio'] . '</td>';
                    echo '<td>' . $tarea['tareaFin'] . '</td>';
                    echo '<td>' . $tarea['tareaEstado'] . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
                 <h3><center><FONT COLOR="white">Tareas Progreso</FONT></center></h3>
                <table id="progresoTareasTable">
            <tr>
                <th>ID</th>
                <th>Nombre Tarea</th>
                <th>Descripcion Tarea</th>
                <th>Responsable Tarea</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Estado</th>
            </tr>
            <?php
            foreach ($dataTareas as $tarea) {
                if (strtolower($tarea['tareaEstado']) == 'progreso') {
                    echo '<tr>';
                    echo '<td>' . $tarea['tareaId'] . '</td>';
                    echo '<td>' . $tarea['tareaNombre'] . '</td>';
                    echo '<td>' . $tarea['tareaDescripcion'] . '</td>';
                    echo '<td>' . $tarea['tareaResponsable'] . '</td>';
                    echo '<td>' . $tarea['tareaInicio'] . '</td>';
                    echo '<td>' . $tarea['tareaFin'] . '</td>';
                    echo '<td>' . $tarea['tareaEstado'] . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
                 <h3><center><FONT COLOR="white">Tareas Completas</FONT></center></h3>
                <table id="completaTareasTable">
            <tr>
                <th>ID</th>
                <th>Nombre Tarea</th>
                <th>Descripcion Tarea</th>
                <th>Responsable Tarea</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Estado</th>
            </tr>
            <?php
            foreach ($dataTareas as $tarea) {
                if (strtolower($tarea['tareaEstado']) == 'completa') {
                    echo '<tr>';
                    echo '<td>' . $tarea['tareaId'] . '</td>';
                    echo '<td>' . $tarea['tareaNombre'] . '</td>';
                    echo '<td>' . $tarea['tareaDescripcion'] . '</td>';
                    echo '<td>' . $tarea['tareaResponsable'] . '</td>';
                    echo '<td>' . $tarea['tareaInicio'] . '</td>';
                    echo '<td>' . $tarea['tareaFin'] . '</td>';
                    echo '<td>' . $tarea['tareaEstado'] . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>
    <br><br><br>
    <br><br><br>
<a><hr></a>
<div class="infoNosotros">
    <h2>
        <center>Tus gestores de confianza donde tus proyectos estan a salvo</center>
    </h2>
    <p class="infoWEB">Durante más de una década, BentaTec ha demostrado ser un lugar seguro y de confianza donde trabajar conjuntamente con tus proyectos se ha convertido en algo sencillo. Pero más que un simple escaparate, es un espacio innovador dedicado a ofrecerte grandes experiencias. Nos aseguramos de que los casi dos millones de aplicaciones disponibles cumplan los estándares más estrictos de privacidad, seguridad y contenido. Así puedes disfrutar de cada aplicación con toda confianza.</p>
    <p class="infoWEB">Nuestra plataforma está llena de historias y colecciones que te informan, ayudan e inspiran. Actualizamos constantemente el contenido para que siempre encuentres algo nuevo y relevante.</p>
</div>

<?php require 'partials/footer.php' ?>