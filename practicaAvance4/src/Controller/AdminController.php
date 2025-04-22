<?php

namespace App\Controller;

use App\Entity\TipoUsuario;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Usuario;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @Route("/admin")
 * 
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    private $requestStack;
    private $em;

    public function __construct(RequestStack $requestStack, ManagerRegistry $doctrine)
    {
        $this->requestStack = $requestStack;
        $this->em = $doctrine->getManager();
    }

    /**
     * @Route("/informe/usuarios", methods={"GET"}, name="informe-usuarios")
     */
    public function informeUsuarios(Request $request, UserRepository $userRepository)
    {
        $viewData = [
            'usuarios' => $userRepository->getUsersOrderActives()
        ];

        return $this->render('admin/informeUsuarios.html.twig', $viewData);
    }

    /**
     * @Route("/usuarios/{username}/change-status", methods={"POST"}, name="change-status")
     */
    public function changeStatus(string $username, UserRepository $userRepository)
    {
        /** @var Usuario $user */
        $user = $userRepository->findOneBy(['username' => $username]);
        $user->setI_activo(!$user->getI_activo());

        $this->em->persist($user);
        $this->em->flush();

        $this->addFlash('mensajes', $user->getI_activo() ? 'Usuario activado' : 'Usuario desactivado');

        return $this->redirectToRoute('informe-usuarios');
    }

    /**
     * @Route("/actualizar-usuario", methods={"POST"}, name="admin-modificar-usuario")
     */
    public function editar(Request $request)
    {
        $userRepository = $this->em->getRepository(Usuario::class);

        /** @var Usuario */
        $user = $userRepository->find($request->get("id"));

        if (!$user) {
            $this->addFlash('errores', 'No se encuentra el usuario');
        }

        $user->setUsername($request->get("username"));
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

        $this->addFlash('mensajes', 'Usuario editado');

        return $this->redirectToRoute('informe-usuarios');
    }
}
