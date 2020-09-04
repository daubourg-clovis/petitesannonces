<?php
namespace App;

class Mail {
    // fonction qui créer le mail et l'envoie
  static function mailto($mail){
        // Create the Transport
$transport = (new \Swift_SmtpTransport('SMTP.office365.com', 587, "TLS"))
->setUsername('vanessa.knorr@outlook.fr')
->setPassword('*****')
->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)))
;

// Create the Mailer using your created Transport
$mailer = new \Swift_Mailer($transport);

// Create a message
$message = (new \Swift_Message('annonces'))
->setFrom([$mail => 'Vanessa Knorr'])
->setTo(["vanessa.knorr@outlook.fr" => 'vanessa'])
->setBody('Confirmez votre publication')
;

// Send the message
$result = $mailer->send($message);
    }
}
