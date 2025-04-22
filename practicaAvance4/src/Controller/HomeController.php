<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_CLIENTE")
 */
class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home.html.twig');
    }
}
