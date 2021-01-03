<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/energie", name="admin_energie_")
 */
class EnergieController extends AbstractController
{
    /**
     * @Route("/", name="list", methods={"GET"})
     */
    public function list(): Response
    {
        return $this->json();
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Job $job): Response
    {
        return $this->json($job, 200, [], ['groups' => '']);
    }

    /**
     * @Route("/add", name="add", methods={"POST"})
     */
    public function add(): Response
    {
        return $this->json();
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"PUT", "PATCH"})
     */
    public function edit(): Response
    {
        return $this->json();
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(): Response
    {
        return $this->json();
    }
}
