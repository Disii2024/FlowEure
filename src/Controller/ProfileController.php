<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'app_profile_show', methods: ['GET'])]
    public function show(): Response
    {
        /*
        * Recuperation du user connecté pour afficher son profil
        */
        $user =$this->getUser();
        
        return $this->render('profile/show.html.twig', [
            'user' => $user,
        ]);
    }
    
    #[Route('/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        /*
        * Recuperation du user connecté pour afficher son profil
        */
        $user =$this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/deleteUser/{id}', name: 'app_profile_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager, UserRepository $UserRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {

            $UserRepository->delete($user);

            $entityManager->flush();
            }
            // return ( 
            //     $this->redirect($this->generateUrl('app_home'));
            // )
        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);

    }
}
