<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProstageController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('prostage/index.html.twig');
    }
    public function formations(): Response
    {
        return $this->render('prostage/formations.html.twig');
    }
    public function entreprises(): Response
    {
        return $this->render('prostage/entreprises.html.twig');
    }
    public function stages(): Response
    {
        return $this->render('prostage/stages.html.twig');
    }
}
