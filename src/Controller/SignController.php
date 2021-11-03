<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SignController extends AbstractController{

        
            /**
             **
             *@Route("/signup",name="signup")
             */

            public function Login(){


                $user = $this->getUser();
                if($user == null){
                    return new RedirectResponse("/", Response::HTTP_SEE_OTHER);
                }

            $model = array();
            $view = 'signup.html.twig';



            return $this->render($view,$model);


            }



}


?>