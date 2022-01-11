<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EspaceMembreController extends AbstractController
{
    #[Route('/espace/membre', name: 'espace_membre')]
    public function index(): Response
    {
        return $this->render('espace_membre/index.html.twig', [
            'controller_name' => 'EspaceMembreController',
        ]);
    }
}
