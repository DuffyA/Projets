<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')
            // ...
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            IntegerField::new('user_id', 'User ID')->onlyOnIndex(),
            #TextField::new('user_roles', 'Rôle'),
            TextField::new('user_email', 'Email')->OnlyOnIndex(),
            TextField::new('user_pseudo', 'Pseudo'),
            TextField::new('user_password', 'Password')->OnlyOnIndex(),
            TextField::new('user_firstname', 'Prénom'),
            TextField::new('user_surname', 'Nom'),
            TextField::new('user_phone', 'Téléphone'),
            TextField::new('user_address', 'Adresse'),
            DateField::new('user_birthdate', 'Date de naissance'),
            #ImageField::new('user_photo', 'Photo'),

        ];
    }
}
