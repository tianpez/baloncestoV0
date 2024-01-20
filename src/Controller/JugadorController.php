<?php

namespace App\Controller;

use App\Entity\Jugador;
use App\Form\JugadorType;
use App\Repository\JugadorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/jugador')]
class JugadorController extends AbstractController
{
    #[Route('/', name: 'app_jugador_index', methods: ['GET'])]
    public function index(JugadorRepository $jugadorRepository): Response
    {
        return $this->render('jugador/index.html.twig', [
            'jugadors' => $jugadorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_jugador_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jugador = new Jugador();
        $form = $this->createForm(JugadorType::class, $jugador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jugador);
            $entityManager->flush();

            return $this->redirectToRoute('app_jugador_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('jugador/new.html.twig', [
            'jugador' => $jugador,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jugador_show', methods: ['GET'])]
    public function show(Jugador $jugador): Response
    {
        return $this->render('jugador/show.html.twig', [
            'jugador' => $jugador,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_jugador_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Jugador $jugador, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JugadorType::class, $jugador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_jugador_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('jugador/edit.html.twig', [
            'jugador' => $jugador,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jugador_delete', methods: ['POST'])]
    public function delete(Request $request, Jugador $jugador, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jugador->getId(), $request->request->get('_token'))) {
            $entityManager->remove($jugador);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_jugador_index', [], Response::HTTP_SEE_OTHER);
    }
}
