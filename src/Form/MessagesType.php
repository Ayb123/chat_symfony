<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Messages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
            "attr" => [
                "class" => "form-control"
            ]
        ])
        ->add('message', TextareaType::class, [
            "attr" => [
                "class" => "form-control"
            ]
        ])
        ->add('recipient', EntityType::class, [
            "class" => User::class,
            "choice_label" => "username",
            
            "attr" => [
                "class" => "form-control"
            ]
        ])
        ->add('is_read')
        ->add('envoyer', SubmitType::class, [
            "attr" => [
                "class" => "btn btn-primary"
            ]
        ])
        
    ;
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
