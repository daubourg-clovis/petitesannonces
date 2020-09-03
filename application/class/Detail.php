<?php
namespace App;
require_once('Db.php');

//Definition de path de base
define("BASE_PATH", "");

//Definition de l'URI
define("SERVER_URI", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . BASE_PATH) ;

class Detail{
    
    public static function detail($id){
        $db=new Db();
        
        $sql='SELECT * FROM annonce WHERE ann_unique_id=:id';
       /*  $v1=':id';
        $v3=\PDO::PARAM_INT;
        $cond=[$v1, $id, $v3 ];
        $annonce = $db->q($sql, $v1, $id, $v3); */
        
            $stmt = $db->connect->prepare($sql);
           
            
                    $stmt->bindParam(':id', $id, \PDO::PARAM_INT );
             
            $stmt->execute();
            $annonce= $stmt->fetchAll();
        
        
       
        $loader = new \Twig\Loader\FilesystemLoader('../application/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
     
      //  $loader = new \Twig\Loader\FilesystemLoader('../application/templates'); 
      $template = $twig->load('detail.html.twig');
        echo $template->render([
            'annonce' => $annonce,
            'basepath' => SERVER_URI,
          ]);

      

    }

}
