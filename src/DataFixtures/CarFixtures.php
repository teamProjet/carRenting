<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Car;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<20;$i++)
        {
            $car= new Car;
            $car->setMarque("Voiture n°$i")
                ->setModele("Voiture n°$i")
                ->setImage("Voiture n°$i")
                ->setCouleur("Bleu $i")
                ->setImmatriculation("plaque n°$i")
                ->setAnnee("année $i")
                ->setKilometrage("kilometres $i")
                ->setTarifJournee(130,99)
                ->setEssence("essence $i")
                ->setDisponibilite(0)
                ->setCommentaire("commentaire n°$i");
        $manager->persist($car);
        }

        $manager->flush();
    }
}
