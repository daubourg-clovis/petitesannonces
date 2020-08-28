<?php
namespace App;
class Homepage{
    public static function homepage(){
       
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