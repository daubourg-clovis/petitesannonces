<?php
namespace App;
require_once('Db.php');
class Homepage{
    public static function homepage(){
        $db=new Db();
        
        $sql='SELECT * FROM annonce';
        $annonces = $db->q($sql);
        
      var_dump($annonces);
       
        $loader = new \Twig\Loader\FilesystemLoader('../application/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
     
      //  $loader = new \Twig\Loader\FilesystemLoader('../application/templates'); 
      $template = $twig->load('index.html.twig');
        echo $template->render(array(
            
        ));

      

    }

}
