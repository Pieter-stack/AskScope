<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\UserProfile;
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

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('questionText',TextareaType::class, array('data_class' => null))
            ->add('questionImg',FileType::class, array('data_class' => null))
            ->add('category',ChoiceType::class, array('data_class' => null,'choices'  => [
                'Competition ' => 'Competition ',
                'Simulation Game' => 'Simulation Game',
                'Retrogaming' => 'Retrogaming',
                'Virtual Reality' => 'Virtual Reality'
            ]))
            ->add('userId',EntityType::class, array('data_class' => null,'empty_data' => '', 'class' => UserProfile::class,'choice_label' => 'id'))
            
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
