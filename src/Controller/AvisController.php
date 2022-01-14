<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AvisRepository;
use App\Entity\Avis;
use App\Entity\User;
use App\Form\AvisType;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'avis')]
    public function newAvis(AvisRepository $avisRepository,Request $request , EntityManagerInterface $entityManager): Response
    {
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
            $entityManager->persist($avis);
            $entityManager->flush();
       }
       return $this->render('catalog/car.html.twig', [
        'avis_form' => $form->createView(),
        ]);
        // ...
        
    }
}