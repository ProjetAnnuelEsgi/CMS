<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
class Mailer
{
    private $link;
    private $phpmailer;

    public function sendMail($email, $activationCode = null)
    {
        $link = "<a href='localhost/verify-account?key=".$activationCode."'>Click and Verify Email</a>";
        $this->phpmailer = new PHPMailer();
        $this->phpmailer->isSMTP();
        $this->phpmailer->Host = MAILER_HOST;
        $this->phpmailer->SMTPAuth = MAILER_SMTP_AUTH;
        $this->phpmailer->Port = MAILER_PORT;
        $this->phpmailer->Username = MAILER_SMTP_USERNAME;
        $this->phpmailer->Password = MAILER_SMTP_PASSWORD;
        $this->phpmailer->addAddress($email);
        $this->phpmailer->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_USER);
        $this->phpmailer->Subject = 'Activation de votre compte';
        $this->phpmailer->IsHTML(true);
        $this->phpmailer->Body = 'Veuillez cliquez sur sur lien pour activer votre compte '.$link.''; 

        return $this->phpmailer->send();
    }

}