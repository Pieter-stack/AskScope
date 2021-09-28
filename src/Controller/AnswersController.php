<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnswersController extends AbstractController{

        
            /**
             **
             *@Route("/answers",name="answers")
             */

            public function Answers(){

            $model = array();
            $view = 'answers.html.twig';



            return $this->render($view,$model);


            }



}


?>