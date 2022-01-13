<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;

class ProstageController extends AbstractController
{
    public function index(): Response
    {
        $stages = $this->getDoctrine()->getRepository(Stage::class)->findAll();

        return $this->render('prostage/index.html.twig',['stages'=>$stages]);
    }
    public function formations(): Response
    {
        $formations = $this->getDoctrine()->getRepository(Formation::class)->findAll();
        return $this->render('prostage/formations.html.twig',['formations'=>$formations]);
    }
    public function entreprises(): Response
    {
        $entreprises = $this->getDoctrine()->getRepository(Entreprise::class)->findAll();
        return $this->render('prostage/entreprises.html.twig',['entreprises'=>$entreprises]);
    }

    public function stages($id): Response
    {
        $stage = $this->getDoctrine()->getRepository(Stage::class)->find($id);
        return $this->render('prostage/stages.html.twig', [ 
            'stageCible'=>$stage
        ]);
    }

    public function stagesParEntreprise(): Response
    {
        
        return $this->render('prostage/stagesParEntreprise.html.twig');
    }

    public function stagesParFormation(): Response
    {
        
        return $this->render('prostage/stagesParFormation.html.twig');
    }

    public function entrepriseProposantStage(): Response
    {
        
        return $this->render('prostage/entrepriseProposantStages.html.twig');
    }

    public function formationProposantStage(): Response
    {
        
        return $this->render('prostage/formationProposantStage.html.twig');
    }
}
