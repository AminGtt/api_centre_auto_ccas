<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main", methods={"GET"})
     */
    public function main(AnnonceRepository $annonceRepository): Response
    {
        return $this->json([
            'annonces' => $annonceRepository->findAll(),
        ], 200);
    }
}
