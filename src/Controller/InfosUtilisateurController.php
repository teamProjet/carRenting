<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;



class InfosUtilisateurController extends AbstractController
{
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    
    #[Route('/infos/utilisateur', name: 'infos_utilisateur')]
    public function index(
    Request $request, 
    EntityManagerInterface $entityManager, 
    SessionInterface $session, 
    UserRepository $user,
    ): Response
    {
        //On vérifie que le user est connecté, sinon redirection vers le login
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $utilisateur=$user->getNom()
                         ->getPrenom()
                         ->getNumeroRue()
                         ->getNomdeRue()
                         ->getCodePostal()
                         ->getVille()
                         ->getNumeroPortable()
                         ->getNumeroPermisConduire();
        
        return $this->render('infos_utilisateur/index.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }
}
