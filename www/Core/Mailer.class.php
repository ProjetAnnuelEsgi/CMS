<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
class Mailer
{

    private $phpmailer;

    public function sendMail($email)
    {

        $this->phpmailer = new PHPMailer();
        $this->phpmailer->isSMTP();
        $this->phpmailer->Host = 'smtp-relay.sendinblue.com';
        $this->phpmailer->SMTPAuth = true;
        $this->phpmailer->Port = 587;
        $this->phpmailer->Username = 'chancelvyfodekar@gmail.com';
        $this->phpmailer->Password = 'YPM3jWUcsxK5trGf';
        $this->phpmailer->addAddress($email);
        $this->phpmailer->setFrom('cdeft.lalg@gmail.com', 'Fodekar');
        $this->phpmailer->Subject = 'PHPMailer GMail SMTP test';
        $this->phpmailer->Body = 'test 123';
        $this->phpmailer->send();
    }
}
