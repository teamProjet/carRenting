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


class ModificationController extends AbstractController
{
    #[Route('/modification', name: 'modification')]
    public function modification( Request $request, 
    EntityManagerInterface $entityManager, 
    UserRepository $userRepository, 
   ): Response
    {   $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
             if ($form->isSubmitted() && $form->isValid())
            {
                if($this->isEmailExist($user->getEmail(), $userRepository)===true)
                        {
                            $password=$user->getPassword();
                            if ($this->checkPassword($password) != true)
                                {
                                    echo "le mot de passe n'est pas au format requis. Il doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre.";	
                                }else{
                                    $entityManager->persist($user);
                                    $entityManager->flush();
                                    //return $this->redirectToRoute('home');
                                    }   
                        }
                    }return $this->render('modification/index.html.twig', [
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
        protected function isEmailExist(string $emailUser, UserRepository $userRepository):bool
        {
            $databaseEmail=$userRepository->findOneBy(['email' => $emailUser]);
            if(!empty($databaseEmail))
            {
                return true;
            }return false;
        }
      
}
