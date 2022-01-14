<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarRepository;
use App\Entity\Car;
use App\Repository\AvisRepository;
use App\Entity\Avis;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AvisType;
use App\Repository\ContractRepository;

class CatalogController extends AbstractController
{
    #[Route('/catalog', name: 'catalog')]
    public function catalog(CarRepository $carRepository): Response
    {
        return $this->render('catalog/index.html.twig', [
            'cars' => $carRepository->findAll(),
        ]);
    }

    #[Route('/{id}/show', name: 'catalog_show')]
    public function showCarAndAvis(Car $car, ContractRepository $calendar, UserRepository $userRepository , CarRepository $carRepository , AvisRepository $avisRepository , $id, Request $request, EntityManagerInterface $entityManager): Response
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
      
        $avis1 = $avisRepository->findBy(['car'=>$id]);
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idUser = $user->getId(); 
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
       {
            $avis->setNom($user->getNom());
            $avis->setPrenom($user->getPrenom());
            $avis->setDateCreation(new \DateTimeImmutable('now'));
            $avis->setUser($user);
            $avis->setCar($car);
            $entityManager->persist($avis);
            $entityManager->flush();
       }
        
        return $this->render('catalog/car.html.twig',[
            "car" => $car,
            "avisCar"=>$avis1,  
            'avis_form' => $form->createView(),
            'data' => $data2
        ]);
    }
}