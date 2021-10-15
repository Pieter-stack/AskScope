<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


    // //using the form builder
     use App\Form\QuestionType;
        //QuestionType entity 
    use App\Entity\Question;

class QuestionsController extends AbstractController{

        
            /**
             **
             *@Route("/questions",name="questions")
             */

            public function Questions(){



                //using the entity and doctrine to get your database data
                $questions=$this->getDoctrine()
                    ->getRepository(Question::class)
                    -> findAll();
        
                //create a modal 
                $model=array("questions" => $questions);
                
        
                //identify a twig template
                $view='questions.html.twig';
                
        
           return $this->render($view, $model);
            }


                  /**
             **
             *@Route("/question",name="new_question")
             */

            public function newQuestions(Request $request){

                $questions=$this->getDoctrine()
                ->getRepository(Question::class)
                -> findAll();
                
                $Question = new Question();
                $form = $this->createForm(QuestionType::class, $Question);
                $form->handleRequest($request);
                

                if ($form->isSubmitted() && $form->isValid()) {

                    $Question = $form->getData();
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($Question);
                    $entityManager->flush();

                    return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
                }

                $view='questions.html.twig';
                $model=array("form" => $form->createView(), "questions" => $questions);
                return $this->render($view, $model);

                //  $userId = sessionvalue    moet in model wees
        
           return $this->render($view, $model);


            }     
         





}


?>