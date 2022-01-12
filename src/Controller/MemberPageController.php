<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function reservation(): Response
    {
        return $this->render('member_page/reservation.html.twig', [
            'controller_name' => 'MemberPageController',
        ]);
    }
}
