<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    #[Route('/reg', name: 'registration')]
    public function registration(): Response
    {
        return $this->render('index/registration.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/con', name: 'connexion')]
    public function connexion(): Response
    {
        return $this->render('index/connexion.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
