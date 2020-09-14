<?php

namespace app;
require_once('Db.php');
// metre chemin verrs seveur quand projet fini
define('BASE_PATH','') ;
define('SERVER_URI', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] .':' . $_SERVER['SERVER_PORT'] . BASE_PATH) ;
class Annonce {

    public $nom;
    public $prenom;
    public $description;
    public $imgUrl;
    public $imgName;
    public $uniqueId;
    public $dateCreate;
    public $dateValidate;
    public $catId;
    public $userId;
    public $db;

    
 // Evite de rappeler la fonction new Db, cette fonction s'execute automatqiuement au début
    function __construct()
    {
        $this->db=new Db();
    }
    // public  function list(){
       

    //     $sql='SELECT  ann_unique_id, ann_description, ann_image_url, ann_date_validation, usr_nom, cat_libelle, usr_prenom, usr_courriel, usr_telephone, c.ID , ann_titre, ann_prix FROM annonce INNER JOIN categorie AS c ON ID_categorie = c.ID INNER JOIN utilisateur AS u ON ID_utilisateur = u.ID WHERE ann_est_valider = \"true\" ' ;
    //     $annonces = $this->db->q($sql);
    //     return  $annonces;

    // }   

    // Ajout
    public static function formulaireajout (){
        $loader = new \Twig\Loader\FilesystemLoader('../application/templates');
        $twig = new \Twig\Environment($loader, [
        'cache' => false,
          ]);
         


        //  $loader = new \Twig\Loader\FilesystemLoader('../application/templates'); 
        $template = $twig->load('addform.html.twig');
          echo $template->render();


    }


    //---------------------------------------------------------------------------

     public static function ajout(){
     //  var_dump($_FILES);
     //  var_dump($_POST);
     
      // Partie de l'uploader d'image dans les fichiers du serveur
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

        // Ajout de l'annonce dans la base de donné
        // -----------------------------------------------------------------------------------------------------
        $sql='BEGIN;
        INSERT INTO utilisateur (usr_courriel, usr_nom, usr_prenom, usr_telephone) VALUES (:courriel, :nom, :prenom, :telephone);
        SET @ID_utilisateur = LAST_INSERT_ID();
        INSERT INTO `annonce` (`ann_description`, `ann_image_url`, `ann_image_nom`, `ann_est_valider`, `ann_date_ecriture`,  `iD_categorie`, `ID_utilisateur`, `ann_titre`, `ann_prix`) VALUES ( :ann_description, :ann_image_url, :ann_image_nom, :ann_est_valider, :ann_date_ecriture, :iD_categorie, @ID_utilisateur, :ann_titre, :ann_prix);
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
        
        $stmt->execute();
      //  $lastid = $db->connect->lastInsertId();
      $sql='SELECT MAX(ann_unique_id) AS ann_unique_id
      FROM annonce';
      $stmt = $db->connect->prepare($sql);
      $stmt->execute();
      $sql = $stmt->fetch();
      var_dump($sql);
      $lastid= $sql->ann_unique_id;

      $sql='SELECT MAX(ID) AS ID
      FROM utilisateur';
      $stmt = $db->connect->prepare($sql);
      $stmt->execute();
      $sql = $stmt->fetch();
      var_dump($sql);
      $lastutilisateurid= $sql->ID;
    

//  Confirmation et modification de mail
      $body="Confirmez votre annonce <a href=" .SERVER_URI."/annonces/confirmer/$lastid >cliquez ici pour confirmer </a> <br> <a href=" .SERVER_URI."/annonces/edit/$lastid/$lastutilisateurid >cliquez ici pour modifier </a>";
      echo $body;
      \App\Mail::mailto($usr_courriel, $body, $usr_prenom, $usr_nom);
      header('Location: /');
     
    }

    public static function modif(){

    }

    public static function formulairemodif (){

      //Definition de path de base
// define("BASE_PATH", "");

//Definition de l'URI
// define("SERVER_URI", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . BASE_PATH) ;

      $loader = new \Twig\Loader\FilesystemLoader('../application/templates');
      $twig = new \Twig\Environment($loader, [
      'cache' => false,
        ]);
        $annonce = new \app\Annonce();
        $annonces = $annonce->list();

      $template = $twig->load('editform.html.twig');
        echo $template->render([
          'annonce' => $annonces,
          'basepath' => SERVER_URI,
        ]);


  }
    
 
} 
