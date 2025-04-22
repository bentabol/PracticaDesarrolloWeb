<?php
require 'config/conn.php';
require 'bootstrap.php';
require 'utils.php';
use Doctrine\ORM\EntityManagerInterface;
use model\Repository\ProyectRepository;
use model\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

@session_start();
$message = "";
if (isset($_POST['btEnviarProyecto'])) {
    $ProyectRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_proyectos");
    $UserRepository = $em->getRepository("\\Model\\Entity\\bentatecnologies_usuarios");
    
    $proyectoArchive = $_FILES['proyectoArchive']['name'];
    if ($ProyectRepository->nombreProyectExists($_POST['proyectoNombre'])) {
                $message = "El proyecto ya existe, escoge otro.";
                header("Location: FormularioCreaEdiProyectos.php");
    } else {
            
            $proyectoInicio = DateTime::createFromFormat('Y-m-d',$_POST["proyectoInicio"]);
            $proyectoFin = DateTime::createFromFormat('Y-m-d',$_POST["proyectoFin"]);
            //Obtenemos algunos datos necesarios sobre el archivo del proyecto
            $tipoArchivo = $_FILES['proyectoArchive']['type'];
            $tamanoArchivo = $_FILES['proyectoArchive']['size'];
            $tempArchivo = $_FILES['proyectoArchive']['tmp_name'];

            if (move_uploaded_file($tempArchivo, 'archivosProyectos/' . $proyectoArchive)) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod('archivosProyectos/' . $proyectoArchive, 0777);
            }
            
            $userCreator=$UserRepository->getDatosUsuario($_SESSION['username']);        

            
            $datosProyect = $ProyectRepository->addProyect($_POST['proyectoNombre'], $_POST['proyectoDescripcion'], $_POST['proyectoResponsable'], $proyectoInicio, $proyectoFin, $_POST['proyectoEstado'], $_POST['tamañoArchivo'], 'archivosProyectos/' . $proyectoArchive, $userCreator);
               
            $message = 'Proyecto creado correctamente. ';
                header("Location: backofficeProyectos.php"); 
   
    }
}

