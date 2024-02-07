// src/Service/MailService.php

namespace App\Service;

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
