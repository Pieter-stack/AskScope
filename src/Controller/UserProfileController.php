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
/**
 * @Route("/user/profile")
 */
class UserProfileController extends AbstractController
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/", name="user_profile_index", methods={"GET"})
     */
    public function index(DefaultRepository $defaultRepository): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'user_profiles' => $defaultRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_profile_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userProfile = new UserProfile();
        $form = $this->createForm(UserProfileType::class, $userProfile);
        $form->handleRequest($request);

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
            'user_profile' => $userProfile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="user_profile_show", methods={"GET"})
     */
    public function show(UserProfile $userProfile): Response
    {
        return $this->render('user_profile/show.html.twig', [
            'user_profile' => $userProfile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_profile_edit", methods={"GET","POST"})
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

            return $this->redirectToRoute('user_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_profile/edit.html.twig', [
            'user_profile' => $userProfile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="user_profile_delete", methods={"POST"})
     */
    public function delete(Request $request, UserProfile $userProfile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userProfile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userProfile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
