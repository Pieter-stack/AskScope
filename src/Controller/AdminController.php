<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DefaultRepository;
use App\Entity\UserProfile;

class AdminController extends AbstractController{








    

        
            /**
             **
             *@Route("/admin",name="admin")
             */

            public function Admin(){

                $user = $this->getUser();
                 if($user == null){
                    return $this->redirectToRoute('app_login');
                 }


            
                $user=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                -> findBy(['access' => "0"]);

                $ban=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                ->findBy(['access' => "2"]);



                $model=array("user" => $user,"ban" => $ban);
            $view = 'admin.html.twig';



            return $this->render($view,$model);


            }

             /**
             **
             *@Route("/ban_admin/{id}",name="banadmin", methods={"GET","POST"})
             */

            public function BanAdmin(Request $request, $id = null, UserProfile $userProfile){

                           $user = $this->getUser();
                 if($user == null){
                    return $this->redirectToRoute('app_login');
                 }

                $admin_id = (int) $id;

                $Admin=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                ->find($admin_id );





            
                $user=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                -> findBy(['access' => "0"]);


                if($user){


                    $entityManager = $this->getDoctrine()->getManager();

                    $access = $userProfile->getAccess();
                    $userProfile->setAccess(2);
                    $entityManager->persist($userProfile);
                    $entityManager->flush();

                    return $this->redirectToRoute('admin', [], Response::HTTP_SEE_OTHER);
                }

                $ban=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                ->findBy(['access' => "2"]);



                $model=array("user" => $user,"ban" => $ban);
            $view = 'admin.html.twig';



            return $this->render($view,$model);


            }





            /**
             **
             *@Route("/unban_admin/{id}",name="unadmin", methods={"GET","POST"})
             */

            public function UnBanAdmin(Request $request, $id = null, UserProfile $userProfile){

                $user = $this->getUser();
                if($user == null){
                   return $this->redirectToRoute('app_login');
                }

                $admin_id = (int) $id;

                $Admin=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                ->find($admin_id );





            
                $user=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                -> findBy(['access' => "0"]);




                $ban=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                ->findBy(['access' => "2"]);


                
                if($ban){


                    $entityManager = $this->getDoctrine()->getManager();

                    $access = $userProfile->getAccess();
                    $userProfile->setAccess(0);
                    $entityManager->persist($userProfile);
                    $entityManager->flush();

                    return $this->redirectToRoute('admin', [], Response::HTTP_SEE_OTHER);
                }


                $model=array("user" => $user,"ban" => $ban);
            $view = 'admin.html.twig';



            return $this->render($view,$model);


            }




              /**
             **
             *@Route("/admin/{id}",name="deladmin")
             */

            public function delAdminRequest (Request $request, $id = null)
            {



                $admin_id = (int) $id;

                $Admin=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                ->find($admin_id );



               


                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->remove($Admin);
                    $entityManager->flush();






           
            
                $user=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                -> findBy(['access' => "0"]);

                $ban=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                ->findBy(['access' => "2"]);


                return $this->redirectToRoute('admin', [], Response::HTTP_SEE_OTHER);

                $model=array("user" => $user,"ban" => $ban);
            $view = 'admin.html.twig';



            return $this->render($view,$model);


            }



          








}



?>
