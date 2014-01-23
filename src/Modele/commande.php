<?php

class Commande{

	private idcom;
	private idutil;
	private domicile;
	private adresse;
	
	public function __construct() {}

	
	public function __toString() {
        return "idCommande : ". $this->idcom . "
		idUtilisateur : ". $this->idutil  ."
		domicile : ". $this->domicile."
          	adresse : ".$this->adresse ;
	}

	public function __get($attr_name) {
		if (property_exists( __CLASS__, $attr_name)) { 
		return $this->$attr_name;
		} 
	$emess = __CLASS__ . ": unknown member $attr_name (getAttr)";
	throw new Exception($emess, 45);
	}
	
	public function __set($attr_name, $attr_val) { 
		$this->$attr_name = $attr_val;
 	}
