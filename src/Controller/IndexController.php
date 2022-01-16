<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CarRepository;
use App\Entity\Car;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CarRepository $carRepository): Response
    {
        return $this->render('index/index.html.twig', [
            'cars' => $carRepository->findAll(),
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
