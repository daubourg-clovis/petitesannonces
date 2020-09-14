<?php
namespace App;

class Mail {
    // fonction qui créer le mail et l'envoie
  static function mailto($mail, $body, $usr_prenom , $usr_nom){
      // $mail=$_POST['email'];
        // Create the Transport

        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
       ->setUsername('clovis.daubourg@gmail.com')
       ->setPassword('LGBfMbK3etFC') 
// $transport = (new \Swift_SmtpTransport('smtp.mailtrap.io', 587))
// ->setUsername('95ae2b5f9c2ba1')
// ->setPassword('6bb0407a7c9c33')
//  ->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)))
;

// Create the Mailer using your created Transport
$mailer = new \Swift_Mailer($transport);

// Create a message
$message = (new \Swift_Message('annonces'))
 ->setContentType("text/html")
->setFrom('clovis.daubourg@gmail.com')
->setTo([$mail => $usr_prenom." ".$usr_nom])
->setBody($body) 
;

// Send the message
$result = $mailer->send($message);

    }
}
   