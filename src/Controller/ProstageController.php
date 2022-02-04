<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;
use App\Repository\StageRepository;

class ProstageController extends AbstractController
{
    public function index(StageRepository $stageRepository): Response
    {
        $stages = $stageRepository->findAll();

        return $this->render('prostage/index.html.twig',['stages'=>$stages]);
    }
    public function formations(FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findAll();
        return $this->render('prostage/formations.html.twig',['formations'=>$formations]);
    }
    public function entreprises(EntrepriseRepository $entrepriseRepository): Response
    {
        $entreprises = $entrepriseRepository->findAll();
        return $this->render('prostage/entreprises.html.twig',['entreprises'=>$entreprises]);
    }

    public function stages(Stage $stage): Response
    {
        return $this->render('prostage/stages.html.twig', [ 
            'stageCible'=>$stage
        ]);
    }

    public function stagesParEntreprise($id_entreprise,EntrepriseRepository $entrepriseRepository): Response
    {
        $entreprise = $entrepriseRepository->find($id_entreprise);
        return $this->render('prostage/stagesParEntreprise.html.twig', [
            'entrepriseCible'=>$entreprise
        ]);
    }

    /*  Ancienne Fonction
    public function stagesParFormation($id_formation, FormationRepository $formationRepository): Response
    {
        $formation = $formationRepository->find($id_formation);
        return $this->render('prostage/stagesParFormation.html.twig' , [
            'formationCible'=>$formation
        ]);
    }
    */

    public function stagesParEntreprise2($nom_entreprise): Response
    {
        $stages = $this->getDoctrine()->getRepository(Stage::class)->findStageParEntreprise($nom_entreprise);
        return $this->render('prostage/stagesParEntreprise2.html.twig' , [
            'nom_entreprise'=> $nom_entreprise]);
    }

    public function formulaireEntreprise(): Response
    {
        $entreprise = new Entreprise();
        $formulaireEntreprise = $this->createFormBuilder($entreprise)
        ->add('activite')
        ->add('adresse')
        ->add('nom')
        ->add('emailContact')
        ->getForm();
        $vueFormulaire = $formulaireEntreprise->createView();

        return $this->render('prostage/formulaireEntreprise.html.twig',['vueFormulaire'=>$vueFormulaire]);
    }
}
