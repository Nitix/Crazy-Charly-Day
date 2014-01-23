<?php

class Commande{

	private $idcom;
	private $idutil;
	private $domicile;
	private $adresse;
	
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

	public function update() {
		if (!isset($this->id)) {
		throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    		} 
	$c = Base::getConnection();
    	$query = $c->prepare( "UPDATE commande set idutil= ?, adresse= ? , domicile= ?, where idcom =?");
    
	$query->bindParam (1, $this->idcom, PDO::PARAM_INT);
	$query->bindParam (2, $this->idutil, PDO::PARAM_INT); 
	$query->bindParam (3, $this->domicile, PDO::PARAM_STR);
	$query->bindParam (4, $this->adresse, PDO::PARAM_STR);  

	return $query->execute();
	}

	public function delete() { 
		if (!isset($this->id)) {
		throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
  		} 
	$c = Base::getConnection(); 
	$query = $c->prepare( "DELETE from commande where idcom=?");
	$query->bindParam (1, $this->idcom, PDO::PARAM_INT); 
	$query->execute();
	}

	public function insert() { 
		if (isset($this->idcom)) {
		throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    	} 
    	$c = Base::getConnection();
    	$query = $c->prepare("INSERT INTO commande (idcom, idutil, domicile, adresse) VALUES ( ?, ? , ? ,? )");

   	$query->bindParam (1, $this->idcom, PDO::PARAM_INT);
    	$query->bindParam (2, $this->idutil, PDO::PARAM_INT); 
    	$query->bindParam (3, $this->domicile, PDO::PARAM_STR);
    	$query->bindParam (4, $this->adresse, PDO::PARAM_STR); 
    
   	$query->execute();
   	$this->idcom = $c->LastInsertId("commande");
    	}

	public static function findById($id) {  
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * from commande where idcom=?") ;
		$query->bindParam(1, $id, PDO::PARAM_INT);
		$dbres = $query->execute();
		$bil = null;
		if($d = $query->fetch(PDO::FETCH_BOTH)){
			$bil = new Billet();
        		$bil->id=$d['id'];
        		$bil->titre = $d['titre'];
        		$bil->body = $d['body'];
        		$bil->cat_id = $d['cat_id'];
        		$bil->date = $d['date'];
      		}
	return $bil;
    }

}
