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
	
	if (($data['a']="resto")) {
		$chem1 = ">Restaurant";
	} else if ($data['a']="panier") {
			$chem1=">Panier";
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
					<h1><a href="Accueil">Le Déjeuner Facile</a></h1>
					<h4>Choisissez, Commandez, Vennez chercher, ou faites vous livrer.
				</div>
				<span class=titre>Super ultra-unlimited PHP Zord team 2.0<br />Mmmmh tellememont de choix</span>
				<a href="Panier"><button>Panier : '.Panier::calculTotal().' €</button></a>
			</header>
			<p> <a href="Accueil"> Théme > '.$chem1.'</a> </p>
			<section>'.$body.'</section><br />

		</body>
	</html>';
	}
	
	public function listeTheme(){
		$html = '<section>';
		foreach($this->data as $theme){
			$html .= '<div class = "theme"><div class = "centreTheme"> <a href="Restaurant-'.$theme->__get('id').'">'.$theme->__get('nom').'</a>';
			$html .= '<a href="Restaurant-'.$theme->__get('id').'"><img src="ressource/images_theme/'.$theme->__get('photo').'" /></a>';
			$html .= '</div></div>';
		}
		$html .= '</section>';
		return $html;
	}
	
	public function listeResto(){
		$html = '<section>';
		foreach($this->data as $resto){
			$html .= '<div class ="affResto">';
			$html .= '<div class = "Resto"><div class = "centreResto"><a href="Plats-'.$resto->__get('id').'"><img src="ressource/images_resto/'.$resto->__get('photo').'" /></a></div></div>';
			$html .= '<div class ="descripResto"><a href="Plats-'.$resto->__get('id').'"><h3>'.$resto->__get('nom').'</h3></a><p>'.$resto->__get('description').'</p></div></div>';

			//$html .= '<article><a href="Plats-'.$resto->__get('id').'"><img src="Ressource/images_resto/'.$resto->__get('photo').'" /><h3>'.$resto->__get('nom').'</h3></a><p>'.$resto->__get('description').'</article>';
		}
		$html .= '</section>';
		return $html;
	}
	
	public function listePlats(){
		$html = '<div class = "affplat"><div class="info"><h2>'.$this->data['resto']->__get('nom').'</h2>
											<div>Description : '.$this->data['resto']->__get('description').'<br />
											Adresse : '.$this->data['resto']->__get('adresse').'<br />
											Contact : '.$this->data['resto']->__get('nom').'</div></div>';

		$html .= '<div class = "image"><img src="ressource/images_resto/'.$this->data['resto']->__get('photo').'" /></div></div>';


				
		
		$html .='<form method="post" action="Panier"><legend>Carte</legend><table id="first">';
		for($i = 0;$i<round(count($this->data['plats']) / 2); $i++){			
			$html .= '<tr><td><input class ="saisie" type="number" min="0" value="0" name='.$this->data['plats'][$i]->__get('id').'></td>
			<td>'.$this->data['plats'][$i]->__get('nom').'</td>
			<td>'.$this->data['plats'][$i]->__get('prix').' €</td>
			</tr>';
		}
		$html .= '</table><table id = "second">';
		for($i = round(count($this->data['plats']) / 2);$i<count($this->data['plats']); $i++){			
			$html .= '<tr><td><input class ="saisie" type="number" min="0" value="0" name='.$this->data['plats'][$i]->__get('id').'></td>
			<td>'.$this->data['plats'][$i]->__get('nom').'</td>
			<td>'.$this->data['plats'][$i]->__get('prix').' €</td>
			</tr>';
		}
		$html .= '</table><input type="hidden" value="'.$this->data['resto']->__get('id').'" name="resto"><input type="submit" value="Ajouter au panier"></form></section>';
		return $html;
	}

	public function panier(){
		$html = '<form ACTION="Panier" method = post><table>';
		$panier = $this->data;
		$html =$html."<tr>
		<th>Nom Plat</th>
		<th>Prix Unitaire</th>
		<th>Quantité</th>
		<th>Prix Total</th>
		</tr>";
		foreach ($panier as $value) {
			$html = $html."<tr><td>".$value["Plat"]->nom.
							"</td><td>".$value["Plat"]->prix.
							'</td><td><input type="number" min="0" value='.$value['Nb'].' name='.$value['Plat']->id.' />'.
							"</td><td>".$value["PrixTot"].
							"</td><td><button type=submit name=supprimer value=".$value['Plat']->id.">Supprimer</button></td>
							</tr>";
		}
		$html =$html."<tr>
		<td><input type=submit name ='Vider'value ='Vider le Panier'></td>
		<td></td>
		<td><strong>Total</strong></td>
		<td>".Panier::calculTotal().'</td>
		<input type="hidden" name="update" />
		<td><input type=submit value ="Mise a jour"></td>
		</tr>';
		$html = $html."</table></form>";
		return $html;
	}
}
