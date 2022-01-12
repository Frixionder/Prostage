<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Création d'un générateur de données FAKER
        $faker = Faker\Factory::create('fr_FR');

        /** CREATION DES FORMATIONS **/

        $listeFormations = array();
        $premierMot = array("Baccalauréat","Brevet","Diplôme","Doctorat","Master","Prepa");
        $deuxiemeMot = array("Technologique","Professionnel","Scientifique","Universitaire","Informatique");
        $troisiemeMot = array("de Programmation","de Danse","de Poterie","de BD","d'Art","de Dev Mobile","d'Escrime");

        /* Génération des formations */

        for($i=0;$i<20;$i++)
        {
            $premierTerme = $premierMot[$faker->numberBetween(0,count($premierMot)-1)];
            $deuxiemeTerme = $deuxiemeMot[$faker->numberBetween(0,count($deuxiemeMot)-1)];
            $troisiemeTerme = $troisiemeMot[$faker->numberBetween(0,count($troisiemeMot)-1)];

        $formation = new Formation();
        $formation->setLibelle($premierTerme." ".$deuxiemeTerme." ".$troisiemeTerme);
        array_push($listeFormations,$formation);
        $manager->persist($formation);

        }
        
        /** CREATION DES ENTREPRISES **/

        $listeActivites=array("Poterie",
        "Programmation",
        "Boulangerie",
        "E-Sport",
        "Developpement Web",
        "Psychanalyse",
        "Troubadour",
        "Saltimbanque",
        "Jongleur au chapeau au feu rouge",
        "Samurai");

        $listeEntreprises = array();

        /* Génération des entreprises */
        for($i=0;$i<10;$i++)
        {
            $nomEntreprise=$faker->company();

            $entreprise=new Entreprise();
            $entreprise->setNom($nomEntreprise." ".$faker->companySuffix());
            $entreprise->setActivite($listeActivites[$faker->numberBetween(0,count($listeActivites)-1)]);
            $entreprise->setAdresse($faker->address());
            $entreprise->setEmailContact("contact@".$nomEntreprise.".com");
            array_push($listeEntreprises,$entreprise);
            $manager->persist($entreprise);
        }

        /** CREATION DES STAGES **/

        /* Génération des stages */
        for($i=0;$i<100;$i++)
        {
            $listeTitresStages=array("Stage Poterie",
            "Atelier Pate à Modeler",
            "Stage Jardinerie",
            "Stage Programmation Objet",
            "Stage Game Design",
            "Stage Marathon",
            "Stage E-Sport",
            "Atelier Sieste",
            "Stage Symphonie et Opera");
            $formationAjoutee=$listeFormations[$faker->numberBetween(0,count($listeFormations)-1)];
            $stage = new Stage();
            $stage->setTitre($listeTitresStages[$faker->numberBetween(0,count($listeTitresStages)-1)]);
            $stage->setDescMission($faker->catchPhrase());
            $stage->setEntreprise($listeEntreprises[$faker->numberBetween(0,count($listeEntreprises)-1)]);
            $stage->addFormation($formationAjoutee);

            /*Ajout de plusieurs formation pour un même stage*/
            $nbDeFormations=$faker->numberBetween(0,count($listeFormations)-2);

            $listeFormationsAjoutees=array();
            for($j=0;$j<$nbDeFormations;$j++)
            {
                $estDejaAjoutee="false";
                $formationAAjouter=$faker->numberBetween(0,count($listeFormations)-1);

                //On vérifie si la formation n'a pas déjà été ajoutée
                for($k=0;$k<count($listeFormationsAjoutees);$k++)
                {
                    if($listeFormationsAjoutees[$k]==$formationAAjouter)
                    {
                        $estDejaAjoutee="true";
                    }
                }
                if($estDejaAjoutee=="false")
                {
                    array_push($listeFormationsAjoutees,$formationAAjouter);
                    $stage->addFormation($listeFormations[$formationAAjouter]);
                }
                else
                {
                    /*On réduit le compteur du nombre de formations
                    afin d'avoir le nombre souhaité car il est 
                    incrémenté même quand rien n'est ajouté*/
                    $j--;
                }
            }
            $manager->persist($stage);
        }
        $manager->flush();
    }
}
