<?php

namespace App\Controller;

use App\Entity\Proyecto;
use App\Entity\Reunion;
use App\Entity\Solicitud;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Usuario;
use App\Repository\ProjectRepository;
use App\Repository\ReunionRepository;
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
 * @Route("/reuniones")
 * 
 * @IsGranted("ROLE_CLIENTE")
 */
class ReunionController extends AbstractController
{
    private $requestStack;
    private $em;

    public function __construct(RequestStack $requestStack, ManagerRegistry $doctrine)
    {
        $this->requestStack = $requestStack;
        $this->em = $doctrine->getManager();
    }

    /**
     * 
     * @Route("/crear", methods={"POST"}, name="convocar-reunion")
     */
    public function convocarReunion(
        Request $request,
        UserRepository $userRepository,
        ProjectRepository $projectRepository
    ) {

        /** @var Usuario $user */
        $user = $this->getUser();

        $titulo = $request->get("titulo");
        $descripcion = $request->get("descripcion");
        $fecha = $request->get("fecha");
        $hora = $request->get("hora");
        $proyectoID = $request->get("proyecto");
        $participantesIds = $request->get("participantes", []);

        $reunion = new Reunion();
        $reunion->setTitulo($titulo);
        $reunion->setDescripcion($descripcion);
        $reunion->setFecha(new DateTime($fecha));
        $reunion->setHora($hora);
        $reunion->setCreador($user);

        $participantes = [
            $user
        ];
        if (!empty($proyectoID)) {
            /** @var Proyecto $proyecto */
            $proyecto = $projectRepository->find($proyectoID);
            $reunion->setProyecto($proyecto);

            //Recorremos todas las solicitudes aceptadas y agregamos a esos usuarios a la reunion (configuracion por defecto)
            /** @var Solicitud $solicitud */
            foreach ($proyecto->getSolicitudes() as $solicitud) {
                if ($solicitud->getstatus() == Solicitud::STATUS_ACEPTADO) {
                    $participantes[] = $solicitud->getUsuario();
                }
            }

            $participantes[] = $proyecto->getUsuario();
        }

        if (!empty($participantesIds)) {
            foreach ($participantesIds as $userId) {
                $participante = $userRepository->find($userId);

                if ($participante) {
                    $participantes[] = $participante;
                }
            }
        }

        if (!empty($participantes)) {
            $reunion->setParticipantes(array_unique($participantes));
        }

        $this->em->persist($reunion);
        $this->em->flush();

        $this->subirFicheros($reunion, $request->files->get('ficheros'));

        $this->addFlash("mensajes", "Reunion convocada");

        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }

    private function subirFicheros(Reunion $reunion, $ficheros)
    {
        if (empty($ficheros)) {
            return;
        }

        $uploadsPath = $this->getParameter('kernel.project_dir') . '/public/archivosReuniones/';
        $tmpUploadPath = "$uploadsPath/" . $reunion->getId() . "_tmp/";

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
                $this->addFlash('errores', 'Hubo un problema al actualizar los ficheros de la reunion.');
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

            $reunion->setFichero($nombreZip);
            $this->em->persist($reunion);
            $this->em->flush();
        }
    }

    /**
     * @Route("/{id}/borrar", methods={"POST"}, name="borrar-reunion")
     */
    public function borrar(
        $id,
        Request $request,
        ReunionRepository $reunionRepository
    ) {

        /** @var Usuario $user */
        $user = $this->getUser();
        /** @var Reunion $reunion */
        $reunion = $reunionRepository->find($id);

        if ($user->getid_usuario() != $reunion->getCreador()->getid_usuario()) {
            $this->addFlash("errores", "No puedes borrar una reunon que no es tuya");
        } else {
            $this->em->remove($reunion);
            $this->em->flush();

            $this->addFlash("mensajes", "Reunion borrada");
        }

        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }

    /**
     * @Route("/{id}/descargar", methods={"GET", "POST"}, name="descargar-fichero-reunion")
     */
    public function descargar($id, Request $request, ReunionRepository $reunionRepository)
    {
        $referer = $request->headers->get('referer'); //Obtenemos la pagina desde la que se está llamando al servicio
        /** @var Reunion $reunion */
        $reunion = $reunionRepository->find($id);


        if ($reunion->getFichero() != null) {
            $filePath = $this->getParameter('kernel.project_dir') . '/public/archivosReuniones/' . $reunion->getFichero();

            if (!file_exists($filePath)) {
                $this->addFlash('errores', 'El fichero de la reunion no existe.');
                return $this->redirect($referer);
            }

            $response = new BinaryFileResponse($filePath);
            $response->setContentDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $reunion->getFichero()
            );

            return $response;
        } else {
            $this->addFlash('errores', 'La reunion no tiene archivos asociados.');
            return $this->redirect($referer);
        }
    }
}
