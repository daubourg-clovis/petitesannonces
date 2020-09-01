<?php
namespace App;
require_once('Db.php');

//Definition de path de base
define("BASE_PATH", "");

//Definition de l'URI
define("SERVER_URI", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . BASE_PATH) ;

class Homepage{
    public static function homepage(){
      
       // Lister annonces 
      $db=new Db();


      
      $sql='SELECT ann_unique_id, ann_description, ann_image_url, ann_date_validation, usr_nom, cat_libelle, usr_prenom, usr_courriel, usr_telephone, c.ID FROM annonce INNER JOIN categorie AS c ON ID_categorie = c.ID INNER JOIN utilisateur AS u ON ID_utilisateur = u.ID';
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
