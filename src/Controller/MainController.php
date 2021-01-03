<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\MarqueRepository;
use App\Repository\EnergieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main", methods={"GET"})
     */
    public function main(EnergieRepository $energieRepository, MarqueRepository $marqueRepository, UserRepository $userRepository): Response
    {
        $energies = $energieRepository->findAll();
        $marques = $marqueRepository->findAll();

        return $this->json([
            "energies" => $energies,
            "marques" => $marques,
            ],
            200,
            [], 
            ["groups" => "home"]
        );
    }
}
