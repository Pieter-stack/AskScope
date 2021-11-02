<?php

namespace App\Form;

use App\Entity\ Comment;
use App\Entity\UserProfile;
use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comments',TextareaType::class, array('data_class' => null,'empty_data' => ''))
            ->add('userId',EntityType::class, array('data_class' => null,'empty_data' => '', 'class' => UserProfile::class,'choice_label' => 'id'))
            ->add('questionId',EntityType::class, array('data_class' => null,'empty_data' => '', 'class' => Question::class,'choice_label' => 'id'))
            
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' =>  Comment::class,
        ]);
    }
}
