<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserProfileRepository;


use App\Entity\UserProfile;
use App\Form\UserProfileType;

use App\Entity\Question;
use App\Form\QuestionType;
use App\Entity\Comment;
use App\Form\CommentType;

class AnswersController extends AbstractController{

        
            /**
             **
             *@Route("/answers/{id}",name="answers")
             */

            public function Answers(Request $request, $id = null){
               


                if($id == null){
                    return $this->redirectToRoute('home');
                }


                $Question = new Comment();
                $form = $this->createForm(CommentType::class, $Question);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {

                    $Comment = $form->getData();
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($Comment);
                    $entityManager->flush();
                    return $this->redirect("/answers/".$id, Response::HTTP_SEE_OTHER);

                }
    
                //access the wildcard
                $question_id = (int) $id;

                $questions=$this->getDoctrine()
                ->getRepository(Question::class)
                ->find($question_id);




    
            //create a modal 
            $model=array("form" => $form->createView(), "questions" => $questions);
            $view = 'answers.html.twig';



            return $this->render($view,$model);


            }



}


?>

