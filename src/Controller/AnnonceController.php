<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonces", name="annonce_list", methods={"GET"})
     */
    public function list(AnnonceRepository $annonceRepository): Response
    {
        $annonces = $annonceRepository->findAll();

        return $this->json([
            'annonces' => $annonces,
            ],
            200, 
            [], 
            ["groups" => "annonces:list"]
        );
    }

    /**
     * @Route("/annonces/{id}", name="annonce_detail", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function detail(int $id, AnnonceRepository $annonceRepository): Response
    {
        $annonce = $annonceRepository->find($id);

        return $this->json([
            'annonce' => $annonce,
            ],
            200, 
            [], 
            ["groups" => "annonces:list"] 
        );
    }
}
