<?php

namespace App\Controller;

use App\Entity\Circuit;
use App\Form\Circuit1Type;
use App\Repository\CircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/circuit")
 */
class CircuitController extends AbstractController
{
    /**
     * @Route("/", name="circuit_index", methods={"GET"})
     */
    public function index(CircuitRepository $circuitRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        /*$c1 = new Circuit();
        $c2 = new Circuit();
        $c3 = new Circuit();
        $c4 = new Circuit();
        $c5 = new Circuit();
        $c6 = new Circuit();

        $c1->setCodeCircuit('été1_local')->setDesCircuit('Tunisie_été ')->setDureeCircuit('7');
        $c2->setCodeCircuit('été2_local')->setDesCircuit('Tunisie_été ')->setDureeCircuit('10');
        $c3->setCodeCircuit('été1_étranger')->setDesCircuit('Tunisie_été ')->setDureeCircuit('8');
        $c4->setCodeCircuit('été2_étranger')->setDesCircuit('Egypte_été ')->setDureeCircuit('10');
        $c5->setCodeCircuit('été3_étranger')->setDesCircuit('Maroc_été ')->setDureeCircuit('10');
        $c6->setCodeCircuit('Hiver1_local')->setDesCircuit('Tunisie_hiver ')->setDureeCircuit('10');

        $entityManager->persist($c1);
        $entityManager->persist($c2);
        $entityManager->persist($c3);
        $entityManager->persist($c4);
        $entityManager->persist($c5);
        $entityManager->persist($c6);
        $entityManager->flush();*/


        return $this->render('circuit/index.html.twig', [
            'circuits' => $circuitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="circuit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $circuit = new Circuit();
        $form = $this->createForm(Circuit1Type::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($circuit);
            $entityManager->flush();

            return $this->redirectToRoute('circuit_index');
        }

        return $this->render('circuit/new.html.twig', [
            'circuit' => $circuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circuit_show", methods={"GET"})
     */
    public function show(Circuit $circuit): Response
    {
        return $this->render('circuit/show.html.twig', [
            'circuit' => $circuit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="circuit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Circuit $circuit): Response
    {
        $form = $this->createForm(Circuit1Type::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('circuit_index');
        }

        return $this->render('circuit/edit.html.twig', [
            'circuit' => $circuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circuit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Circuit $circuit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$circuit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($circuit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('circuit_index');
    }
}
