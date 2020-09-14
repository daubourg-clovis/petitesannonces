<?php

namespace app;
require_once('Db.php');
define('BASE_PATH','') ;
define('SERVER_URI', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] .':' . $_SERVER['SERVER_PORT'] . BASE_PATH) ;
class Edit {
    public static function formulaireEdit ($id, $utilisateurid){
        $db=new Db();
      
        $sql='SELECT ann_unique_id, ann_description, ann_image_url, ann_date_validation, usr_nom, cat_libelle, usr_prenom, usr_courriel, usr_telephone, c.ID, ann_titre, ann_prix FROM annonce INNER JOIN categorie AS c ON ID_categorie = c.ID INNER JOIN utilisateur AS u ON ID_utilisateur = u.ID WHERE ann_unique_id=:ann_unique_id';


       
        $stmt = $db->connect->prepare($sql);

        $stmt->bindValue(':ann_unique_id', $id, \PDO::PARAM_INT );

       $stmt->execute();
        
         $annonce = $stmt->fetchAll();
         
        $loader = new \Twig\Loader\FilesystemLoader('../application/templates');
        $twig = new \Twig\Environment($loader, [
        'cache' => false,

          ]);
         


        //  $loader = new \Twig\Loader\FilesystemLoader('../application/templates'); 
        $template = $twig->load('editform.html.twig');
          echo $template->render(
            ['annonces'=>$annonce[0]]
          )
              
        ;


    }

public static function modifier($id, $utilisateurid){

    
        //  var_dump($_FILES);
        //  var_dump($_POST);
         
          $filename = $_FILES['upload']['tmp_name'];
          var_dump($_SERVER['DOCUMENT_ROOT']);
          $basename = $_SERVER["DOCUMENT_ROOT"];
          $destination = "/img/";
          echo '<pre>';
           if (move_uploaded_file($_FILES['upload']['tmp_name'],  $basename.$destination.$_FILES['upload']['name'])) {
               echo "Le fichier est valide, et a été téléchargé
                     avec succès. Voici plus d'informations :\n";
           } else {
               echo "Attaque potentielle par téléchargement de fichiers.
                     Voici plus d'informations :\n";
           }
   
           echo 'Voici quelques informations de débogage :';
           print_r($_FILES);
   
           echo '</pre>';
     
         
          move_uploaded_file ( $filename , $destination );
         
        
   
         $ann_description = trim($_POST['details']);
         $ann_image_url = $destination.$_FILES['upload']['name'];
          $ann_image_nom = $filename ;
          $ann_est_valider = "false";
          
          $iD_categorie = trim($_POST['category']);
         // $ID_utilisateur = trim($_POST['details']);
           $db=new Db();
            $usr_courriel= trim($_POST['email']);
           $usr_nom = trim($_POST['surname']);
           $usr_prenom = trim($_POST['firstname']);
           $usr_telephone = trim($_POST['phone']);
           $ann_titre = trim($_POST['title']);
           $ann_prix = trim($_POST['price']);
           
           $ann_date_ecriture = date("Y-m-d");
           $sql='BEGIN;
           UPDATE utilisateur SET  usr_nom= :nom, usr_prenom= :prenom, usr_telephone= :telephone, usr_courriel= :courriel WHERE ID=:ID;
           
           UPDATE annonce SET ann_image_url = :ann_image_url,    ann_image_nom= :ann_image_nom, ann_description = :ann_description, ann_est_valider = :ann_est_valider, ann_date_ecriture = :ann_date_ecriture, iD_categorie = :iD_categorie, ann_titre = :ann_titre, ann_prix = :ann_prix WHERE annonce.ann_unique_id = :ann_unique_id; 
           COMMIT;';

           $stmt = $db->connect->prepare($sql);
          
               
           $stmt->bindParam(':ann_description', $ann_description );
           $stmt->bindParam(':ann_image_url', $ann_image_url );
           $stmt->bindParam(':ann_image_nom', $ann_image_nom );
           $stmt->bindParam(':ann_est_valider', $ann_est_valider );
           $stmt->bindParam(':ann_date_ecriture', $ann_date_ecriture );
          // $stmt->bindParam(':ann_date_validation', $ann_date_validation );
           $stmt->bindValue(':iD_categorie', $iD_categorie, \PDO::PARAM_INT );
          // $stmt->bindValue(':ID_utilisateur', $ID_utilisateur, \PDO::PARAM_INT );
          $stmt->bindParam(':courriel', $usr_courriel );
          $stmt->bindParam(':nom', $usr_nom );
          $stmt->bindParam(':prenom', $usr_prenom );
          $stmt->bindParam(':telephone', $usr_telephone );
          $stmt->bindParam(':ann_titre', $ann_titre );
          $stmt->bindValue(':ann_prix', $ann_prix, \PDO::PARAM_INT );
           $stmt->bindValue(':ann_unique_id', $id, \PDO::PARAM_INT );
           $stmt->bindValue(':ID', $utilisateurid, \PDO::PARAM_INT );
           $stmt->execute();
          // $annonce= $stmt->fetchAll();
        /*   $loader = new \Twig\Loader\FilesystemLoader('../application/templates');
          $twig = new \Twig\Environment($loader, [
          'cache' => false,
            ]); */
         
          //\App\Mail::mailto($usr_courriel);


         header('Location: /');
          //  $loader = new \Twig\Loader\FilesystemLoader('../application/templates'); 
         /*  $template = $twig->load('base.html.twig');
            echo $template->render(array(
                
          )); */

    }


    // fonction de de validation d'annonce
    public static function confirmation($id){
      $db=new Db();
      $sql='UPDATE annonce SET  ann_est_valider= \'true\' WHERE ann_unique_id= :ann_unique_id';

      $stmt = $db->connect->prepare($sql);
     
          
      // $stmt->bindParam(':ann_est_valider', true);

      $stmt->bindValue(':ann_unique_id', $id, \PDO::PARAM_INT );
      $stmt->execute();

      $sql='SELECT usr_courriel, usr_prenom, usr_nom   FROM annonce INNER JOIN utilisateur AS u ON ID_utilisateur = u.ID WHERE ann_unique_id=:ann_unique_id';


      
      $stmt = $db->connect->prepare($sql);

      $stmt->bindValue(':ann_unique_id', $id, \PDO::PARAM_INT );

     $stmt->execute();
      
     $sql = $stmt->fetch();
     var_dump($sql);
    //  déclarartion des variables sql
     $usr_courriel= $sql->usr_courriel;
     $usr_prenom=$sql->usr_prenom;
     $usr_nom=$sql->usr_nom;


      $body="Votre annonce a été crée. <a href=" .SERVER_URI."/annonces/delete/$id >cliquez ici pour supprimer </a> ";
      echo $body;
      \App\Mail::mailto($usr_courriel, $body, $usr_prenom, $usr_nom);
       header('Location: /');

    }


    // fonction supprimer
    public static function supprimer($id){

        $db=new Db();
      
        $sql='DELETE FROM `annonce` WHERE ann_unique_id=:ann_unique_id';


       
        $stmt = $db->connect->prepare($sql);

        $stmt->bindValue(':ann_unique_id', $id, \PDO::PARAM_INT );

       $stmt->execute();

       
      
      
       header('Location: /');
       
    }
}