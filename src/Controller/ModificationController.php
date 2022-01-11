<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ModificationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class ModificationController extends AbstractController
{   
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    #[Route('/modification{id}', name: 'modification')]
    public function modification( Request $request, 
    EntityManagerInterface $entityManager, 
    UserRepository $userRepository, 
    $email
   ): Response
    {   
        $user=new User;
        $userRepository=$userRepository->find($email);
        
        $form = $this->createForm(ModificationType::class, $email);
        $form->handleRequest($request);
             if ($form->isSubmitted() && $form->isValid())
            {
                
                            $password=$user->getPassword();
                            if ($this->checkPassword($password) != true)
                                {
                                    echo "le mot de passe n'est pas au format requis. Il doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre.";	
                                }else{
                                    $entityManager->persist($user);
                                    $entityManager->flush();
                                    
                                    }   
                        }
                    return $this->render('modification/index.html.twig', [
                        'form' => $form->createView()
                        
                    ]); 
                }
        protected function checkPassword($password):bool
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
