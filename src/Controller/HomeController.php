<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserProfileType;
use App\Entity\UserProfile;
use App\Form\QuestionType;
use App\Entity\Question;

class HomeController extends AbstractController{

        
            /**
             **
             *@Route("/home_old",name="home_old")
             */

            public function Home(Request $request){

              $user = $this->getUser();
              if($user == null){
                return $this->redirectToRoute('app_login');
              }


                 $user = $this->getUser();

               //  //if user = 1 then ...

               //  // $username = $this->getUser()->getEmail();
                 $session = $request->getSession()->get(Security::LAST_USERNAME);
               //  // $user = $sessio;


  
                

            $model = array();
         //    //TODO user access stuur as model
         //    //dan in twig 
         //    // {{ if access == 1 }}
             //button hier
         // // {{ endif }}
             $view = 'home.html.twig';



             return $this->render($view,$model);


            }



}


?>