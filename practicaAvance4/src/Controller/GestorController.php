<?php

namespace App\Controller;

use App\Entity\Proyecto;
use App\Entity\Solicitud;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Usuario;
use App\Repository\ProjectRepository;
use App\Repository\ReunionRepository;
use App\Repository\SolicitudesRepository;
use App\Repository\TareaRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @Route("/gestor")
 * 
 * @IsGranted("ROLE_GESTOR")
 */
class GestorController extends AbstractController
{
    private $requestStack;
    private $em;

    public function __construct(RequestStack $requestStack, ManagerRegistry $doctrine)
    {
        $this->requestStack = $requestStack;
        $this->em = $doctrine->getManager();
    }

    /**
     * @Route("/proyectos", methods={"GET"}, name="gestor-proyectos")
     */
    public function proyectos(ProjectRepository $projectRepository)
    {
        /** @var Usuario $user */
        $user = $this->getUser();
        $proyectos = $projectRepository->getMisProyectos($user->getid_usuario());

        return $this->render('gestor/proyectos.html.twig', ['proyectos' => $proyectos]);
    }

    /**
     * @Route("/usuarios", methods={"GET"}, name="informe-usuarios-gestor")
     */
    public function informeUsuarios(
        UserRepository $userRepository,
        ProjectRepository $projectRepository
    ) {

        /** @var Usuario $user */
        $user = $this->getUser();

        $usuarios = $userRepository->getParticipantesActivos();
        $proyectos = $projectRepository->getMisProyectos($user->getid_usuario());

        /** @var Usuario $usuario */
        foreach ($usuarios as $index => $usuario) {
            /** @var Proyecto $proyectoGestor */
            foreach ($proyectos as $proyectoGestor) {
                /** @var Solicitud $solicitud */
                foreach ($usuario->getSolicitudes() as $solicitud) {
                    //Si el usuario ya tiene una solicitud para algun proyecto del gestor lo eliminamos del array de resultados
                    if ($solicitud->getProyecto()->getid_proyecto() == $proyectoGestor->getid_proyecto()) {
                        unset($usuarios[$index]);
                    }
                }
            }
        }

        $viewData = [
            'usuarios' => $usuarios,
            'proyectos' => $proyectos
        ];

        return $this->render('gestor/usuarios.html.twig', $viewData);
    }

    /**
     * @Route("/solicitudes", methods={"GET"}, name="solicitudes-gestor")
     */
    public function solicitudes(SolicitudesRepository $solicitudesRepository)
    {
        /** @var Usuario $user */
        $user = $this->getUser();

        $viewData = ['solicitudes' => $solicitudesRepository->getSolicitudesGestor($user->getid_usuario())];

        return $this->render('gestor/solicitudes.html.twig', $viewData);
    }

    /**
     * @Route("/reuniones", methods={"GET"}, name="reuniones-gestor")
     */
    public function misReuniones(
        ReunionRepository $reunionRepository,
        UserRepository $userRepository,
        ProjectRepository $projectRepository
    ) {
        $reuniones = $reunionRepository->getReuniones($this->getUser());

        $viewData = [
            'reuniones' => $reuniones,
            'usuarios' => $userRepository->getUsersOrderActives(null, null, true), //Usuarios activos
            'proyectos' => $projectRepository->getMisProyectos($this->getUser())
        ];

        return $this->render('gestor/reuniones.html.twig', $viewData);
    }

    /**
     * @Route("/tareas", methods={"GET"}, name="tareas-gestor")
     */
    public function misTareas(
        TareaRepository $tareaRepository,
        UserRepository $userRepository,
        ProjectRepository $projectRepository
    ) {
        $tareas = $tareaRepository->getTareas($this->getUser());

        $viewData = [
            'tareas' => $tareas,
            'usuarios' => $userRepository->getUsersOrderActives(null, null, true), //Usuarios activos
            'proyectos' => $projectRepository->getMisProyectos($this->getUser())
        ];

        return $this->render('gestor/tareas.html.twig', $viewData);
    }
}
