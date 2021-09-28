<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController{

        
            /**
             **
             *@Route("/admin",name="admin")
             */

            public function Admin(){

            $model = array();
            $view = 'admin.html.twig';



            return $this->render($view,$model);


            }



}


?>