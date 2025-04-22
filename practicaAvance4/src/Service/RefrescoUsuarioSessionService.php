<?php

namespace App\Service;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class RefrescoUsuarioSessionService
{
    private $entityManager;
    private $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    public function refrescar()
    {
        $token = $this->tokenStorage->getToken();

        if ($token === null) {
            return;
        }

        $user = $token->getUser();

        if ($user instanceof Usuario) {
            $reloadedUser = $this->entityManager->getRepository(Usuario::class)->find($user->getid_usuario());

            if ($reloadedUser === null) {
                throw new UserNotFoundException(sprintf('Usuario con ID "%s" no encontrado.', $user->getid_usuario()));
            }

            $token->setUser($reloadedUser);
        }
    }
}
