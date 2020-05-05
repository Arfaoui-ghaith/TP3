<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use App\Repository\VilleRepository;
use App\Repository\DestinationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ville")
 */
class VilleController extends AbstractController
{
    /**
     * @Route("/", name="ville_index", methods={"GET"})
     */
    public function index(VilleRepository $villeRepository,DestinationRepository $DestinationRepository): Response
    {
        /*$entityManager = $this->getDoctrine()->getManager();
        $v1 = new Ville();
        $v2 = new Ville();
        $v3 = new Ville();
        $v4 = new Ville();
        $v5 = new Ville();
        $v6 = new Ville();
        $v7 = new Ville();
        $v8 = new Ville();
        $v9 = new Ville();
        $v10 = new Ville();
        $v11 = new Ville();
        $v12 = new Ville();
        $v13 = new Ville();

        $v1->setDesVille('Tunis')->setCodeVille('216_1')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'216']));
        $v2->setDesVille('Tozeur')->setCodeVille('216_2')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'216']));
        $v3->setDesVille('Sousse')->setCodeVille('216_3')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'216']));
        $v4->setDesVille('CasaBlanca')->setCodeVille('212_1')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'212']));
        $v5->setDesVille('Rabat')->setCodeVille('212_2')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'212']));
        $v6->setDesVille('Tanger')->setCodeVille('212_3')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'212']));
        $v7->setDesVille('Istamboul')->setCodeVille('20_1')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'20']));
        $v8->setDesVille('Ankara')->setCodeVille('20_2')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'20']));
        $v9->setDesVille('Caire')->setCodeVille('90_1')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'90']));
        $v10->setDesVille('Alexandrie')->setCodeVille('90_2')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'90']));
        $v11->setDesVille('hurghada')->setCodeVille('90_3')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'90']));
        $v12->setDesVille('Alger')->setCodeVille('213_1')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'213']));
        $v13->setDesVille('Oran')->setCodeVille('213_2')->setCodeDest($DestinationRepository->findOneBy(['code_dest'=>'213']));
       


        $entityManager->persist($v1);
        $entityManager->persist($v2);
        $entityManager->persist($v3);
        $entityManager->persist($v4);
        $entityManager->persist($v5);
        $entityManager->persist($v6);
        $entityManager->persist($v7);
        $entityManager->persist($v8);
        $entityManager->persist($v10);
        $entityManager->persist($v11);
        $entityManager->persist($v12);
        $entityManager->persist($v13);

        
        $entityManager->flush();*/

        return $this->render('ville/index.html.twig', [
            'villes' => $villeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ville_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ville = new Ville();
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ville);
            $entityManager->flush();

            return $this->redirectToRoute('ville_index');
        }

        return $this->render('ville/new.html.twig', [
            'ville' => $ville,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ville_show", methods={"GET"})
     */
    public function show(Ville $ville): Response
    {
        return $this->render('ville/show.html.twig', [
            'ville' => $ville,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ville_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ville $ville): Response
    {
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ville_index');
        }

        return $this->render('ville/edit.html.twig', [
            'ville' => $ville,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ville_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ville $ville): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ville->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ville);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ville_index');
    }
}
