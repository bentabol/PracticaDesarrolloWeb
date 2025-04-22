<?php

namespace App\Controller;

use App\Entity\Proyecto;
use App\Entity\Reunion;
use App\Entity\Solicitud;
use App\Entity\Tarea;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Usuario;
use App\Repository\ProjectRepository;
use App\Repository\TareaRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * @Route("/tareas")
 * 
 * @IsGranted("ROLE_CLIENTE")
 */
class TareaController extends AbstractController
{
    private $requestStack;
    private $em;

    public function __construct(RequestStack $requestStack, ManagerRegistry $doctrine)
    {
        $this->requestStack = $requestStack;
        $this->em = $doctrine->getManager();
    }

    /**
     * @IsGranted("ROLE_GESTOR")
     * 
     * @Route("/crear", methods={"POST"}, name="crear-tarea")
     */
    public function crearTarea(
        Request $request,
        UserRepository $userRepository,
        ProjectRepository $projectRepository
    ) {

        /** @var Usuario $user */
        $user = $this->getUser();

        $nombre = $request->get("nombre");
        $descripcion = $request->get("descripcion");
        $fechaInicio = $request->get("fechaInicio");
        $fechaFin = $request->get("fechaFin");
        $progreso = $request->get("progreso");
        $proyectoID = $request->get("proyecto");
        $participantesIds = $request->get("participantes", []);

        $tarea = new Tarea();
        $tarea->setNombre($nombre);
        $tarea->setDescripcion($descripcion);
        $tarea->setFechaInicio(new DateTime($fechaInicio));
        $tarea->setFechaFin(new DateTime($fechaFin));
        $tarea->setProgreso($progreso);
        $tarea->setCreador($user);

        $participantes = [
            $user
        ];
        /** @var Proyecto $proyecto */
        $proyecto = $projectRepository->find($proyectoID);
        $tarea->setProyecto($proyecto);

        //Recorremos todas las solicitudes aceptadas y agregamos a esos usuarios a la reunion (configuracion por defecto)
        /** @var Solicitud $solicitud */
        foreach ($proyecto->getSolicitudes() as $solicitud) {
            if ($solicitud->getstatus() == Solicitud::STATUS_ACEPTADO) {
                $participantes[] = $solicitud->getUsuario();
            }
        }

        $participantes[] = $proyecto->getUsuario();

        if (!empty($participantesIds)) {
            foreach ($participantesIds as $userId) {
                $participante = $userRepository->find($userId);

                if ($participante) {
                    $participantes[] = $participante;
                }
            }
        }

        if (!empty($participantes)) {
            $tarea->setParticipantes(array_unique($participantes));
        }

        $this->em->persist($tarea);
        $this->em->flush();

        $this->subirFicheros($tarea, $request->files->get('ficheros'));

        $this->addFlash("mensajes", "Tarea creada");

        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }

    private function subirFicheros(Tarea $tarea, $ficheros)
    {
        if (empty($ficheros)) {
            return;
        }

        $uploadsPath = $this->getParameter('kernel.project_dir') . '/public/archivosTareas/';
        $tmpUploadPath = "$uploadsPath/" . $tarea->getId() . "_tmp/";

        if (!file_exists($uploadsPath)) {
            mkdir($uploadsPath, 0777, true); // Crea la carpeta y sus padres si no existen
        }

        if (!file_exists($tmpUploadPath)) {
            mkdir($tmpUploadPath, 0777, true); // Crea la carpeta y sus padres si no existen
        }

        /** @var UploadedFile $file */
        foreach ($ficheros as  $file) {
            $newFilename = uniqid() . '.' . $file->guessExtension();

            try {
                $file->move(
                    $tmpUploadPath,
                    $newFilename
                );
            } catch (FileException $e) {
                $this->addFlash('errores', 'Hubo un problema al subir el archivo a la carpeta.');
            } catch (Exception $e) {
                $this->addFlash('errores', 'Hubo un problema al actualizar los ficheros de la tarea.');
            }
        }

        // Ruta y nombre del archivo ZIP final
        $nombreZip = uniqid() . '.zip';
        $rutaZip = $uploadsPath . $nombreZip;

        // Crear archivo ZIP
        $zip = new \ZipArchive();
        if ($zip->open($rutaZip, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            // Agregar archivos al ZIP
            $archivosTemporales = scandir($tmpUploadPath);
            foreach ($archivosTemporales as $archivoTemporal) {
                if ($archivoTemporal !== '.' && $archivoTemporal !== '..') {
                    $zip->addFile($tmpUploadPath . $archivoTemporal, $archivoTemporal);
                }
            }
            $zip->close();

            // Eliminar archivos temporales
            foreach ($archivosTemporales as $archivoTemporal) {
                if ($archivoTemporal !== '.' && $archivoTemporal !== '..') {
                    unlink($tmpUploadPath . $archivoTemporal);
                }
            }

            // Eliminar directorio temporal
            rmdir($tmpUploadPath);

            $tarea->setFichero($nombreZip);
            $this->em->persist($tarea);
            $this->em->flush();
        }
    }

    /**
     * @IsGranted("ROLE_GESTOR")
     * 
     * @Route("/{id}/borrar", methods={"POST"}, name="borrar-tarea")
     */
    public function borrar(
        $id,
        Request $request,
        TareaRepository $tareaRepository
    ) {

        /** @var Usuario $user */
        $user = $this->getUser();
        /** @var Reunion $reunion */
        $tarea = $tareaRepository->find($id);

        if ($user->getid_usuario() != $tarea->getCreador()->getid_usuario()) {
            $this->addFlash("errores", "No puedes borrar una tarea que no es tuya");
        } else {
            $this->em->remove($tarea);
            $this->em->flush();

            $this->addFlash("mensajes", "Tarea borrada");
        }

        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }

    /**
     * @Route("/{id}/descargar", methods={"GET", "POST"}, name="descargar-fichero-tarea")
     */
    public function descargar($id, Request $request, TareaRepository $tareaRepository)
    {
        $referer = $request->headers->get('referer'); //Obtenemos la pagina desde la que se está llamando al servicio
        /** @var Tarea $tarea */
        $tarea = $tareaRepository->find($id);


        if ($tarea->getFichero() != null) {
            $filePath = $this->getParameter('kernel.project_dir') . '/public/archivosTareas/' . $tarea->getFichero();

            if (!file_exists($filePath)) {
                $this->addFlash('errores', 'El fichero de la tarea no existe.');
                return $this->redirect($referer);
            }

            $response = new BinaryFileResponse($filePath);
            $response->setContentDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $tarea->getFichero()
            );

            return $response;
        } else {
            $this->addFlash('errores', 'La tarea no tiene archivos asociados.');
            return $this->redirect($referer);
        }
    }
}
