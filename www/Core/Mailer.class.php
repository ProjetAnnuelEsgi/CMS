<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
abstract class Mailer
{
    private $phpmailer;

    public function sendMail($subject, $isHTML, $body, $email)
    {
        $this->phpmailer = new PHPMailer();
        $this->phpmailer->isSMTP();
        $this->phpmailer->Host = MAILER_HOST;
        $this->phpmailer->SMTPAuth = MAILER_SMTP_AUTH;
        $this->phpmailer->Port = MAILER_PORT;
        $this->phpmailer->Username = MAILER_SMTP_USERNAME;
        $this->phpmailer->Password = MAILER_SMTP_PASSWORD;
        $this->phpmailer->addAddress($email);
        $this->phpmailer->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_USER);
        $this->phpmailer->Subject = $subject;
        $this->phpmailer->IsHTML($isHTML);
        $this->phpmailer->Body = $body;

        return $this->phpmailer->send();
    }

    public function sendActivationEmail($email, $activationCode = null)
    {
        $isHTML = true;
        $link = "<a href=" . ONLINE_DOMAIN . "/verify-account?key=" . $activationCode . "'>Cliquez et Vérifiez votre Email</a>";
        $subject = "Activation de votre compte";
        $body = "Veuillez cliquer sur le lien pour activer votre compte " . $link;

        $this->sendMail($subject, $isHTML, $body, $email);
    }

    public function sendForgotPasswordEmail($email, $activationCode = null)
    {
        $isHTML = true;
        $link = "<a href=" . ONLINE_DOMAIN . "/resetpwd?key=" . $email . "&token=" . $activationCode . "'>Cliquez et réinitialiser votre mot de passe</a>";
        $subject = "Réinitialisation du mot de passe";
        $body = "Veuillez cliquer sur le lien pour réinitialiser votre mot de passe " . $link;

        $this->sendMail($subject, $isHTML, $body, $email);

        return true;
    }
}
