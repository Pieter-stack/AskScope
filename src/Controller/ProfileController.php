<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserProfile;

class ProfileController extends AbstractController{

        
            /**
             **
             *@Route("/profile/{id}",name="profile_view")
             */

            public function viewProfile($id = null){//defualt id value

                $user = $this->getUser();
                 if($user == null){
                    return $this->redirectToRoute('app_login');
                 }

                //error handling when id is not supplied
                if($id==null){
                    return $this -> redirectToRoute('index');
                }
                //access the wildcard
                $user_id=(int) $id;
        
                //using the entity and doctrine to get your database data
                $user=$this->getDoctrine()
                    ->getRepository(UserProfile::class)
                    -> find ($user_id);
        
                //create a modal 
                $model=array("user" => $user);
                
        
                //identify a twig template
                $view='profile.html.twig';
        
        
           return $this->render($view, $model);
            }


            // public function connectionAction(Request $request) {
            //     $uname = $request->request->get('name');
            //     if($uname == $name){
            //         return $this -> redirectToRoute('index');
            //     }
 
                

                 
            // }



}


?>