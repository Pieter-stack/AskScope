<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


    // //using the form 
    use App\Form\UserProfileType;
    //UserProfile entity 
    use App\Entity\UserProfile;

        // //using the form 
        use App\Form\QuestionType;
        //QuestionType entity 
        use App\Entity\Question;

                // //using the form 
                use App\Form\CommentType;
                //QuestionType entity 
                use App\Entity\Comment;



class HistoryController extends AbstractController{

        
            /**
             **
             *@Route("/history/{id}",name="history")
             */

            public function Admin(Request $request, $id = null){

                $user = $this->getUser();
                 if($user == null){
                    return $this->redirectToRoute('app_login');
                 }
                if($id == null){
                    return $this->redirectToRoute('home');
                }

                $access = $this->getUser()->getAccess();
                if($access !== 1){
                    return $this->redirectToRoute('app_login');
                }


                $history_id = (int) $id;

                $history=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                ->find($history_id);


            $model = array("history" => $history);
            $view = 'history.html.twig';



            return $this->render($view,$model);


            }



}


?>