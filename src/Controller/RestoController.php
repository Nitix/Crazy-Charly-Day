<?php

class RestoController extends Controller{

	protected static $actions = array(
		    "theme"   => "listeTheme" ,
		    "resto"  => "listeResto",
		    "plats"  => "listePlats",
		    "ajoutPanier" => "ajoutPanier"
	);

	public static function listeTheme(){
		$alltheme = Theme::findAll();
		$v = new RestoVue($alltheme);
		$v->displayPage("listeTheme"); 
	}

	public static function listeResto(){
		$res=$_GET["id"];
		$restoByTheme = Restaurant::findByTheme($res);
		$v = new RestoVue($restoByTheme);
		$v->displayPage("listeResto");
	}


	public static function listePlats(){
		$res=$_GET["id"];
		$data['plats'] = Plats::findByResto($res);	
		$data['resto'] = Restaurant::findById($res);	
		$v = new RestoVue($data);
		$v->displayPage("listePlats");
	}

	// action par defaut de la page visiteur
	public static function home(){
		self::listeTheme();
	}
	
	public static function ajoutPanier(){
		$plats_resto = Plats::findByResto($_POST['resto']);
		foreach($plats_resto as $plat){
			if($_POST[$plat->__get('id')] > 0)
				Panier::add($plat->__get('id'), $_POST[$plat->__get('id')]);
		}
		self::panier();
	}
	
	public static function panier(){
		
	}
}

?>