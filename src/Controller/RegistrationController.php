<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class RegistrationController extends AbstractController
{   protected $requestStack;
    public function __construct(RequestStack $request)
    {
        $this->requestStack = $request;
    }

    #[Route('/inscription', name: 'inscription')]

    public function inscription(
        Request $request, 
        EntityManagerInterface $entityManager, 
        UserRepository $userRepository, 
        UserPasswordHasherInterface $passwordHasher): Response
    {  
            $user = new User();
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);
                 if ($form->isSubmitted() && $form->isValid())
                {   //On vérifie que l'email n'exite pas déjà en base de donnée
                    if($this->isEmailExist($user->getEmail(), $userRepository)===false)
                        { 
                            $user->setRoles(["role" => 'ROLE_USER']);
                            $password=$user->getPassword();
                            $hashedPassword=$passwordHasher->hashPassword($user, $user->getPassword());
                            $user->setPassword($hashedPassword);
                            $entityManager->persist($user);
                            $entityManager->flush();
                                     
                            return $this->redirectToRoute('index');
                        }echo 'Il existe déjà un compte associé à cette adresse mail.';
                  
                
        }return $this->render('registration/index.html.twig', [
                'form' => $form->createView()
            ]); 
    }
    
  

     protected function isEmailExist(string $emailUser, UserRepository $userRepository):bool
    {
            $databaseEmail=$userRepository->findOneBy(['email' => $emailUser]);
            if(!empty($databaseEmail))
            {
                return true;
            }return false;
    }
 
}