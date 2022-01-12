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

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CarRenting')
            ->setTranslationDomain('admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        yield MenuItem::section('Admin');
        yield MenuItem::linkToCrud('Car', 'fa-file-text', Car::class);
        yield MenuItem::linkToCrud('Contract', 'fa-file-text', Contract::class);
        yield MenuItem::linkToCrud('User', 'fa-file-text', User::class);
        yield MenuItem::linkToCrud('Avis', 'fa-file-text', Avis::class);
    }

    
}
