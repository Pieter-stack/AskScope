<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HistoryController extends AbstractController{

        
            /**
             **
             *@Route("/history",name="history")
             */

            public function Admin(){

            $model = array();
            $view = 'history.html.twig';



            return $this->render($view,$model);


            }



}


?>