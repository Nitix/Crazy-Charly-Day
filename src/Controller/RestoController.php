<?php

class RestoController extends Controller{

	public function __construct(){
		$this->action = array(
		    "theme"   => "listeTheme" ,
		    "resto"  => "listeResto",
		    "plats"  => "listePlats"
		);
	} 

	protected function listeTheme(){
		$alltheme = theme::findAll();
		$v = new vue($alltheme);
		$v->restoVue("listeTheme"); 
	}

	protected function listeResto($tab){
		$res=$tab["id"];
		$billet=Billet::findById($res);
		$autor=utilisateur::findById($billet->id_util);
		$lcat = Categorie::findAll();
		$dixbillet = Billet::findten();
		$v = new vue($billet, $lcat, $dixbillet, $autor);
		$v->affichegeneral("billet");
	}


	protected function listePlats($tab){
		$res=$tab["id"];
		$bcat=Billet::findByCatId($res);
		$lcat = Categorie::findAll();
		$dixbillet = Billet::findten();
		$v = new vue($bcat, $lcat, $dixbillet, null);
		$v->affichegeneral("Listebillet");
	}

	// action par defaut de la page visiteur
	protected function Home(){
		$allbillets =Billet::findAll();
		$lcat = Categorie::findAll();
		$dixbillet = Billet::findten();
		$v = new vue($allbillets, $lcat, $dixbillet, null);
		$v->affichegeneral("ListeBillet");
	}
}

?>