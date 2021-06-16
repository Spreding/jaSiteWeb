<?php

namespace App\Controller;

use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjetController extends AbstractController
{
    /**
     * @Route("/projet", name="projet")
     */

    public function index(): Response
    {
        $projets =$this->getDoctrine()->getRepository(Projet::class)->findAll();

        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
            'projets'=> $projets
        ]);
    }
}
