<?php

/**
 * Classe généric permettant d'appeller les fonctions demandées
 */
abstract class Controller {
	
	/**
	 * Appelle l'action demandée
	 */
	public static function callAction(){
		if(isset($_GET['a'])){
			if(array_key_exists($_GET['a'], static::$actions))
				return static::$actions[$_GET['a']];
			else 
				return 'home';
		}else{
			return 'home';
		}
	}
}
