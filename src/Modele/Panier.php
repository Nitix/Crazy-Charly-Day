<?php

class Panier {

	public static function add($id_plat, $quantite) {
		if (!isset($_SESSION['panier'][$id_plat])) {
			$_SESSION['panier'][$id_plat] = $quantite;
		} else {
			$_SESSION['panier'][$id_plat] += $quantite;
		}
	}

	public static function modif($id_plat, $quantite) {
		if ($quantite == 0) {
			$this -> delete($idplats);
		} else {
			$_SESSION['panier'][$id_plat] = $quantite;
		}
	}

	public static function getPanier() {
		$tab = array();
		if (isser($_SESSION['panier'])) {
			foreach ($_SESSION['panier'] as $key => $value) {
				$plat = Plats::findById($key);
				$tab2 = array('Plat' => $plat, 'Nb' => $value, 'PrixTot' => $value * $plat -> prix);
				$tab[] = $tab2;
			}
		}
		return ($tab);
	}

	public static function delete($id_plat) {
		unset($_SESSION['panier'][$id_plat]);
	}

	public static function calculTotal() {
		$total = 0;
		if (isser($_SESSION['panier'])) {
			foreach ($_SESSION['panier'] as $key => $value) {
				$total += Plats::findById($key) -> prix * $value;
			}
		}
		return $total;
	}

}