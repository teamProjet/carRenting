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

class MemberPageController extends AbstractController
{
    #[Route('/member', name: 'member_page')]
    public function index(): Response
    {
        return $this->render('member_page/index.html.twig', [
            'controller_name' => 'MemberPageController',
        ]);
    }

    #[Route('/member/rate', name: 'memberRate_page')]
    public function rate(): Response
    {
        return $this->render('member_page/rate.html.twig', [
            'controller_name' => 'MemberPageController',
        ]);
    }

    #[Route('/member/update', name: 'memberUpdate_page')]
    public function update(): Response
    {
        return $this->render('member_page/update.html.twig', [
            'controller_name' => 'MemberPageController',
        ]);
    }

    #[Route('/member/reservation', name: 'memberReservation_page')]
    public function reservation(ContractRepository $contractRepository, 
    SessionInterface $session, 
    UserRepository $user,
    CarRepository $carRepository,): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $user = $this->getUser();
            //On récupère l'id du user et on va chercher dans la table contrat la FK du user correspondant
            $userId=$user->getId();
            $contract = $contractRepository->findBy(['user'=>$userId]);
        return $this->render('member_page/reservation.html.twig', [
            'controller_name' => 'MemberPageController',
            'contract' => $contract, 
        ]);
    }
}
