<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<20;$i++)
        {
            $user= new User;
            $user->setEmail("$i.mail.fr")
                ->setRoles(["role" => "ROLE_USER"])
                ->setPassword("password $i")
                ->setNom("nom $i")
                ->setPrenom("prenom $i")
                ->setNumeroRue("12")
                ->setNomdeRue("Rue $i")
                ->setCodePostal("12345")
                ->setVille("ville $i")
                ->setNumeroPortable("0987654321")
                ->setNumeroPermisConduire("1234567891");


            $manager->persist($user);
        }

        $manager->flush();
    }
}
