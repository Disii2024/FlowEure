<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//mailer
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($recipientEmail, $subject, $message)
    {
        $email = (new Email())
            ->from('your_email@example.com')
            ->to($recipientEmail)
            ->subject($subject)
            ->text($message);

        $this->mailer->send($email);
    }
}

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
