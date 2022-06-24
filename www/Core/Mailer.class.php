<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';

// require '../../PHPMailer/src/PHPMailer.php';
// require '../../PHPMailer/src/SMTP.php';


 class Mailer {

    private $phpmailer; 
    
    public function sendMail($email) {

        // $phpmailer = new PHPMailer();
        // $phpmailer->isSMTP();
        // $phpmailer->Host = 'smtp.mailtrap.io';
        // $phpmailer->SMTPAuth = true;
        // $phpmailer->Port = 2525;
        // $phpmailer->Username = 'adff1089137092';
        // $phpmailer->Password = 'a9274a544536fc';
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
    

        // try{
           
        //     // $phpmailer = new PHPMailer();
        //     // $phpmailer->isSMTP();
        //     // $phpmailer->SMTPDebug = 4;
        //     // $phpmailer->Host = 'smtp.gmail.com';
        //     // $phpmailer->Port = 465;
        //     // $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        //     // $phpmailer->SMTPAuth = true;
        //     // $phpmailer->Username = 'deft.lalg@gmail.com';
        //     // $phpmailer->Password = 'esgi_2021';
        //     // $phpmailer->setFrom('cdeft.lalg@gmail.com', 'Fodekar');
        //     // $phpmailer->addAddress($email);
        //     // $phpmailer->Subject = 'PHPMailer GMail SMTP test';
        //     // // $phpmailer->msgHTML('test 1,2,3');
        //     // $phpmailer->Body = 'Body du mail';
          
        
        // }catch(\Exception $e){
        //     echo 'erreur';
        // }
 
}
 }


//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
// public function save_mail($phpmailer)
// {
//     //You can change 'Sent Mail' to any other folder or tag
//     $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

//     //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
//     $imapStream = imap_open($path, $phpmailer->Username, $phpmailer->Password);

//     $result = imap_append($imapStream, $path, $phpmailer->getSentMIMEMessage());
//     imap_close($imapStream);

//     return $result;
// }


// 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


