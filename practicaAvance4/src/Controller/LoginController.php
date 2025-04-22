<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\TipoUsuarioRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    private $requestStack;
    private $em;

    public function __construct(RequestStack $requestStack, ManagerRegistry $doctrine)
    {
        $this->requestStack = $requestStack;
        $this->em = $doctrine->getManager();
    }

    /**
     * @Route("/", name="showLogin")
     */
    public function index(AuthenticationUtils $authenticationUtils)
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->redirectToRoute('home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="logout", methods={"POST", "GET"})
     */
    public function logout(): void
    {
    }

    /**
     * @Route("/registro", methods={"GET"}, name="showRegistro")
     */
    public function showRegistro(Request $request)
    {
        $viewData = [];
        $datosFormulario = $request->getSession()->getFlashBag()->get('formulario');

        if ($datosFormulario) {
            $viewData['datos'] = json_decode($datosFormulario);
        }

        return $this->render('registro.html.twig', $viewData);
    }

    /**
     * @Route("/registro", methods={"POST"}, name="registro")
     */
    public function registro(
        Request $request,
        UserRepository $userRepository,
        TipoUsuarioRepository $tipoUsuarioRepository
    ) {
        if (!$userRepository->usernameExists($request->get('username'), $request->get('email'))) {

            // //Validamos los datos
            // $errores  = $this->validarUsuario($request->request->all());

            // if (!empty($errores)) {
            //     foreach ($errores as $error) {
            //         $this->addFlash("errores", $error);
            //     }

            //     //Serializamos los datos del formulario para volverlos a mostrar en la vista
            //     $this->addFlash("formulario", json_encode($request->request->all()));

            //     return $this->redirectToRoute('showRegistro');
            // }

            $tipoUsuario = $tipoUsuarioRepository->find($request->get('tipo'));
            $userRepository->newUser(
                $request->get('username'),
                $request->get('email'),
                $request->get('nombre'),
                $request->get('apellidos'),
                $request->get('password'),
                $tipoUsuario
            );

            $this->addFlash("mensajes", "Usuario creado correctamente.");
            return $this->redirectToRoute('showLogin');
        } else {
            //Serializamos los datos del formulario para volverlos a mostrar en la vista
            $this->addFlash("formulario", json_encode($request->request->all()));
            $this->addFlash("errores", "El usuario ya existe, escoge otro.");
            return $this->redirectToRoute('showRegistro');
        }
    }

    private function validarUsuario(
        array $data
    ): array {
        $errores = [];

        if (empty($data['username'])) {
            $errores['Username no puede estar vacío'];
        }
        if (empty($data['email'])) {
            $errores['Email no puede estar vacío'];
        }
        if (empty($data['nombre'])) {
            $errores['Nombre no puede estar vacío'];
        }
        if (empty($data['tipo'])) {
            $errores['El tipo de usuario no puede estar vacío'];
        }
        if (empty($data['password'])) {
            $errores['La contraseña no puede estar vacía'];
        } elseif ($data['password'] != $data['password1']) {
            $errores['Las contraseñas no coinciden'];
        }
        return $errores;
    }
}
