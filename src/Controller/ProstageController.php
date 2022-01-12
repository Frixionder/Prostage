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
        return $this->render('prostage/formations.html.twig');
    }
    public function entreprises(): Response
    {
        return $this->render('prostage/entreprises.html.twig');
    }
    public function stages($id): Response
    {
        return $this->render('prostage/stages.html.twig', [ 
            'id_stage' => $id
        ]);
    }
}
