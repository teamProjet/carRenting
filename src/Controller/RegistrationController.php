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
                {
                    if($this->isEmailExist($user->getEmail(), $userRepository)===false)
                        {
                            $hashedPassword=$passwordHasher->hashPassword($user, $user->getPassword());
                            $user->setPassword($hashedPassword);

                            $user->setRoles(["role" => 'ROLE_USER']);

                            $password=$user->getPassword();
                            echo " password= $password";
                            if ($this->checkPassword($password) != true)
                                {
	                                //echo "le mot de passe n'est pas au format requis. Il doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre.";	
                                }else{
                                    $entityManager->persist($user);
                                    $entityManager->flush();
                                  
                                    }  
                            
                                    return $this->redirectToRoute('index');
                
                        }
            
            else{
                $userEmail=$user->getEmail();
                // echo " Le compte associé à l'adresse $userEmail existe déjà.";
            }
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
        protected function checkPassword($password)
            {
                        $uppercase = preg_match('@[A-Z]@', $password );
                        $lowercase = preg_match('@[a-z]@', $password);
                        $number    = preg_match('@[0-9]@', $password);

                    if(!$uppercase || !$lowercase || !$number)
                        {
                            return false;
                        }
                                return true;
                                 
            }
}