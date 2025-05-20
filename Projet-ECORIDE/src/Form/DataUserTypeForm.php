<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class DataUserTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'John'
                ]
            ])
            ->add('user_surname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'DOE'
                ]
            ])
            ->add('user_phone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => '0xxxxxxxxx'
                ]
            ])
            ->add('user_address', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'Indiquez votre adresse'
                ]
            ])
            ->add('user_birthdate', BirthdayType::class, [
                'label' => 'Date de naissance'
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo de profil',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'extensions' => ['jpg', 'jpeg', 'png'],
                        'extensionsMessage' => 'Chargé une image valide s\'il vous plaît',
                    ])
                ],
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Sauvegarder le profil',
                'attr' => [
                    'class' => 'button'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
