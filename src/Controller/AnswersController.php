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
               



                if($request->isXmlHttpRequest()){
  
                    $type = $_POST["type"];
                    
                    if($type == "downvote"){
                    $answerId = $_POST["id"];

                    $dislike = 0;
                    $entityManager = $this->getDoctrine()->getManager();
                    $quest = $entityManager->getRepository(Comment::class)->find($answerId);
                    $dislike = $quest->getDownvotes();
                    $quest->setDownvotes($dislike + 1);
                    $entityManager->flush();

                    $repCount = 0;

                    $UserId = $_POST["userId"];
                    $entityManager2 = $this->getDoctrine()->getManager();
                    $rep = $entityManager2->getRepository(UserProfile::class)->find($UserId);
                    $repCount = $rep->getRep();
                    $rep->setRep($repCount - 1);
                    $entityManager2->flush();
  
                    return $dislike + 1;

                }else if($type == "upvote"){ 

                    $answerLikeId = $_POST["id"];

                    $like = 0;
                    $entityManager = $this->getDoctrine()->getManager();
                    $quest = $entityManager->getRepository(Comment::class)->find($answerLikeId);
                    $like = $quest->getUpvotes();
                    $quest->setUpvotes($like + 1);
                    $entityManager->flush();
  
                    return $like + 1;

                    $repCount = 0;

                    $UserId = $_POST["userId"];
                    $entityManager2 = $this->getDoctrine()->getManager();
                    $rep = $entityManager2->getRepository(UserProfile::class)->find($UserId);
                    $repCount = $rep->getRep();
                    $rep->setRep($repCount + 1);
                    $entityManager2->flush();


                }else if($type == "check"){ 
                    $checkId = $_POST["id"];

                    $entityManager = $this->getDoctrine()->getManager();
                    $quest = $entityManager->getRepository(Comment::class)->find($checkId);
                    $dislike = $quest->getAnswer();
                    $quest->setAnswer(true);
                    $entityManager->flush();
  
                    return $quest;

                   
              
                }

               }


                $user = $this->getUser();
                 if($user == null){
                    return new RedirectResponse("/", Response::HTTP_SEE_OTHER);
                 }

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
                    return $this->redirect("/index.php/answers/".$id, Response::HTTP_SEE_OTHER);

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







            /**
             **
             *@Route("/answers/{id}/delete",name="delanswers")
             */

            public function DelAnswers(Request $request, $id = null){
               

                $comment_id = (int) $id;

              
                $Commentdel=$this->getDoctrine()
                ->getRepository(Comment::class)
                ->find($comment_id );


 
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->remove($Commentdel);
                    $entityManager->flush();

                  
                if($request->isXmlHttpRequest()){
  
                    $type = $_POST["type"];
                    
                    if($type == "downvote"){
                    $answerId = $_POST["id"];

                    $dislike = 0;
                    $entityManager = $this->getDoctrine()->getManager();
                    $quest = $entityManager->getRepository(Comment::class)->find($answerId);
                    $dislike = $quest->getDownvotes();
                    $quest->setDownvotes($dislike + 1);
                    $entityManager->flush();
  
                    return $dislike + 1;

                }else if($type == "upvote"){ 

                    $answerLikeId = $_POST["id"];

                    $like = 0;
                    $entityManager = $this->getDoctrine()->getManager();
                    $quest = $entityManager->getRepository(Comment::class)->find($answerLikeId);
                    $like = $quest->getUpvotes();
                    $quest->setUpvotes($like + 1);
                    $entityManager->flush();
  
                    return $like + 1;


                }else if($type == "check"){ 
                    $checkId = $_POST["id"];

                    $entityManager = $this->getDoctrine()->getManager();
                    $quest = $entityManager->getRepository(Comment::class)->find($checkId);
                    $dislike = $quest->getAnswer();
                    $quest->setAnswer(true);
                    $entityManager->flush();
  
                    return $quest;
              
                }

               }


                $user = $this->getUser();
                 if($user == null){
                    return new RedirectResponse("/", Response::HTTP_SEE_OTHER);
                 }

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
                    return $this->redirect("/index.php/answers/".$id, Response::HTTP_SEE_OTHER);

                }
    
                //access the wildcard
                $question_id = (int) $id;

                $questions=$this->getDoctrine()
                ->getRepository(Question::class)
                ->find($question_id);



   

                return $this->redirect("/index.php/home/", Response::HTTP_SEE_OTHER);

    
            //create a modal 
            $model=array("form" => $form->createView(), "questions" => $questions);
            $view = 'answers.html.twig';



            return $this->render($view,$model);


            }












}


?>

