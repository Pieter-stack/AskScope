<?php

namespace App\Form;

use App\Entity\UserProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
=======
>>>>>>> f2b4f303d7728d7327154883eb44436ed74bb511
>>>>>>> Stashed changes

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
            ->add('name',TextType::class, array('data_class' => null))
            ->add('surname',TextType::class, array('data_class' => null))
            ->add('email',EmailType::class, array('data_class' => null))
            ->add('password',PasswordType::class)
            ->add('profileUrl',FileType::class, array('data_class' => null))
=======
>>>>>>> Stashed changes
            ->add('name')
            ->add('surname')
            ->add('email')
            ->add('password')
            ->add('profileUrl')
<<<<<<< Updated upstream
=======
>>>>>>> f2b4f303d7728d7327154883eb44436ed74bb511
>>>>>>> Stashed changes
            ->add('rep')
            ->add('access')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserProfile::class,
        ]);
    }
}
