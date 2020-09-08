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
$router->map( 'GET', '/annonces/[i:id]', function( $id ) {
	 \App\Detail::detail($id);
});
// map ajout
$router->map( 'POST', '/annonces/ajout/', function() {
	
	\App\Annonce::ajout();
});
// map confirmation
$router->map( 'GET', '/annonces/confirmer/[i:id]', function($id ) {
	
	\App\Edit::confirmation($id );
});
//map modifier

$router->map( 'POST', '/annonces/modifier', function() {
	
	\App\Annonce::modif();
});

$router->map( 'GET', '/annonces/modifier', function() {
	\App\Annonce::formulairemodif ();
});


$router->map( 'POST', '/annonces/recherche/', function() {
	
	
	\App\Homepage::recherche();
});
// map edit
$router->map( 'GET', '/annonces/edit/[i:id]/[i:utilisateurid]', function($id, $utilisateurid) {
	
	\App\Edit::formulaireEdit($id, $utilisateurid);
});

$router->map( 'POST', '/annonces/edit/[i:id]/[i:utilisateurid]', function($id, $utilisateurid) {
	
	\App\Edit::modifier($id, $utilisateurid );
});
//map delete
$router->map( 'GET', '/annonces/delete/[i:id]', function($id) {
	echo "coucou";
	\App\Edit::supprimer($id);
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