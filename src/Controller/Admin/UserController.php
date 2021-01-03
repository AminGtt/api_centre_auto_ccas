<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @Route("/admin/user", name="admin_user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="list", methods={"GET"})
     */
    public function list(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->json(["Utilisateurs" => $users], 200, [], ["groups" => ["infos:user", "infos:user:admin"]]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->find($id);

        return $this->json(["Utilisateur" => $user], 200, [], ['groups' => ["infos:user", "infos:user:admin"]]);
    }

    /**
     * @Route("/add", name="add", methods={"POST"})
     */
    public function add(Request $request, UserPasswordEncoderInterface $passwordEncoder, DenormalizerInterface $denormalizer): Response
    {
        $user = new User;

        $json = json_decode($request->getContent(), true);

        $json['password'] = $passwordEncoder->encodePassword($user, $json['password']);

        $user = $denormalizer->denormalize($json, User::class, 'json');

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        
        return $this->json($user, 201, [], ["groups" => ["infos:user", "infos:user:admin"]]);
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"PUT", "PATCH"})
     */
    public function edit(User $user, Request $request): Response
    {
        return $this->json();
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(User $user): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->json(null, 204);
    }
}
