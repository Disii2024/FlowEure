<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Controller\EntityManagerInterface;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                 'attr' => [
                    'class' => 'input',
                    'placeholder'=> 'Pseudo...'
                 ]
            ])
            ->add('email', EmailType::class, [
                    'attr' => [
                        'class' => 'input',
                    'placeholder'=> 'Email...'

                    ]
            ])
            ->add('message', TextareaType::class, [
                 'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Message...'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'submit'
                ],
                'label'=> 'Envoyez'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
