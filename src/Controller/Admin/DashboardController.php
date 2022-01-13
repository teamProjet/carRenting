<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\Contract;
use App\Entity\Avis;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Controller\Admin\CarCrudController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(CarCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Found My Car')
            ->setTranslationDomain('admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Administration', 'fa fa-home');
        
        yield MenuItem::section('Admin');
        yield MenuItem::linkToCrud('Car', 'fa-file-text', Car::class);
        yield MenuItem::linkToCrud('Contract', 'fa-file-text', Contract::class);
        yield MenuItem::linkToCrud('User', 'fa-file-text', User::class);
        yield MenuItem::linkToCrud('Avis', 'fa-file-text', Avis::class);
    }

    
}
