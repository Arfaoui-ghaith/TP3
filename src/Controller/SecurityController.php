<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/signup", name="inscription")
     */
    public function signup(Request $request, UserPasswordEncoderInterface $encoder) {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();

            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('login');
        }
        

        return $this->render('Pages/register.html.twig',[
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/signin", name="login")
     */
    public function Signin(){
        
        return $this->render('Pages/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="logout")
     */

    public function logout(){}

    /**
     * @Route("/NotFound", name="404")
     */

    public function notfound(){
        return $this->render('Pages/404.html.twig');
    }
}
