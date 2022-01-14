<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Contract;

class ContractFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<20;$i++)
        {
            $contract= new Contract;
            $contract->setNumeroContrat(1234567891)
                    ->setDebutContrat(new \DateTimeImmutable)
                    ->setFinContrat(new \DateTimeImmutable)
                    ->setEtatVehicule("Neuf")
                    ->setCaution(1200)
                    ->setPrixLocation(1200);

            $manager->persist($contract);
        }

      $manager->flush();
    }
}
