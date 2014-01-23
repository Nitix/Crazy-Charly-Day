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
			throw $e;
			$body = "<section>Méthode d'affichage non correct</section>";
		}
	echo '<!DOCTYPE html>
	<html lang="fr">
		<head>
			<meta charset="utf-8">
			<title>Super ultra-unlimited PHP Zord team 2.0</title>
			<link rel="stylesheet" href="ressource/style.css"/>
		</head>
		<body>
			<header>
				<div id="logo">
					<h1>Le Déjeuner Facile</h1>
					<h4>Choisissez, Commandez, Vennez chercher, ou faites vous livrer.
				</div>
				<span class=titre>Super ultra-unlimited PHP Zord team 2.0<br />Mmmmh tellememont de choix</span>
				<button>Panier</button>
			</header>
			<section>'.$body.'</section><br />
		</body>
	</html>';
	}
	
	public function listeTheme(){
		$html = '<section>';
		foreach($this->data as $theme){
			$html .= '<article><a href="resto.php?a=resto&amp;id='.$theme->__get('id').'"><img src="'.$theme->__get('photo').'" />'.$theme->__get('nom').'</a></article>';
		}
		$html .= '</section>';
		return $html;
	}
	
	public function listeResto(){
		$html = '<section>';
		foreach($this->data as $resto){
			$html .= '<article><a href="resto.php?a=plats&amp;id='.$resto->__get('id').'"><img src="'.$resto->__get('photo').'" /><h3>'.$resto->__get('nom').'</h3></a><p>'.$resto->__get('description').'</article>';
		}
		$html .= '</section>';
		return $html;
	}
	
	public function listePlats(){
		$html = '<section><form action="resto.php?a=addPanier"><fieldset><legend>Carte</legend><table>';
		for($i = 0;$i<count($this->data) / 2; $i++){			
			$html .= '<tr><td><input type="number" min="0" name='.$this->data[$i]->__get['id'].'></td>
			<td>'.$this->data[$i]->__get['nom'].'</td>
			<td>'.$this->data[$i]->__get['prix'].'</td>
			</tr>';
		}
		$html .= '</table><table>';
		for($i = count($this->data) / 2;$i<count($this->data); $i++){			
			$html .= '<tr><td><input type="number" min="0" name='.$this->data[$i]->__get['id'].'></td>
			<td>'.$this->data[$i]->__get['nom'].'</td>
			<td>'.$this->data[$i]->__get['prix'].'</td>
			</tr>';
		}
		$html .= '</table><input type="submit" value="Ajouter au panier"></form></section>';
		return $html;
	}
}
