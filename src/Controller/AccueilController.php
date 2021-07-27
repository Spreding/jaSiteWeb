<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Projet;
use Doctrine\DBAL\Types\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Validator\Constraints\Length;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        // FAIRE LE PHP ICI AVANT LE RETURN
        $projets = $this->getDoctrine()->getRepository(Projet::class)->findAll();
        $images = $this->getDoctrine()->getRepository(Images::class)->findAll();

        return $this->render('accueil/index.html.twig', [
            'projets' => $projets,
            'images' => $images
        ]);
    }

    /**
     * @Route("/getInfoProjet", name="getInfoProjet")
     */
    public function getInfoProjet(Request $request): Response
    {

        $test = $request->query->all();
        $id = htmlspecialchars($test['idprojet'], ENT_QUOTES, "UTF-8");
        $projet = $this->getDoctrine()->getRepository(Projet::class)->findOneBy(['id' => $id]);
        
        
        $response = $projet->ToJson();

        return new JsonResponse($response);

        
    }

    /**
     * @Route("/getInfoProjet/{id}", name="getInfoProjetTEST")
     */
    public function getInfoProjetTEST(Request $request , $id): Response
    {
        $projet = $this->getDoctrine()->getRepository(Projet::class)->findOneBy(['id' => $id]);



        $response = $projet->ToJson();

        return new JsonResponse($response);

        
    }
}
