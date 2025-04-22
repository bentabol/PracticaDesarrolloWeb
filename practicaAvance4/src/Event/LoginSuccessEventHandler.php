<?php

namespace App\Event;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class LoginSuccessEventHandler
{
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function onLoginSuccess(LoginSuccessEvent $event)
    {
        $user = $event->getUser();

        if ($user instanceof Usuario) {
            $conexiones = $user->gett_conexiones();
            $conexiones++;
            $user->sett_conexiones($conexiones);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    }
}
