<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Avis;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AvisFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<20;$i++)
        {
            $avis= new Avis;
            $avis->setNom("nom $i")
                ->setPrenom("prenom $i")
                ->setNote(4)
                ->setCommentaire("super $i")
                ->setDateCreation(new \DateTimeImmutable());
            

        $manager->persist($avis);
        }$manager->flush();
    }
        
}
