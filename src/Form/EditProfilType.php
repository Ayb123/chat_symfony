<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom',TextType::class,[
            'attr'=>[
                'class'=>'form-control']
            ]
            )
            ->add('prenom',TextType::class,[
                'attr'=>[
                    'class'=>'form-control']
                ]
                )
        ->add('username',TextType::class,[
            'attr'=>[
                'class'=>'form-control']
            ]
            )
            ->add('date_de_naissance', DateType::class, [
               
                'input'  => 'datetime_immutable',
              
                'widget' => 'single_text',
                // this is actually the default format for single_text
                
              
            ])
            ->add('email',EmailType::class, [
                'label'=>'Entrez votre e-mail',
                'attr'=>[
                    'placeholder'=>'exemple@email.fr',
                    'class'=>'form-control'
                ]
            ]
            )
        
        
    ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
