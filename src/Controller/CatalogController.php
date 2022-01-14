<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarRepository;
use App\Entity\Car;
use App\Repository\ContractRepository;

class CatalogController extends AbstractController
{
    #[Route('/{id}/show', name: 'catalog_show')]
    public function showCar(Car $car, ContractRepository $calendar,
    $id): Response
    {
        $events = $calendar->findby(["car"=> $id]);
        
        foreach($events as $event){
            $rdvs[] = [
                'numeroContrat' => $event->getNumeroContrat(),
                'debutContrat' => $event->getDebutContrat()->format('Y-m-d'),
                'finContrat' => $event->getFinContrat()->format('Y-m-d'),
            ];
        }
        $data = json_encode($rdvs);
        $data2 = json_decode($data);
        return $this->render('catalog/car.html.twig',[
            "car" => $car,
            'data' => $data2
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