<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

        
            /**
             **
             *@Route("/home",name="home")
             */

            public function Home(){

            $model = array();
            $view = 'home.html.twig';



            return $this->render($view,$model);


            }



}


?>