<?php

class RestoController extends Controller{

	public function __construct(){
		$this->action = array(
		    "theme"   => "listTheme" ,
		    "resto"  => "listeResto",
		    "plats"  => "listePlats"
		);
	} 

	protected function listAction(){
		$allbillets =Billet::findAll();
		$lcat = Categorie::findAll();
		$dixbillet = Billet::findten();
		$v = new vue($allbillets, $lcat, $dixbillet, null);
		$v->affichegeneral("Listebillet"); 
	}

	protected function detailAction($tab){
		$res=$tab["id"];
		$billet=Billet::findById($res);
		$autor=utilisateur::findById($billet->id_util);
		$lcat = Categorie::findAll();
		$dixbillet = Billet::findten();
		$v = new vue($billet, $lcat, $dixbillet, $autor);
		$v->affichegeneral("billet");
	}


	protected function catAction($tab){
		$res=$tab["id"];
		$bcat=Billet::findByCatId($res);
		$lcat = Categorie::findAll();
		$dixbillet = Billet::findten();
		$v = new vue($bcat, $lcat, $dixbillet, null);
		$v->affichegeneral("Listebillet");
	}

	// action par defaut de la page visiteur
	protected function defaultA(){
		$allbillets =Billet::findAll();
		$lcat = Categorie::findAll();
		$dixbillet = Billet::findten();
		$v = new vue($allbillets, $lcat, $dixbillet, null);
		$v->affichegeneral("ListeBillet");
	}
}

?>