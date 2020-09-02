<?php

use app\Annonce;

require dirname(dirname(__FILE__))."/vendor/autoload.php";



$router = new AltoRouter();

// map homepage
$router->map( 'GET', '/', function() {
	\App\Homepage::homepage();
});

// map user details page
$router->map( 'GET', '/user/[i:id]/', function( $id ) {
	
});


// map user details page
$router->map( 'GET', '/annonces/[i:id]/', function( $id ) {
	\App\Detail::detail($id);
});
// map ajout
$router->map( 'GET', '/annonces/ajout/[*:ann_description]/[*:ann_image_url]/[*:ann_image_nom]/[*:ann_est_valider]/[*:ann_date_ecriture]/[*:ann_date_validation]/[*:iD_categorie]/[*:ID_utilisateur]/', function($ann_description,$ann_image_url, $ann_image_nom, $ann_est_valider, $ann_date_ecriture, $ann_date_validation, $iD_categorie, $ID_utilisateur) {
	echo "coucou";
	\App\Annonce::ajout($ann_description,$ann_image_url, $ann_image_nom, $ann_est_valider, $ann_date_ecriture, $ann_date_validation, $iD_categorie, $ID_utilisateur);
});

// map formulaire d'ajout
$router->map('GET', '/annonces/ajout/', function(){
	\App\Annonce::formulaireajout();
});

// match current request url
$match = $router->match();

// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}




?>