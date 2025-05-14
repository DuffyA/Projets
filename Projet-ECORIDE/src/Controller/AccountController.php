<?php

namespace App\Controller;

use App\Form\PasswordUserTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class AccountController extends AbstractController
{
    #[Route('/Compte', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    #[Route('/Compte/Modifier-mdp', name: 'app_account_modify_pwd')]
    public function password(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();
        $form = $this->createForm(PasswordUserTypeForm::class, $user, [
            'passwordHasher' => $passwordHasher,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'success',
                "Votre mot de passe est correctement mis à jour."
            );
        }

        return $this->render('account/password.html.twig', [
            'modifyPwd' => $form->createView()
        ]);
    }
}
