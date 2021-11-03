<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


    // //using the form builder
     use App\Form\QuestionType;
        //QuestionType entity 
    use App\Entity\Question;
    use App\Entity\UserProfile;


class QuestionsController extends AbstractController{

        
            /**
             **
             *@Route("/home",name="home")
             */

            public function Questions(Request $request){

                $user = $this->getUser();
                // $username = $this->getUser()->getEmail();
                $session = $request->getSession()->get(Security::LAST_USERNAME);
                // $user = $sessio;
                 if($user == null){
                    return $this->redirectToRoute('app_login');
                 }



                 if($request->isXmlHttpRequest()){


                        $type = $_POST["type"];
                    
if($type == "upvote"){
           
                        $LikeId = $_POST["id"];
     
                        $like = 0;
                        $entityManager = $this->getDoctrine()->getManager();
                        $qlike = $entityManager->getRepository(Question::class)->find($LikeId);
                        $like = $qlike->getUpvotes();
                        $qlike->setUpvotes($like + 1);
                        $entityManager->flush();

                        $repCount = 0;

                        $UserId = $_POST["userId"];
                        $entityManager2 = $this->getDoctrine()->getManager();
                        $rep = $entityManager2->getRepository(UserProfile::class)->find($UserId);
                        $repCount = $rep->getRep();
                        $rep->setRep($repCount + 1);
                        $entityManager2->flush();
       
                     //   return $repCount + 1;

                        return $like + 1;



                        
                        
                    }
                    else if($type == "downvote"){   

                        
                        $questionId = $_POST["id"];
  
                        $dislike = 0;
                        $entityManager = $this->getDoctrine()->getManager();
                        $quest = $entityManager->getRepository(Question::class)->find($questionId);
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
       
                    //    return $repCount - 1;
      
                        return $dislike + 1;
                    }
            } 
           
        
    
                   
                  

   
              
   


            

                //using the entity and doctrine to get your database data
                $questions=$this->getDoctrine()
                    ->getRepository(Question::class)
                    -> findAll();
        
                //create a modal 
                $model=array("questions" => $questions);
                
        
                //identify a twig template
                $view='home.html.twig';
                
        
           return $this->render($view, $model);
            }


                  /**
             **
             *@Route("/question",name="new_question")
             */

            public function newQuestions(Request $request){

                //TODO

                //session khgk of iets daarin is dan redirect
                $user = $this->getUser();
                // $username = $this->getUser()->getEmail();
                $session = $request->getSession()->get(Security::LAST_USERNAME);
                // $user = $sessio;
                 if($user == null){
                    return $this->redirectToRoute('app_login');
                 }




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


                   

                    $questionImg = $form->get('questionImg')->getData();

                                   if ($questionImg) {
                                       $originalFilename = pathinfo($questionImg->getClientOriginalName(), PATHINFO_FILENAME);
                                        $newFilename = time() .'_'. uniqid().'.'.$questionImg->guessExtension();
                                       try {
                                           $questionImg->move(
                                               $this->getParameter('question_directory'),
                                               $newFilename
                                           );
                                        } catch (FileException $e) {
                                       }
                                          $Question->setQuestionImg($newFilename); 
                                          $entityManager = $this->getDoctrine()->getManager();
                                          $entityManager->persist($Question);
                                          $entityManager->flush();
                                    }





                    return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
                }

                $view='questions.html.twig';
                $model=array("form" => $form->createView(), "questions" => $questions);
                return $this->render($view, $model);

                //  $userId = sessionvalue    moet in model wees
        
           return $this->render($view, $model);


            } 
            
            

              /**
             **
             *@Route("/home/{id}",name="delquestion")
             */

            public function delAdminRequest (Request $request, $id = null)
            {



                $question_id = (int) $id;

              

                $Question=$this->getDoctrine()
                ->getRepository(Question::class)
                ->find($question_id );


 
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->remove($Question);
                    $entityManager->flush();


                //using the entity and doctrine to get your database data
                $questions=$this->getDoctrine()
                    ->getRepository(Question::class)
                    -> findAll();
        
                //create a modal 
                $model=array("questions" => $questions);


          
            $view = 'home.html.twig';



            return $this->render($view,$model);


            }
         





}


?>