<?php

namespace App\Controller;

use App\Entity\EtapeCircuit;
use App\Form\EtapeCircuit1Type;
use App\Repository\EtapeCircuitRepository;
use App\Repository\VilleRepository;
use App\Repository\CircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etape/circuit")
 */
class EtapeCircuitController extends AbstractController
{
    /**
     * @Route("/", name="etape_circuit_index", methods={"GET"})
     */
    public function index(EtapeCircuitRepository $etapeCircuitRepository,VilleRepository $VilleRepository,CircuitRepository $CircuitRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

       /* $e1 = new EtapeCircuit();
        $e2 = new EtapeCircuit();
        $e3 = new EtapeCircuit();
        $e4 = new EtapeCircuit();
        $e5 = new EtapeCircuit();
        $e6 = new EtapeCircuit();
        $e7 = new EtapeCircuit();
        $e8 = new EtapeCircuit();
        $e9 = new EtapeCircuit();

       $e1->setDureeEtape(2)->setOrdreEtape(1)
       ->setCodeCircuit($CircuitRepository->findOneBy(['code_circuit'=>'été1_local']))
       ->setCodeVille($VilleRepository->findOneBy(['des_ville'=>'Tunis']));
       $e2->setDureeEtape(5)->setOrdreEtape(2)
       ->setCodeCircuit($CircuitRepository->findOneBy(['code_circuit'=>'été1_local']))
       ->setCodeVille($VilleRepository->findOneBy(['des_ville'=>'Sousse']));
       $e3->setDureeEtape(5)->setOrdreEtape(1)
       ->setCodeCircuit($CircuitRepository->findOneBy(['code_circuit'=>'été2_local']))
       ->setCodeVille($VilleRepository->findOneBy(['des_ville'=>'Tunis']));
       $e4->setDureeEtape(5)->setOrdreEtape(2)
       ->setCodeCircuit($CircuitRepository->findOneBy(['code_circuit'=>'été2_local']))
       ->setCodeVille($VilleRepository->findOneBy(['des_ville'=>'Sousse']));
       $e5->setDureeEtape(3)->setOrdreEtape(1)
       ->setCodeCircuit($CircuitRepository->findOneBy(['code_circuit'=>'été1_étranger']))
       ->setCodeVille($VilleRepository->findOneBy(['des_ville'=>'Ankara']));
       $e6->setDureeEtape(5)->setOrdreEtape(2)
       ->setCodeCircuit($CircuitRepository->findOneBy(['code_circuit'=>'été1_étranger']))
       ->setCodeVille($VilleRepository->findOneBy(['des_ville'=>'Istamboul']));
       $e7->setDureeEtape(3)->setOrdreEtape(1)
       ->setCodeCircuit($CircuitRepository->findOneBy(['code_circuit'=>'été2_étranger']))
       ->setCodeVille($VilleRepository->findOneBy(['des_ville'=>'Caire']));
       $e8->setDureeEtape(3)->setOrdreEtape(2)
       ->setCodeCircuit($CircuitRepository->findOneBy(['code_circuit'=>'été2_étranger']))
       ->setCodeVille($VilleRepository->findOneBy(['des_ville'=>'Alexandrie']));
       $e9->setDureeEtape(4)->setOrdreEtape(3)
       ->setCodeCircuit($CircuitRepository->findOneBy(['code_circuit'=>'été2_étranger']))
       ->setCodeVille($VilleRepository->findOneBy(['des_ville'=>'hurghada']));
        


            $entityManager->persist($e1);
            $entityManager->persist($e2);
            $entityManager->persist($e3);
            $entityManager->persist($e4);
            $entityManager->persist($e5);
            $entityManager->persist($e6);
            $entityManager->persist($e7);
            $entityManager->persist($e8);
            $entityManager->persist($e9);
           
            $entityManager->flush();*/
        return $this->render('etape_circuit/index.html.twig', [
            'etape_circuits' => $etapeCircuitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etape_circuit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    { 
        
        $etapeCircuit = new EtapeCircuit();
        $form = $this->createForm(EtapeCircuit1Type::class, $etapeCircuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etapeCircuit);
            $entityManager->flush();

            return $this->redirectToRoute('etape_circuit_index');
        }

        return $this->render('etape_circuit/new.html.twig', [
            'etape_circuit' => $etapeCircuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{code_circuit}", name="etape_circuit_show", methods={"GET"})
     */
    public function show(EtapeCircuit $etapeCircuit): Response
    { dd($etapeCircuit);
        return $this->render('etape_circuit/show.html.twig', [
            'etape_circuit' => $etapeCircuit,
        ]);
    }

    /**
     * @Route("/{code_circuit}/edit", name="etape_circuit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EtapeCircuit $etapeCircuit): Response
    {
        $form = $this->createForm(EtapeCircuit1Type::class, $etapeCircuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etape_circuit_index');
        }

        return $this->render('etape_circuit/edit.html.twig', [
            'etape_circuit' => $etapeCircuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{code_circuit}", name="etape_circuit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EtapeCircuit $etapeCircuit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etapeCircuit->getCode_circuit(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etapeCircuit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etape_circuit_index');
    }
}
