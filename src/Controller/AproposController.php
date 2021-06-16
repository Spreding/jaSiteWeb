<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AproposController extends AbstractController
{
    /**
     * @Route("/a-propos", name="a-propos")
     */
    public function index(): Response
    {
        return $this->render('a-propos/index.html.twig', [
            'controller_name' => 'AproposController',
        ]);
    }
}
