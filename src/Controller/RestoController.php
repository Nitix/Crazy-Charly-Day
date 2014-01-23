<?php

class RestoController extends Controller{

	protected static $actions = array(
		    "theme"   => "listeTheme" ,
		    "resto"  => "listeResto",
		    "plats"  => "listePlats"
	);

	public static function listeTheme(){
		$alltheme = Theme::findAll();
		$v = new restoVue($alltheme);
		$v->displayPage("listeTheme"); 
	}

	public static function listeResto(){
		$res=$_GET["id"];
		$restoByTheme = Restaurant::findByTheme($res);
		$v = new restoVue($restoByTheme);
		$v->displayPage("listeResto");
	}


	public static function listePlats(){
		$res=$_GET["id"];
		$platsByResto = Plats::findByResto($res);		
		$v = new restoVue($platsByResto);
		$v->displayPage("listePlats");
	}

	// action par defaut de la page visiteur
	public static function home(){
		self::listeTheme();
	}
}

?>