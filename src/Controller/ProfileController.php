<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
class ProfileController extends AbstractController{

        
            /**
             **
             *@Route("/profile/{id}",name="profile_view")
             */

            public function viewProfile($id = null){



                if($id == null){
                    return $this->redirectToRoute('index');
                }
    
                $userId = (int) $id;

                $armand = new User();
                $armand->setId(1);
                $armand->setName("Armand");
                $armand->setSurname("Pretorius");
                $armand->setEmail("Pretorius@gmail.com");
                
                $isla = new User();
                $isla->setId(2);
                $isla->setName("Isla");
                $isla->setSurname("Just");
                $isla->setEmail("Just@gmail.com");

                $hansin = new User();
                $hansin->setId(3);
                $hansin->setName("Hansin");
                $hansin->setSurname("Prema");
                $hansin->setEmail("Prema@gmail.com");


                $users = [$armand,$isla,$hansin];









            $model = array();
            $view = 'profile.html.twig';

            foreach ($users as $user){
                if ($userId === $user->getId()){
                    $model['user'] = $user;
                }

            }

            return $this->render($view,$model);


            }



}


?>