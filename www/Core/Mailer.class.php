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
        $this->phpmailer->Host = 'smtp-relay.sendinblue.com';
        $this->phpmailer->SMTPAuth = true;
        $this->phpmailer->Port = 587;
        $this->phpmailer->Username = 'chancelvyfodekar@gmail.com';
        $this->phpmailer->Password = 'YPM3jWUcsxK5trGf';
        $this->phpmailer->addAddress($email);
        $this->phpmailer->setFrom('cdeft.lalg@gmail.com', 'Fodekar');
        $this->phpmailer->Subject = 'Activation de votre compte';
        $this->phpmailer->IsHTML(true);
        $this->phpmailer->Body = 'Veuillez cliquez sur sur lien pour activer votre compte '.$link.''; 

        return $this->phpmailer->send();
    }

}