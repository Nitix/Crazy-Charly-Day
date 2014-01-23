<?php

class RestoVue
{
	private $data;
	
	public function __construct($data){
		$this->data = $data;
	}
	
	public function displayPage($action){
		try{
			$body = $this->$action();
		}catch(Exception $e){
			if(DEBUG)
				throw $e; 
			$body = "<section>Méthode d'affichage non correct</section>";
		}
	echo '<!DOCTYPE html>
	<html lang="fr">
		<head>
			<meta charset="utf-8">
			<title>Super ultra-unlimited PHP Zord team 2.0</title>
			<link rel="stylesheet" href="data/css/site.css"/>
		</head>
		<body>
			<header><span class=titre>Super ultra-unlimited PHP Zord team 2.0</span><br />Mmmmh tellememont de choix</header>
			<section>'.$body.'</section><br />
		</body>
	</html>';
	}
	
	public function listeTheme(){
		$html = '<section>';
		foreach($this->data as $theme){
			$html .= '<article><a href="resto.php?a=listResto&amp;id='.$theme['id'].'"><img src="'.$theme['image'].'" />'.$theme['nom'].'</a></article>';
		}
		$html .= '</section>';
		return $html;
	}
	
	public function listeResto(){
		$html = '<section>';
		foreach($this->data as $resto){
			$html .= '<article><a href="resto.php?a=listPlats&amp;id='.$theme['id'].'"><img src="'.$resto['image'].'" /><h3>'.$resto['nom'].'</h3></a><p>'.$resto['description'].'</article>';
		}
		$html .= '</section>';
		return $html;
	}
	
	public function listePlats(){
		$html = '<section><form><fieldset><legend>Carte</legend><table>';
		/*for($i = 0;$i<$this->)			
			$html .= '<article><img src="'.$resto['image'].'" /><h3>'.$resto['nom'].'</h3><p>'.$resto['description'].'</article>';
		}*/
		$html .= '</section>';
		return $html;
	}
		/*	<label for="speudo">speudo</label><br />
			<input required autofocus class=speudo type="text" id="speudo" name="speudo" value="'.$this->data['speudo'].'"/><br />
			<label for="password">mot de passe</label><br />
			<input required class=password type="password" id="password" name="password"/><br />
			<input type="submit" value="Se connecter" />*/
}
