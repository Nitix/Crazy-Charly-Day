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
		$restoByTheme = restaurant::findByTheme($res);
		$v = new vue($restoByTheme);
		$v->restoVue("listeResto");
	}


	protected function listePlats($tab){
		$res=$tab["id"];
		$platsByResto = plats::findByResto($res);		
		$v = new vue($platsByResto);
		$v->restoVue("listePlats");
	}

	// action par defaut de la page visiteur
	protected function Home(){
		$alltheme = theme::findAll();
		$v = new vue($alltheme);
		$v->restoVue("listeTheme"); 
	}
}

?>