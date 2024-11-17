<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
            'attr'=>[
                'class'=>'form-control',
                'placeholder'=>'Nom',]
            ]
            )
            ->add('prenom',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Prénom',
                    ]
                ]
                )
             ->add('date_de_naissance', DateType::class, [
               
                'input'  => 'datetime_immutable',
              
                'widget' => 'single_text',
                // this is actually the default format for single_text
                
              
            ])
             ->add('username',TextType::class,[
             'attr'=>[
            'class'=>'form-control',
            'placeholder'=>'Username',
            ]
        ]
        )
            ->add('email',EmailType::class, [
            'label'=>'Entrez votre e-mail',
            'attr'=>[
                'placeholder'=>'exemple@email.fr',
                'class'=>'form-control'
            ]
        ]
        )
            
            ->add('plainPassword', RepeatedType::class, [
                "type"=>PasswordType::class, 
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                "first_options"=>["label" => "Mot de passe",
                'attr'=>[
                    'placeholder'=>'Votre mot de passe',
                    
                ]
            ],
                'second_options'=>["label"=>"Confirmation",
                'attr'=>[
                    'placeholder'=>'Confirmer votre mot de passe',
                    
                ]],
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password',
                'class'=>'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Votre image de profil (Des fichiers images uniquement)',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,
            
             

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/gif',
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid Image',
                    ])
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
