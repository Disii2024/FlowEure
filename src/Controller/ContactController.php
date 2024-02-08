<?php

namespace App\Controller;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\MailService;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact.index')]
    public function index(EntityManagerInterface $entityManager ,Request $request, MailerInterface $mailer): Response
    {

        $contact = new Contact();
        if ($this->getUser()) {
            $contact->setFirstName($this->getUser()->getPseudo())
                    ->setLastName($this->getUser()->getPseudo())
                    ->setEmail($this->getUser()->getEmail());
        }
        $form = $this->createForm(ContactType::class,$contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $entityManager->persist($contact);
            // dd($contact);
            $entityManager->flush();

            //email
        $email = (new Email())
            ->from($contact->getEmail())
            ->to('flow@eure.com')
            ->html($contact->getMessage());

        $mailer->send($email);


            $this->addFlash(
                'succes',
                'Votre mail à été transmis !'
            );
            return $this->redirectToRoute('contact.index');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(), // Passer le formulaire à la vue
        ]);
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
