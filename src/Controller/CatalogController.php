<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarRepository;
use App\Entity\Car;
use App\Repository\AvisRepository;
use App\Entity\Avis;

class CatalogController extends AbstractController
{
    #[Route('/{id}/show', name: 'catalog_show')]
    public function showCar(carRepository $carRepository ,Avis $avis , AvisRepository $avisRepository , Car $car): Response
    {
        return $this->render('catalog/car.html.twig',[
            "car"=> $car,   
        ]);
    }
    #[Route('/catalog', name: 'catalog')]
    public function catalog(CarRepository $carRepository): Response
    {
        return $this->render('catalog/index.html.twig', [
            'cars' => $carRepository->findAll(),
        ]);
    }
}

