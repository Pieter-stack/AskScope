<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController{

        
            // /**
            //  **
            //  *@Route("/",name="index")
            //  */

            public function Login(){

                $user = $this->getUser();
                 if($user == null){
                    return $this->redirectToRoute('app_login');
                 }
 


                $model = array();
            $view = 'login.html.twig';



            return $this->render($view,$model);


            }



}


?>