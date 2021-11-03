<?php

namespace App\Controller;


use App\Form\UserProfileType;
use App\Repository\DefaultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\UserProfile;

use Symfony\Component\Security\Core\Security;

class UserProfileController extends AbstractController
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/database", name="indexdb", methods={"GET"})
     */
    public function index(DefaultRepository $defaultRepository): Response
    {


        $user = $this->getUser();
        if($user == null){
           return $this->redirectToRoute('app_login');
        }else{
            return $this->redirectToRoute('app_login');
        }
        return $this->render('index.html.twig', [
            'user_profiles' => $defaultRepository->findAll(),
        ]);
    }

    /**
     * @Route("/register", name="new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        
        $userProfile = new UserProfile();
        $form = $this->createForm(UserProfileType::class, $userProfile);
        $form->handleRequest($request);

        $email = $userProfile->getEmail();



        // $userProfile->getEmail();
        $profileMatchingEmail = $this->getDoctrine()
        ->getRepository(UserProfile::class)
        ->findOneBy(['email' => $email]);

        if ($form->isSubmitted() && $form->isValid()) {

        if($profileMatchingEmail ){
            echo "found";
        }else{
                   


            // $userProfile = $form->getData();
            $plainpwd = $userProfile->getPassword();
            $encoded = $this->passwordEncoder->encodePassword($userProfile,$plainpwd);
            $userProfile->setPassword($encoded);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userProfile);
            $entityManager->flush();


             $email = $userProfile->getEmail();
            $userProfile->getEmail();
            $profileMatchingEmail = $this->getDoctrine()
            ->getRepository(UserProfile::class)
            ->findOneBy(['email' => $email]);


            $id = $userProfile->getId();
//https://symfony.com/doc/current/controller/upload_file.html
               $profileUrl = $form->get('profileUrl')->getData();

               if ($profileUrl) {
                   $originalFilename = pathinfo($profileUrl->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilename = time() .'_'. uniqid().'.'.$profileUrl->guessExtension();
                   try {
                       $profileUrl->move(
                           $this->getParameter('profile_directory'),
                           $newFilename
                       );
                    } catch (FileException $e) {
                   }
                      $userProfile->setprofileUrl($newFilename); 
                      $entityManager = $this->getDoctrine()->getManager();
                      $entityManager->persist($userProfile);
                      $entityManager->flush();     
                }

             echo $newFilename;
             
              return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
           //   return $this->redirect("/index.php/home");
        }
           
         }

        return $this->renderForm('new.html.twig', [
            'user_profile' => $userProfile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(UserProfile $userProfile): Response
    {

        $user = $this->getUser();
        if($user == null){
           return $this->redirectToRoute('app_login');
        }

        
        return $this->render('show.html.twig', [
            'user_profile' => $userProfile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserProfile $userProfile): Response
    {


        $user = $this->getUser();
        if($user == null){
           return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();
        $username = $this->getUser()->getEmail();
        $id = $this->getUser()->getId();
        $session = $request->getSession()->get(Security::LAST_USERNAME);
        // $user = $sessio;
         if($user == null){
            return $this->redirectToRoute('index');
         }



        
        $form = $this->createForm(UserProfileType::class, $userProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();

            $plainpwd = $userProfile->getPassword();
            $encoded = $this->passwordEncoder->encodePassword($userProfile,$plainpwd);
            $userProfile->setPassword($encoded);
            $entityManager->persist($userProfile);
            $entityManager->flush();


            $profileUrl = $form->get('profileUrl')->getData();

            if ($profileUrl) {
                $originalFilename = pathinfo($profileUrl->getClientOriginalName(), PATHINFO_FILENAME);
                 $newFilename = time() .'_'. uniqid().'.'.$profileUrl->guessExtension();
                try {
                    $profileUrl->move(
                        $this->getParameter('profile_directory'),
                        $newFilename
                    );
                 } catch (FileException $e) {
                }
                   $userProfile->setprofileUrl($newFilename); 
                   $entityManager = $this->getDoctrine()->getManager();
                   $entityManager->persist($userProfile);
                   $entityManager->flush();     
             }



            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('edit.html.twig', [
            'user_profile' => $userProfile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, UserProfile $userProfile): Response
    {

        $user = $this->getUser();
        if($user == null){
           return $this->redirectToRoute('app_login');
        }

        if ($this->isCsrfTokenValid('delete'.$userProfile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userProfile);
            $entityManager->flush();
        }
        

        return $this->redirectToRoute('user_profile_index', [], Response::HTTP_SEE_OTHER);
    }


    
}


