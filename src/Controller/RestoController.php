<?php

class RestoController extends Controller {

	protected static $actions = array("theme" => "listeTheme", "resto" => "listeResto", "plats" => "listePlats", "panier" => "panier");

	public static function listeTheme() {
		$alltheme = Theme::findAll();
		$v = new RestoVue($alltheme);
		$v -> displayPage("listeTheme");
	}

	public static function listeResto() {
		$res = $_GET["id"];
		$restoByTheme = Restaurant::findByTheme($res);
		$v = new RestoVue($restoByTheme);
		$v -> displayPage("listeResto");
	}

	public static function listePlats() {
		$res = $_GET["id"];
		$data['plats'] = Plats::findByResto($res);
		$data['resto'] = Restaurant::findById($res);
		$v = new RestoVue($data);
		$v -> displayPage("listePlats");
	}

	// action par defaut de la page visiteur
	public static function home() {
		self::listeTheme();
	}

	public static function panier() {		
		if (isset($_POST['resto'])) {
			$plats_resto = Plats::findByResto($_POST['resto']);
			foreach ($plats_resto as $plat) {
				if (intval($_POST[$plat -> __get('id')]) > 0)
					Panier::add($plat -> __get('id'), $_POST[$plat -> __get('id')]);
			}
		}
		if(isset($_POST['update'])){
			$plats_resto = Panier::getArray();
			foreach ($plats_resto as $key => $value) {
				if(intval($_POST[$key]) != $value){
					Panier::modif($key, $_POST[$key]);
				}
			}
		}
		$panier = Panier::getPanier();
		$v = new RestoVue($panier);
		$v->displayPage('panier');
	}

}
?>