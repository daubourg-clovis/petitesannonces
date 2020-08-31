<?php
namespace App;
require_once('Db.php');

//Definition de path de base
define("BASE_PATH", "");

//Definition de l'URI
define("SERVER_URI", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . BASE_PATH) ;

class Homepage{
    public static function homepage(){
        $db=new Db();
        
        $sql='SELECT * FROM annonce';
        $annonces = $db->q($sql);
        
      // var_dump($annonces);
       
        $loader = new \Twig\Loader\FilesystemLoader('../application/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
     
      //  $loader = new \Twig\Loader\FilesystemLoader('../application/templates'); 
      $template = $twig->load('index.html.twig');
        echo $template->render([
          'annonces' => $annonces,
          'basepath' => SERVER_URI,
        ]);

      

    }

}
