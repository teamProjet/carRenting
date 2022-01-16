<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contract;
use App\Form\ReservationType;
use App\Form\ContractType;
use App\Repository\CarRepository;
use App\Repository\UserRepository;
use App\Entity\Car;
use App\Repository\ContractRepository;
use DateTimeImmutable;

class ReservationController extends AbstractController
{
    protected $requestStack;
    public function __construct(RequestStack $request)
    {
        $this->requestStack = $request;
    }
    

    #[Route('/reservation/{id}', name: 'reservation')]
    public function reservation(
        Request $request, 
        EntityManagerInterface $entityManager, 
        CarRepository $carRepository,
        $id
    ):Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        if($user->getNom())
        {
            $form = $this->createForm(ReservationType::class, $user);
            $form->handleRequest($request);
            
                if ($form->isSubmitted() && $form->isValid())
                {
                    if($this->checkNumberPhone($request->get('numeroPortable'))===false){
                        echo "le numéro de téléphone renseigné n'est pas correct.";
                    }elseif($this->checkNumberPermis($request->get('numeroPermisConduire')===false)){
                        echo"Le numéro de permis renseigné n'est pas valide";
                    }elseif($this->checkPostalCode($request->get('codePostal'))===false){
                        echo"Merci de renseigner un code postal valide";
                    }else{
                        $entityManager->persist($user);
                        $entityManager->flush();
                        return $this->redirectToRoute('creationContrat', ['id'=>$id]);
                    }  
                }
                return $this->render('reservation/index.html.twig', [
                    'form' => $form->createView(),
                ]);      
        }else {
            return $this->redirectToRoute('creationContrat', ['id'=>$id]);
        }      
    }



    #[Route('/creationContrat/{id}', name: 'creationContrat')]
    public function creationContrat(
        Request $request, 
        EntityManagerInterface $entityManager, 
        UserRepository $userRepository,
        CarRepository $carRepository,
        ContractRepository $calendar,
        $id
    ): Response
    {
        $user = $this->getUser();
        $contract = new Contract;
        $form = $this->createForm(ContractType::class, $contract);
        $form->handleRequest($request);

        $cars = $carRepository->findBy(["id"=> $id]);
        $carElt = new Car;
        $prix = 0;
        foreach ($cars as $car) {
            $carElt = $car;
            $prix = $car->getTarifJournee();
        }

        $events = $calendar->findby(["car"=> $id]);
        
        foreach($events as $event){
            $rdvs[] = [
                'numeroContrat' => $event->getNumeroContrat(),
                'debutContrat' => $event->getDebutContrat()->format('Y-m-d'),
                'finContrat' => $event->getFinContrat()->format('Y-m-d'),
            ];
        }
        $rdvs = [] ;
        $data = json_encode($rdvs);
        $data2 = json_decode($data);

        if ($form->isSubmitted() && $form->isValid()){
            $contract->setNumeroContrat(uniqid('ctrnum'));
            $contract->setEtatVehicule("Bon état");
            $contract->setCaution(200.00);
            $contract->setCar($carElt);
            $contract->setUser($user);
            $diff = date_diff($contract->getDebutContrat(), $contract->getFinContrat());
            $contract->setPrixLocation( $diff->d * $prix);

            $entityManager->persist($contract);
            $entityManager->flush();
            return $this->redirectToRoute('validation', ['id'=>$id]);
        }


        return $this->render('reservation/creationContrat.html.twig',  [
            'form' => $form->createView(),
            'data' => $data2,
        ]);   
    }

    #[Route('/validation/{id}', name: 'validation')]
    public function validation(
        Request $request, 
        UserRepository $userRepository,
        CarRepository $carRepository,
        ContractRepository $contractRepository,
        $id
    ): Response
    {
        $contractSearch = $contractRepository->findBy(array(),array('id'=>'DESC'),1,0);
        $contract = new Contract;
        foreach($contractSearch as $elt){
            $contract = $elt;
        }
        return $this->render('reservation/contratValide.html.twig', [
            'controller_name' => 'MemberPageController',
            "contract" => $contract
        ]);   
    }
    
    protected function checkNumberPhone($phone):bool
    {
        $regex = '#^0[6-7]{1}\d{8}$#'; 

    if( !preg_match( $regex, $phone ) || strlen($phone<10)) { 
        return false ;
       }  return true;
    
    }
    
    protected function isEmailExist(string $emailUser, UserRepository $userRepository):bool
    {
        $databaseEmail=$userRepository->findOneBy(['email' => $emailUser]);
        if(!empty($databaseEmail))
        {
            return true;
        }return false;
    }

    protected function checkNumberPermis($numeroPermis):bool
    {
        $numero=preg_match('@[0-9]@', $numeroPermis);
        if(strlen($numeroPermis)<12 ||strlen($numeroPermis)>12 || !$numero)
        {
            return false;
        }
                return true;
    }
    protected function checkPostalCode($codePostal):bool
    {
        $codePostal=preg_match('@[0-9]@', $codePostal);
        if(strlen($codePostal)!=5 || !$codePostal)
        {
            return false;
        }
                return true;
    }

    
           
}