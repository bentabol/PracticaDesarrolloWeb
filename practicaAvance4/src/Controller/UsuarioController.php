<?php

namespace App\Controller;

use App\Entity\Proyecto;
use App\Entity\Solicitud;
use App\Entity\TipoUsuario;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Usuario;
use App\Repository\ProjectRepository;
use App\Repository\ReunionRepository;
use App\Repository\TareaRepository;
use App\Repository\TipoUsuarioRepository;
use App\Repository\UserRepository;
use App\Service\RefrescoUsuarioSessionService;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @Route("/usuario")
 * 
 * @IsGranted("ROLE_CLIENTE")
 */
class UsuarioController extends AbstractController
{
    private $requestStack;
    private $em;

    public function __construct(RequestStack $requestStack, ManagerRegistry $doctrine)
    {
        $this->requestStack = $requestStack;
        $this->em = $doctrine->getManager();
    }

    /**
     * @Route("/miPerfil", methods={"GET"}, name="miPerfil")
     */
    public function miPerfil()
    {
        return $this->render('usuario/perfil.html.twig');
    }

    /**
     * @Route("/", methods={"POST"}, name="crearUsuario")
     */
    public function crear(Request $request)
    {
        $user = new Usuario();
        $user->setUsername($request->get("username"));
        $user->setc_nombre($request->get("nombre"));
        $user->setc_apellidos($request->get("apellidos"));
        $user->setc_email($request->get("email"));
        $user->setPassword($request->get("password"));

        $this->em->persist($user);
        $this->em->flush();

        return $this->redirectToRoute('showLogin');
    }

    /**
     * @Route("/proyectos", methods={"GET"}, name="usuario-proyectos")
     */
    public function misProyectos(ProjectRepository $projectRepository)
    {
        $proyectos = $projectRepository->getMisProyectosUsuario($this->getUser());

        return $this->render('usuario/misProyectos.html.twig', ['proyectos' => $proyectos]);
    }

    /**
     * @Route("/reuniones", methods={"GET"}, name="reuniones-usuario")
     */
    public function misReuniones(
        ReunionRepository $reunionRepository,
        UserRepository $userRepository
    ) {
        $reuniones = $reunionRepository->getReuniones($this->getUser());

        $viewData = [
            'reuniones' => $reuniones,
            'usuarios' => $userRepository->getUsersOrderActives(null, null, true), //Usuarios activos
        ];

        return $this->render('usuario/reuniones.html.twig', $viewData);
    }

    /**
     * @Route("/tareas", methods={"GET"}, name="tareas-usuario")
     */
    public function misTareas(
        TareaRepository $tareaRepository
    ) {
        $tareas = $tareaRepository->getTareas($this->getUser());

        $viewData = [
            'tareas' => $tareas
        ];

        return $this->render('usuario/tareas.html.twig', $viewData);
    }

    /**
     * @IsGranted("ROLE_GESTOR")
     * 
     * @Route("/buscar", methods={"POST"}, name="buscar-usuarios")
     */
    public function buscarUsuarios(
        Request $request,
        UserRepository $userRepository,
        ProjectRepository $projectRepository
    ) {
        if ($this->isGranted("ROLE_ADMIN")) {
            $usuarios = $userRepository->getUsersOrderActives(
                $request->get("rol"),
                $request->get("username")
            );
        } else {
            /** @var Usuario $user */
            $user = $this->getUser();
            $proyectos = $projectRepository->getMisProyectos($user->getid_usuario());

            $usuarios = $userRepository->getParticipantesActivos(
                $request->get("username")
            );

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

            //Recreamos el array con los indices en orden,
            //Dado que en el caso de que se haya borrado alguno, habrá indices no consecutivos y no se serializa correctamente como un array json
            $usuarios = array_values($usuarios);
        }

        return $this->json($usuarios);
    }

    /**
     * @IsGranted("ROLE_GESTOR")
     * 
     * @Route("/obtenerPorId", methods={"POST"}, name="obtener-usuario-id")
     */
    public function obtenerUsuario(Request $request, UserRepository $userRepository)
    {
        $usuario = $userRepository->find($request->get("id"));

        return $this->json($usuario);
    }

    /**
     * @Route("/solicitudes", methods={"GET"}, name="solicitudes-usuario")
     */
    public function solicitudes()
    {
        /** @var Usuario $user */
        $user = $this->getUser();

        $viewData = ['solicitudes' => $user->getSolicitudes()];

        return $this->render('usuario/solicitudes.html.twig', $viewData);
    }

    /**
     * @Route("/{username}/editar", methods={"GET"}, name="showEditarUsuario")
     */
    public function showEditarUsuario(string $username)
    {
        $userRepository = $this->em->getRepository(Usuario::class);

        /** @var Usuario */
        $usuario = $userRepository->findOneBy([
            'username' => $username,
        ]);

        return $this->render('usuario/editarPerfil.html.twig', ['usuario' => $usuario]);
    }

    /**
     * @Route("/{username}", methods={"POST"}, name="editarUsuario")
     */
    public function editar(string $username, Request $request, RefrescoUsuarioSessionService $refreshUserService)
    {
        $userRepository = $this->em->getRepository(Usuario::class);

        /** @var Usuario */
        $user = $userRepository->findOneBy([
            'username' => $username,
        ]);

        $user->setc_nombre($request->get("nombre"));
        $user->setc_apellidos($request->get("apellidos"));
        $user->setc_email($request->get("email"));
        $user->setPassword($request->get("password"));

        if ($request->get("rol")) {
            /** @var TipoUsuarioRepository $rolRepository */
            $rolRepository = $this->em->getRepository(TipoUsuario::class);
            $rol = $rolRepository->find($request->get("rol"));

            $user->setTipoUsuario($rol);
        }

        $this->em->persist($user);
        $this->em->flush();

        $refreshUserService->refrescar();

        return $this->redirectToRoute('miPerfil');
    }
}
