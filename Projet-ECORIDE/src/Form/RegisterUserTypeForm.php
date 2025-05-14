<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class RegisterUserTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('user_email', EmailType::class, [
                'label' => 'Saisir une adresse mail valide',
                'attr' => [
                    'placeholder' => 'Adresse@mail.com'
                ]
            ])
            ->add('user_pseudo', TextType::class, [
                'label' => 'Saisir un nom d\'utilisateur',
                'attr' => [
                    'placeholder' => 'Pseudo-123'
                ],
                'constraints' =>
                    new Length([
                        'min' => 4,
                        'max' => 20,
                        'minMessage' => 'Pseudo trop court, minimum {{ limit }} caracteres',
                        'maxMessage' => 'Pseudo trop long, maximum {{ limit }} caracteres',
                    ])
                ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saisir un mot de passe'
                    ]),
                    new Length([
                        'min' => 8,
                        'max' => 30,
                        'minMessage' => 'Mot de passe trop court, minimum {{ limit }} caracteres',
                        'maxMessage' => 'Mot de passe trop long, maximum {{ limit }} caracteres',
                    ]),
                    new passwordStrength([
                            'minScore' => PasswordStrength::STRENGTH_STRONG,
                    ])
                ],
                'first_options'  => [
                    'label' => 'Saisir un mot de passe',
                    'attr' => [
                        'placeholder' => '************'
                    ],
                    'hash_property_path' => 'user_password'
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe',
                    'attr' => [
                        'placeholder' => '************'
                    ],
                ],
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Valider',
                'attr' => [
                    'class' => 'button'
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints' => [
                new uniqueEntity([
                    'entityClass' => User::class,
                    'fields' => [
                        'user_email',
                        'user_pseudo',
                    ]
                ])
            ],
            'data_class' => User::class,
        ]);
    }
}
