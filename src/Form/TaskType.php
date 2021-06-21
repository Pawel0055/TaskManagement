<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Write a task'
                ]
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'placeholder' => 'Write a description'
                ]
            ])
            ->add('deadline', TextType::class, [
                'attr' => [
                    'placeholder' => 'Write a deadline'
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices' => ['oczekujacy' => 2, 'wykonany' => 1, 'odrzucony' => 0],
            ])
            ->add('Dodaj taska!', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
