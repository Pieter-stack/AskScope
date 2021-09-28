<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsController extends AbstractController{

        
            /**
             **
             *@Route("/questions",name="questions")
             */

            public function Questions(){

            $model = array();
            $view = 'questions.html.twig';



            return $this->render($view,$model);


            }



}


?>