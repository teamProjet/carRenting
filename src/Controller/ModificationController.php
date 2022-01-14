<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ModificationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;




class ModificationController extends AbstractController
{   
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    #[Route('/modification', name: 'modification')]
    public function modification( Request $request, 
    EntityManagerInterface $entityManager, 
    UserRepository $userRepository, 
    UserPasswordHasherInterface $passwordHasher
    ):Response
    {   
       
         //On vérifie que le user est connecté, sinon redirection vers le login
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $form = $this->createForm(ModificationType::class, $user);
        $form->handleRequest($request);
             if ($form->isSubmitted() && $form->isValid())
            {
                $password=$user->getPassword();
                
                    //Modifier le mot de passe dans la base de données
                                $hashedPassword=$passwordHasher->hashPassword($user, $user->getPassword());
                                $user->setPassword($hashedPassword);
                                $entityManager->persist($user);
                                $entityManager->flush();
                                return new Response("Votre mot de passe a été modifié avec succès.");
                         
            }
                        return $this->render('modification/index.html.twig', [
                            'form' => $form->createView()
                            
                        ]); 
    }
    protected function checkPassword($password)
    {
        $regex= preg_match("^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$^", $password );

        if(!$regex)
            {
                return false;
            }
            return true;
                                 
    } 
}
