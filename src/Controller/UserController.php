<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;




class UserController extends AbstractController {

    public $usersEmails = array("admin@admin.com");
    public $usersNames = array("admin admin");
    public $usersPasswords = array("admin123");
    public $usersPhones = array("14523589");
    public $table = array("admin admin","admin@admin.com","admin123","14523589");

/**
 * @Route("/")
 */
public function index(): Response
    {
        return $this->render('Pages/home.html.twig');
    }



    /**
     * @Route("/signup",name="signup")
     * @Method({"GET","POST"})
     */

     public function signup(Request $request){
        if ($request->isMethod('POST')) {

            $nom= $request->get("FirstName")." ".$request->get("LastName");
            $email= $request->get("email");
            $password= $request->get("Password");
            $phone= $request->get("Phone");

            if($nom != ""  && $email != ""  && $password != ""  )
            {

                return $this->redirectToRoute('signin',array('nom' => $nom,'email' => $email,'password' => $password,'phone'=>$phone));
            }



        }

        return $this->render('Pages/register.html.twig');


     }




    /**
     * @Route("/signin/{nom?}/{email?}/{password?}/{phone?}",name="signin")
     * @Method({"GET","POST"})
     */
    public function signin(Request $request,$nom,$email,$password,$phone){
        
        if ($request->isMethod('POST')) {

            $emaill= $request->get("email");
            $passwordd= $request->get("password");
            $order=0;

            if($emaill == $email && $passwordd = $password){
                return  $this->render('Pages/home.html.twig',array('nom' => $nom,'email' => $email,'password' => $password,'phone'=>$phone,"table" => $this->table));
            }

            foreach($this->usersEmails as $emails){
                if(($emaill == $emails) && ($this->usersPasswords[$order] == $passwordd)){
                    
                   return  $this->render('Pages/home.html.twig',array('nom' => $nom,'email' => $email,'password' => $password,'phone'=>$phone,"table" => $this->table));
                }
                $order=$order+1;
            }
        }
        return $this->render('Pages/login.html.twig');

    }

  

    

   



                
               

}


