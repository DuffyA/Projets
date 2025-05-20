<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class PasswordUserTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actualUser_password', passwordType::class, [
                'label' => 'Votre mot de passe actuel',
                'attr' => [
                    'placeholder' => '************'
                ],
                'mapped' => false
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saisir un nouveau mot de passe'
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
                    'label' => 'Saisir un nouveau mot de passe',
                    'attr' => [
                        'placeholder' => '************'
                    ],
                    'hash_property_path' => 'user_password'
                ],
                'second_options' => [
                    'label' => 'Confirmer le nouveau mot de passe',
                    'attr' => [
                        'placeholder' => '************'
                    ],
                ],
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Mettre à jour le mot de passe',
                'attr' => [
            'class' => 'button'
        ]
    ])
        ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $user = $form->getConfig()->getOptions()['data'];
            $passwordHasher = $form->getConfig()->getOptions()['passwordHasher'];

            $isValid = $passwordHasher->isPasswordValid(
                $user,
                $form->get('actualUser_password')->getData()
            );
            if (!$isValid) {
                $form->get('actualUser_password')->addError(new FormError('Mot de passe actuel non conforme. Vérifier votre saisie.'));
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'passwordHasher' => null,
        ]);
    }
}
