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
					<h1><a href="resto.php?">Le Déjeuner Facile</a></h1>
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
			$html .= '<div class = "theme"><div class = "centreTheme"> <a href="resto.php?a=resto&amp;id='.$theme->__get('id').'">'.$theme->__get('nom').'</a>';
			$html .= '<a href="resto.php?a=resto&amp;id='.$theme->__get('id').'"><img src="Ressource/images_theme/'.$theme->__get('photo').'" /></a>';
			$html .= '</div></div>';
		}
		$html .= '</section>';
		return $html;
	}
	
	public function listeResto(){
		$html = '<section>';
		foreach($this->data as $resto){
			$html .= '<div class = "Resto"><div class = "centreResto"><a href="resto.php?a=plats&amp;id='.$resto->__get('id').'"><img src="Ressource/images_resto/'.$resto->__get('photo').'" /></a></div></div>';


			//$html .= '<article><a href="resto.php?a=plats&amp;id='.$resto->__get('id').'"><img src="Ressource/images_resto/'.$resto->__get('photo').'" /><h3>'.$resto->__get('nom').'</h3></a><p>'.$resto->__get('description').'</article>';
		}
		$html .= '</section>';
		return $html;
	}
	
	public function listePlats(){
		$html = '<section><article><h2>'.$this->data['resto']->__get('nom').'</h2>
		<div>Description : '.$this->data['resto']->__get('description').'<br />
		Adresse : '.$this->data['resto']->__get('adresse').'<br />
		Contact : '.$this->data['resto']->__get('nom').'</div>
		<img src="Ressource/images_resto/'.$this->data['resto']->__get('photo').'" />		
		<form method="post" action="resto.php?a=panier"><fieldset><legend>Carte</legend><table>';
		for($i = 0;$i<round(count($this->data['plats']) / 2); $i++){			
			$html .= '<tr><td><input type="number" min="0" value="0" name='.$this->data['plats'][$i]->__get('id').'></td>
			<td>'.$this->data['plats'][$i]->__get('nom').'</td>
			<td>'.$this->data['plats'][$i]->__get('prix').'</td>
			</tr>';
		}
		$html .= '</table><table>';
		for($i = round(count($this->data['plats']) / 2);$i<count($this->data['plats']); $i++){			
			$html .= '<tr><td><input type="number" min="0" value="0" name='.$this->data['plats'][$i]->__get('id').'></td>
			<td>'.$this->data['plats'][$i]->__get('nom').'</td>
			<td>'.$this->data['plats'][$i]->__get('prix').'</td>
			</tr>';
		}
		$html .= '</table><input type="hidden" value="'.$this->data['resto']->__get('id').'" name="resto"><input type="submit" value="Ajouter au panier"></form></section>';
		return $html;
	}

	public function panier(){
		$html = '<span style="font-size: 1200%">YOLO</span>';
		return $html;
	}
}
