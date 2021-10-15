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
<<<<<<< Updated upstream
/**
 * @Route("/user/profile")
 */
=======
<<<<<<< HEAD

=======
/**
 * @Route("/user/profile")
 */
>>>>>>> f2b4f303d7728d7327154883eb44436ed74bb511
>>>>>>> Stashed changes
class UserProfileController extends AbstractController
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(DefaultRepository $defaultRepository): Response
    {
        return $this->render('index.html.twig', [
=======
>>>>>>> Stashed changes
     * @Route("/", name="user_profile_index", methods={"GET"})
     */
    public function index(DefaultRepository $defaultRepository): Response
    {
        return $this->render('user_profile/index.html.twig', [
<<<<<<< Updated upstream
=======
>>>>>>> f2b4f303d7728d7327154883eb44436ed74bb511
>>>>>>> Stashed changes
            'user_profiles' => $defaultRepository->findAll(),
        ]);
    }

    /**
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        
=======
>>>>>>> Stashed changes
     * @Route("/new", name="user_profile_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
<<<<<<< Updated upstream
=======
>>>>>>> f2b4f303d7728d7327154883eb44436ed74bb511
>>>>>>> Stashed changes
        $userProfile = new UserProfile();
        $form = $this->createForm(UserProfileType::class, $userProfile);
        $form->handleRequest($request);

<<<<<<< Updated upstream
=======
<<<<<<< HEAD
        $email = $userProfile->getEmail();



        // $userProfile->getEmail();
        $profileMatchingEmail = $this->getDoctrine()
        ->getRepository(UserProfile::class)
        ->findOneBy(['email' => $email]);

        

        if($profileMatchingEmail ){
            echo "found";
        }else{
            echo "clear";
        }
       

     

        


//         if ($form->isSubmitted() && $form->isValid()) {


//             // $userProfile = $form->getData();
//             $plainpwd = $userProfile->getPassword();
//             $encoded = $this->passwordEncoder->encodePassword($userProfile,$plainpwd);
//             $userProfile->setPassword($encoded);
//             $entityManager = $this->getDoctrine()->getManager();
//             $entityManager->persist($userProfile);
//             $entityManager->flush();


//              $email = $userProfile->getEmail();
//             $userProfile->getEmail();
//             $profileMatchingEmail = $this->getDoctrine()
//             ->getRepository(UserProfile::class)
//             ->findOneBy(['email' => $email]);


//             $id = $userProfile->getId();
// //https://symfony.com/doc/current/controller/upload_file.html
//                $profileUrl = $form->get('profileUrl')->getData();

//                if ($profileUrl) {
//                    $originalFilename = pathinfo($profileUrl->getClientOriginalName(), PATHINFO_FILENAME);
//                     $newFilename = time() .'_'. uniqid().'.'.$profileUrl->guessExtension();
//                    try {
//                        $profileUrl->move(
//                            $this->getParameter('profile_directory'),
//                            $newFilename
//                        );
//                     } catch (FileException $e) {
//                    }
//                       $userProfile->setprofileUrl($newFilename); 
//                       $entityManager = $this->getDoctrine()->getManager();
//                       $entityManager->persist($userProfile);
//                       $entityManager->flush();     
//                 }

             //echo $newFilename;
             
        //       return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
            
        // }

        return $this->renderForm('new.html.twig', [
=======
>>>>>>> Stashed changes
        if ($form->isSubmitted() && $form->isValid()) {


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


            //echo $email;
             return $this->redirectToRoute('user_profile_index', [], Response::HTTP_SEE_OTHER);
            
        }

        return $this->renderForm('user_profile/new.html.twig', [
<<<<<<< Updated upstream
=======
>>>>>>> f2b4f303d7728d7327154883eb44436ed74bb511
>>>>>>> Stashed changes
            'user_profile' => $userProfile,
            'form' => $form,
        ]);
    }

    /**
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(UserProfile $userProfile): Response
    {
        return $this->render('show.html.twig', [
=======
>>>>>>> Stashed changes
     * @Route("/{id}", name="user_profile_show", methods={"GET"})
     */
    public function show(UserProfile $userProfile): Response
    {
        return $this->render('user_profile/show.html.twig', [
<<<<<<< Updated upstream
=======
>>>>>>> f2b4f303d7728d7327154883eb44436ed74bb511
>>>>>>> Stashed changes
            'user_profile' => $userProfile,
        ]);
    }

    /**
<<<<<<< Updated upstream
     * @Route("/{id}/edit", name="user_profile_edit", methods={"GET","POST"})
=======
<<<<<<< HEAD
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
=======
     * @Route("/{id}/edit", name="user_profile_edit", methods={"GET","POST"})
>>>>>>> f2b4f303d7728d7327154883eb44436ed74bb511
>>>>>>> Stashed changes
     */
    public function edit(Request $request, UserProfile $userProfile): Response
    {
        $form = $this->createForm(UserProfileType::class, $userProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();

            $plainpwd = $userProfile->getPassword();
            $encoded = $this->passwordEncoder->encodePassword($userProfile,$plainpwd);
            $userProfile->setPassword($encoded);
            $entityManager->persist($userProfile);
            $entityManager->flush();

<<<<<<< Updated upstream
=======
<<<<<<< HEAD

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



            return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('edit.html.twig', [
=======
>>>>>>> Stashed changes
            return $this->redirectToRoute('user_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_profile/edit.html.twig', [
<<<<<<< Updated upstream
=======
>>>>>>> f2b4f303d7728d7327154883eb44436ed74bb511
>>>>>>> Stashed changes
            'user_profile' => $userProfile,
            'form' => $form,
        ]);
    }

    /**
<<<<<<< Updated upstream
     * @Route("/{id}", name="user_profile_delete", methods={"POST"})
=======
<<<<<<< HEAD
     * @Route("/{id}", name="delete", methods={"POST"})
=======
     * @Route("/{id}", name="user_profile_delete", methods={"POST"})
>>>>>>> f2b4f303d7728d7327154883eb44436ed74bb511
>>>>>>> Stashed changes
     */
    public function delete(Request $request, UserProfile $userProfile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userProfile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userProfile);
            $entityManager->flush();
        }
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
        

        return $this->redirectToRoute('user_profile_index', [], Response::HTTP_SEE_OTHER);
    }


           /**
     * *@Route("/test", name="test")
     */
    public function test(){
        $model=array();

        //identify a twig template
        $view='log.html.twig';


   return $this->render($view, $model);
    }







    
}


=======
>>>>>>> Stashed changes

        return $this->redirectToRoute('user_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
<<<<<<< Updated upstream
=======
>>>>>>> f2b4f303d7728d7327154883eb44436ed74bb511
>>>>>>> Stashed changes
