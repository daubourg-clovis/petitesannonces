<?php
namespace App;

class Mail {
    // fonction qui créer le mail et l'envoie
  static function mailto($mail){
        // Create the Transport
$transport = (new \Swift_SmtpTransport('smtp.mailtrap.io', 25))
->setUsername('95ae2b5f9c2ba1')
->setPassword('6bb0407a7c9c33')
// ->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)))
;

// Create the Mailer using your created Transport
$mailer = new \Swift_Mailer($transport);

// Create a message
$message = (new \Swift_Message('annonces'))
->setFrom('vanessa.knorr@outlook.fr')
->setTo(["vanessa.knorr@outlook.fr" => 'vanessa'])
->setBody('Confirmez votre publication')
;

// Send the message
$result = $mailer->send($message);

    }
}
