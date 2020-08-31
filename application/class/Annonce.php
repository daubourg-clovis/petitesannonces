<?php

namespace app;
require_once('Db.php');
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
    public static $db;
 // Evite de rappeler la fonction new Db, cette fonction s'execute automatqiuement au début
    function __construct()
    {
        $db=new Db();
    }
    function list(){
       
       
        $sql='SELECT ann_unique_id, ann_description, ann_image_url, ann_date_validation, usr_nom, cat_libelle, usr_prenom, usr_courriel, usr_telephone, c.ID FROM annonce INNER JOIN categorie AS c ON ID_categorie = c.ID INNER JOIN utilisateur AS u ON ID_utilisateur = u.ID';
        $annonces = $this->db->q($sql);
        return  $annonces;

    }   
     public static function ajout($ann_description,$ann_image_url, $ann_image_nom, $ann_est_valider, $ann_date_ecriture, $ann_date_validation, $iD_categorie, $ID_utilisateur){
        $db=new Db();
        $sql='INSERT INTO `annonce` (`ann_unique_id`, `ann_description`, `ann_image_url`, `ann_image_nom`, `ann_est_valider`, `ann_date_ecriture`, `ann_date_validation`, `iD_categorie`, `ID_utilisateur`) VALUES (null, :ann_description, :ann_image_url, :ann_image_nom, :ann_est_valider, :ann_date_ecriture, :ann_date_validation, :iD_categorie, :ID_utilisateur)';
        $stmt = $db->connect->prepare($sql);
       
            
        $stmt->bindParam(':ann_description', $ann_description );
        $stmt->bindParam(':ann_image_url', $ann_image_url );
        $stmt->bindParam(':ann_image_nom', $ann_image_nom );
        $stmt->bindParam(':ann_est_valider', $ann_est_valider );
        $stmt->bindParam(':ann_date_ecriture', $ann_date_ecriture );
        $stmt->bindParam(':ann_date_validation', $ann_date_validation );
        $stmt->bindParam(':iD_categorie', $iD_categorie, \PDO::PARAM_INT );
        $stmt->bindParam(':ID_utilisateur', $ID_utilisateur, \PDO::PARAM_INT );
        
        
        $stmt->execute();
       // $annonce= $stmt->fetchAll();
       $loader = new \Twig\Loader\FilesystemLoader('../application/templates');
       $twig = new \Twig\Environment($loader, [
       'cache' => false,
         ]);
      
       //  $loader = new \Twig\Loader\FilesystemLoader('../application/templates'); 
       $template = $twig->load('index.html.twig');
         echo $template->render(array(
             
       ));
    }
    function modif(){

    }
    function supprimer(){

    }
} 
