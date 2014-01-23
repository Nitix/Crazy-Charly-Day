<?php
//fonctions neccessaires au bon fonctionnement du site

//crée la session
session_start();

//Crée un jeton si besoin
if(!isset($_SESSION['jeton']))
	$_SESSION['jeton'] = hash('sha256', uniqid());

//class loader des fonctions crée
function loadClasses($classname) {
	 // le répertoire d'installation de l'application
	 if (is_file( $classname.'.php' )) require_once $classname.'.php' ;
	 $myAppDirs = array( 'Controller', 'Modele', 'Vue') ; 
	 foreach ($myAppDirs as $cdir) {
		 $filepath = $cdir .DIRECTORY_SEPARATOR . $classname . '.php' ; 
		 if (is_file( $filepath )) require_once $filepath ;
	 }
}

//enregistre le loader
spl_autoload_register('loadClasses');