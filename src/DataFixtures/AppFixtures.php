<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Stage;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Création d'un générateur de données FAKER
        $faker = Faker\Factory::create('fr_FR');


        $stage = new Stage();
        $stage->setTitre($faker->realText($maxNbChars = 250, $inderSize=2 ));
        $stage->addFormation("DUT Info");
        $stage->setDescMission("Développement d'un erp servant à la recherche et au suivi des stages");
        $stage->setEntreprise("AlphamediaBox");
        
        $manager->persist($stage);
        $stage->flush();
    }
}
