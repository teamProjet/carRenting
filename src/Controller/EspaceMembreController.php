<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContractRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\EspaceMembreType;
use App\Repository\CarRepository;
use App\Repository\UserRepository;

class EspaceMembreController extends AbstractController
{   
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    #[Route('/espace/membre', name: 'espace_membre')]
        public function showAll(
        ContractRepository $contractRepository, 
        SessionInterface $session, 
        UserRepository $user,
        CarRepository $carRepository,
        ): Response
        {   //On vérifie que le user est connecté, sinon redirection vers le login
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $user = $this->getUser();
            //On récupère l'id du user et on va chercher dans la table contrat la FK du user correspondant
            $userId=$user->getId();
            $contract = $contractRepository->findBy(['user'=>$userId]);
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
            $id, 
            ):Response
        {
            // On cherche l'id du contrat à supprimer   
            $contractRepository=$contractRepository->find($id);
            //On crée le formulaire avec un bouton annuler ma réservation
            $form = $this->createForm(EspaceMembreType::class, $contractRepository);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $entityManager->remove($contractRepository);
                $entityManager->flush();
                $entityManager->persist($contractRepository);
                return new Response("La location à bien été annulée.");
                }
            return $this->render('espace_membre/supprimer.html.twig',[
            'session'  => $session,
            'form' => $form->createView(),
            'contract'=>$contractRepository,
            ]);
        }
}
