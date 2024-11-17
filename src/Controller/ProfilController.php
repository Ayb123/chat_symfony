<?php

namespace App\Controller;

use App\Form\EditProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
    #[Route('/edit_profil', name: 'app_editprofil')]
    public function editProfile(Request $request,ManagerRegistry $doctrine)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfilType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em =$doctrine->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/editProfil.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/edit_pass', name: 'app_editpass')]
    public function editPass(Request $request, UserPasswordHasherInterface $userPasswordHasher,ManagerRegistry $doctrine)
    {
        if($request->isMethod('POST')){
            $em = $doctrine->getManager();

            $user = $this->getUser();

            // On vérifie si les 2 mots de passe sont identiques
            if($request->request->get('pass') == $request->request->get('pass2')){
               

                $user->setPassword( $userPasswordHasher->hashPassword( $user, $request->request->get('pass') ) );
                $em->flush();
                $this->addFlash('message', 'Mot de passe mis à jour avec succès');

                return $this->redirectToRoute('app_profil');
            }else{
                $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques');
            }
        }

        return $this->render('profil/editPass.html.twig');
    }

}
