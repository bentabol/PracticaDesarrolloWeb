<?php

namespace App\Controller;

use App\Entity\Solicitud;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Usuario;
use App\Repository\ProjectRepository;
use App\Repository\SolicitudesRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @Route("/solicitud")
 * 
 * @IsGranted("ROLE_CLIENTE")
 */
class SolicitudController extends AbstractController
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
     * @Route("/gestor", methods={"POST"}, name="envio-solicitud-gestor")
     */
    public function envioSolicitudDesdeGestor(
        Request $request,
        SolicitudesRepository $solicitudesRepository,
        UserRepository $userRepository,
        ProjectRepository $projectRepository
    ) {
        $usuarioID = $request->get("usuario");
        $proyectoID = $request->get("proyecto");

        $usuario = $userRepository->find($usuarioID);
        $proyecto = $projectRepository->find($proyectoID);

        if (!$usuario) {
            $this->addFlash("errores", "El usuario no existe");
        } else if (!$proyecto) {
            $this->addFlash("errores", "El proyecto no existe");
        } else {
            $solicitudesRepository->addsolicitud($usuario, $proyecto, Solicitud::STATUS_PENDIENTE_USUARIO);
            $this->addFlash("mensajes", "Solicitud enviada");
        }

        return $this->redirectToRoute("informe-usuarios-gestor");
    }

    /**
     * @Route("/cliente", methods={"POST"}, name="envio-solicitud-participante")
     */
    public function envioSolicitudDesdeParticipante(
        Request $request,
        SolicitudesRepository $solicitudesRepository,
        ProjectRepository $projectRepository
    ) {
        /** @var Usuario $user */
        $participante = $this->getUser();

        $proyectoID = $request->get("proyecto");
        $proyecto = $projectRepository->find($proyectoID);

        if (!$proyecto) {
            $this->addFlash("errores", "El proyecto no existe");
        } else {
            $solicitudesRepository->addsolicitud($participante, $proyecto, Solicitud::STATUS_PENDIENTE_PROFESOR);
            $this->addFlash("mensajes", "Solicitud enviada");
        }

        return $this->redirectToRoute("usuario-buscador-proyectos");
    }

    /**
     * @IsGranted("ROLE_GESTOR")
     * 
     * @Route("/aceptar-solicitud-gestor", methods={"POST"}, name="solicitud-aceptar-gestor")
     */
    public function aceptarSolicitudPorGestor(
        Request $request,
        SolicitudesRepository $solicitudesRepository
    ) {
        $proyectoID = $request->get("proyecto");
        $usuarioID = $request->get("usuario");

        $solicitudesRepository->aceptarSolicitudUsuarioProyecto($usuarioID, $proyectoID);

        $this->addFlash("mensajes", "Solicitud aceptada");

        return $this->redirectToRoute("solicitudes-gestor");
    }

    /**
     * @Route("/aceptar-solicitud-usuario", methods={"POST"}, name="solicitud-aceptar-usuario")
     */
    public function aceptarSolicitudPorParticipante(
        Request $request,
        SolicitudesRepository $solicitudesRepository
    ) {
        $proyectoID = $request->get("proyecto");
        $usuarioID = $request->get("usuario");

        $solicitudesRepository->aceptarSolicitudUsuarioProyecto($usuarioID, $proyectoID);

        $this->addFlash("mensajes", "Solicitud aceptada");

        return $this->redirectToRoute("solicitudes-usuario");
    }
}
