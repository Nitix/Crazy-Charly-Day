<?php

class RestoController extends Controller{

	public static $action = array(
		    "theme"   => "listeTheme" ,
		    "resto"  => "listeResto",
		    "plats"  => "listePlats"
	);

	public static function listeTheme(){
		$alltheme = theme::findAll();
		$v = new restoVue($alltheme);
		$v->displayPage("listeTheme"); 
	}

	public static function listeResto($tab){
		$res=$tab["id"];
		$restoByTheme = restaurant::findByTheme($res);
		$v = new restoVue($restoByTheme);
		$v->displayPage("listeResto");
	}


	public static function listePlats($tab){
		$res=$tab["id"];
		$platsByResto = plats::findByResto($res);		
		$v = new restoVue($platsByResto);
		$v->displayPage("listePlats");
	}

	// action par defaut de la page visiteur
	public static function Home(){
		$alltheme = theme::findAll();
		$v = new restoVue($alltheme);
		$v->displayPage("listeTheme"); 
	}
}

?>