<?php 

class Theme {

	private $id;
	private $nom;
	private $descri;

		public function __construct(){}
	
	public function __toString() {
      	  return "id : ". $this->id . "
		nom : ". $this->nom  ."				  
          	date : ".$this->date ;
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
    	$query = $c->prepare( "UPDATE theme set nom= ?, descri= ? where id=?");
	$query->bindParam (1, $this->descri, PDO::PARAM_STR);
	$query->bindParam (2, $this->titre, PDO::PARAM_STR); 
	$query->bindParam (3, $this->id, PDO::PARAM_INT); 
	return $query->execute();
	}

	public function delete() { 
		if (!isset($this->id)) {
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    		} 
    	$c = Base::getConnection(); 
    	$query = $c->prepare( "DELETE from theme where id=?");
   	$query->bindParam (1, $this->id, PDO::PARAM_INT); 
    	$query->execute();
 	}

	public function insert() { 
	   if (isset($this->id)) {
	   		throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    	} 
   	$c = Base::getConnection();
	$query = $c->prepare("INSERT INTO theme (id, nom, descri) VALUES ( ?, ? , ? S)");

    $query->bindParam (1, $this->titre, PDO::PARAM_STR);
    $query->bindParam (2, $this->body, PDO::PARAM_STR); 
    $query->bindParam (3, $this->cat_id, PDO::PARAM_INT);
    $query->bindParam (4, $this->date, PDO::PARAM_STR); 
    
    $query->execute();
    $this->id = $c->LastInsertId("theme");
    
  }

	public static function findAll() {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT DISTINCT nom from theme") ;
	}

}