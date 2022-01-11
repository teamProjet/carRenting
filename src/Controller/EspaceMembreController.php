<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContractRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Contract;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\EspaceMembreType;
use App\Repository\CarRepository;

class EspaceMembreController extends AbstractController
{   
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    #[Route('/espace/membre', name: 'espace_membre')]
   
    public function showAll(ContractRepository $contract, SessionInterface $session): Response
    { 
        $contract = $contract->findAll();
    
        return $this->render('espace_membre/index.html.twig',[
            'contract' => $contract,
           
            'session' => $session
        ]);
    }
   
    #[Route('/supprimer/{id}', name: 'supprimer')]
   
    public function delete(
        Request $request, 
        EntityManagerInterface $entityManager, 
        SessionInterface $session, 
        ContractRepository $contractRepository, 
        CarRepository $car, $id, 
        ):Response
    {
        
       $contractRepository=$contractRepository->find($id);
       $car = $car->findBy(['relation' => $id]);
       echo $car;
       $form = $this->createForm(EspaceMembreType::class, $contractRepository);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            $entityManager->remove($contractRepository);
            $entityManager->flush();
            $entityManager->persist($contractRepository);
            return new Response("La location à bien été annulée.");
        }return $this->render('espace_membre/supprimer.html.twig',[
            'session'  => $session,
            'form' => $form->createView(),
            'contract'=>$contractRepository,
            'car'=>$car
            
        ]);
    }
}
