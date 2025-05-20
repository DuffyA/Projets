<?php

namespace App\Controller\Account;

use App\Form\DataUserTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class ProfilController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/Compte/Profil', name: 'app_account_profil')]
    public function index(): Response
    {
        return $this->render('account/profil.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    #[Route('/Compte/Profil/Ajouter', name: 'app_account_profil_form')]
    public function DataUserForm(Request $request, SluggerInterface $slugger, #[Autowire('%kernel.project_dir%/public/uploads/')] string $photoDirectory): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(DataUserTypeForm::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($user);
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();
                try {
                    $photo->move($photoDirectory, $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setUserPhoto($newFilename);
            }
            $this->entityManager->flush();

            $this->addFlash(
                'success',
                "Votre profil a bien été mis à jour"
            );
            return $this->redirectToRoute('app_account_profil');
        }

        return $this->render('account/profilForm.html.twig', [
            'profilForm' => $form,
        ]);
    }
}

