<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Garage;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    /**
     * @Route("/profil/{id}", name="account_profil", methods={"GET"})
     */
    public function profil(int $id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        return $this->json($user, 200, [], [
            "groups" => "profil:user"
        ]);
    }

    /**
     * @Route("/infos/{id}", name="account_infos", methods={"GET"})
     */
    public function infos(int $id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        return $this->json($user, 200, [], [
            "groups" => "infos:user"
        ]);
    }

    /**
     * @Route("/ajout_garage", name="account_ajout_garage", methods={"POST"})
     */
    public function ajoutGarage(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $json = $request->getContent();

        $garage = $serializer->deserialize($json, Garage::class, 'json');

        // $em->persist($garage);
        // $em->flush();

        return $this->json($garage, 201, [], [
            'groups' => 'profil:user'
        ]);
    }

    /**
     * @Route("/ajout_annonce", name="account_ajout_annonce", methods={"POST"})
     */
    public function ajoutAnnonce(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $json = $request->getContent();

        $annonce = $serializer->deserialize($json, Annonce::class, 'json');

        // $em->persist($annonce);
        // $em->flush();

        return $this->json($annonce, 201, [], [
            'groups' => 'profil:user'
        ]);    }
}
