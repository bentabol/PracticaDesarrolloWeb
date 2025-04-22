<?php

namespace App\Controller;

use App\Entity\Proyecto;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * @Route("/proyectos")
 * 
 * @IsGranted("ROLE_CLIENTE")
 */
class ProyectoController extends AbstractController
{
    private $requestStack;
    private $em;

    public function __construct(RequestStack $requestStack, ManagerRegistry $doctrine)
    {
        $this->requestStack = $requestStack;
        $this->em = $doctrine->getManager();
    }

    /**
     * @Route(methods={"POST"}, name="buscar-proyectos")
     */
    public function buscarProyectos(ProjectRepository $projectRepository, Request $request): JsonResponse
    {
        $gestorFilter = $this->isGranted('ROLE_ADMIN') ? null : ($this->isGranted('ROLE_GESTOR') ? $this->getUser() : null);
        $participanteFilter = $this->isGranted('ROLE_GESTOR') ? null : $this->getUser();

        $proyectos = $projectRepository->getProyectosByFilter(
            $request->get('nombre'),
            (bool) $request->get('activo'),
            $participanteFilter,
            $gestorFilter,
        );

        return $this->json($proyectos);
    }

    /**
     * @IsGranted("ROLE_GESTOR")
     * 
     * @Route("/gestor", methods={"POST"}, name="gestor-proyectos-buscar")
     */
    public function buscarProyectosGestor(ProjectRepository $projectRepository, Request $request): JsonResponse
    {
        $proyectos = $projectRepository->getProyectosByFilter(
            $request->get('nombre'),
            $request->get('activo'),
            null,
            $this->getUser()
        );

        return $this->json($proyectos);
    }


    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin", methods={"GET"}, name="admin-proyectos")
     */
    public function proyectosAdmin(ProjectRepository $projectRepository)
    {
        $proyectos = $projectRepository->getAllProyects();

        return $this->render('admin/proyectos.html.twig', ['proyectos' => $proyectos]);
    }

    /**
     * @Route("/usuario", methods={"GET"}, name="usuario-buscador-proyectos")
     */
    public function proyectosCliente(ProjectRepository $projectRepository)
    {
        $proyectos = $projectRepository->getProyectosByFilter(
            null,
            true,
            $this->getUser()
        );

        return $this->render('usuario/proyectos.html.twig', ['proyectos' => $proyectos]);
    }

    /**
     * @Route("/{id}/descargar", methods={"GET", "POST"}, name="descargar-fichero")
     */
    public function descargar($id, Request $request, ProjectRepository $projectRepository)
    {
        $referer = $request->headers->get('referer'); //Obtenemos la pagina desde la que se está llamando al servicio
        $proyectUrl = $projectRepository->getUrlProyect($id);


        if ($proyectUrl != NULL) {
            $filePath = $this->getParameter('kernel.project_dir') . '/public/archivosProyectos/' . $proyectUrl;

            if (!file_exists($filePath)) {
                $this->addFlash('errores', 'El fichero de interés del proyecto no existe.');
                return $this->redirect($referer);
            }

            $response = new BinaryFileResponse($filePath);
            $response->setContentDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $proyectUrl
            );

            return $response;
        } else {
            $this->addFlash('errores', 'El proyecto no dispone de archivo.');
            return $this->redirect($referer);
        }
    }

    /**
     * @IsGranted("ROLE_GESTOR")
     * @Route("/upload", name="subir-fichero", methods={"POST"})
     */
    public function upload(Request $request, ProjectRepository $proyectoRepository)
    {
        $referer = $request->headers->get('referer'); //Obtenemos la pagina desde la que se está llamando al servicio
        /** @var UploadedFile $file */
        $file = $request->files->get('fichero');
        $proyectoId = $request->get('proyectoId');

        if ($file) {
            $newFilename = uniqid() . '.' . $file->guessExtension();
            $uploadsPath = $this->getParameter('kernel.project_dir') . '/public/archivosProyectos/';

            try {
                $file->move(
                    $uploadsPath,
                    $newFilename
                );

                // Obtener el tamaño del archivo en bytes
                $fileSizeBytes = $file->getSize();
                // Convertir el tamaño a megabytes
                $fileSizeMB = number_format($fileSizeBytes / 1048576, 2);

                $proyectoRepository->actualizarFichero($proyectoId, $newFilename, $fileSizeMB);

                $this->addFlash('mensajes', 'Archivo subido exitosamente.');
            } catch (FileException $e) {
                $this->addFlash('errores', 'Hubo un problema al subir el archivo a la carpeta.');
            } catch (Exception $e) {
                $this->addFlash('errores', 'Hubo un problema al actualizar el fichero del proyecto.');
            }
        } else {
            $this->addFlash('errores', 'El fichero es requerido.');
        }
        return $this->redirect($referer);
    }
}
