<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//mailer
use App\Service\MailService;

// class MailServiceController extends AbstractController
// {
//     #[Route('/mail/service', name: 'app_mail_service')]
//     public function index(): Response
//     {
//         return $this->render('mail_service/index.html.twig', [
//             'controller_name' => 'MailServiceController',
//         ]);
//     }
// }

class MailServiceController extends AbstractController
{
    #[Route('/mail/service', name: 'app_mail_service')]
    public function index(MailService $mailService): Response
    {
        // Exemple d'utilisation de la classe MailService pour envoyer un e-mail
        $recipientEmail = 'recipient@example.com';
        $subject = 'Sujet de l\'e-mail';
        $message = 'Contenu de l\'e-mail';

        $mailService->sendEmail($recipientEmail, $subject, $message);

        return $this->render('mail_service/index.html.twig', [
            'controller_name' => 'MailServiceController',
        ]);
    }
}

