<?php 

class Theme {

	private $id;
	private $nom;
	private $description;
	private $photo;

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
		if (property_exists(__CLASS__, $attr_name)) {
			return $this -> $attr_name = $attr_val;
		}
		$emess = __CLASS__ . ": unknown member $attr_name (setAttr)";
		throw new Exception($emess, 46);
	}

	public function update() {
		if (!isset($this->id)) {
	     	throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
		}
		$c = Base::getConnection();
	    $query = $c->prepare( "UPDATE theme set nom= ?, description = ?, photo = ? where id=?");
		$query->bindParam (1, $this->description, PDO::PARAM_STR);
		$query->bindParam (2, $this->titre, PDO::PARAM_STR); 
		$query->bindParam (3, $this->photo, PDO::PARAM_STR); 
		$query->bindParam (4, $this->id, PDO::PARAM_INT); 
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
		$query = $c->prepare("INSERT INTO theme (nom, description, photo) VALUES ( ?, ? , ?)");
	
	    $query->bindParam (1, $this->nom, PDO::PARAM_STR);
	    $query->bindParam (2, $this->description, PDO::PARAM_STR); 
	    $query->bindParam (3, $this->photo, PDO::PARAM_INT);
	    
	    $query->execute();
	    $this->id = $c->LastInsertId("theme");
  
  }

	public static function findAll() {
		$c = Base::getConnection();
		$query = $c->prepare("SELECT * from theme") ;
		$rowbres = $query -> execute();
		
		$themes = array();
		while($row = $query->fetch(PDO::FETCH_BOTH)){
			$theme = new Theme();
			$theme-> __set('id', $row['id']);
			$theme-> __set('nom', $row['nom']);
			$theme-> __set('description', $row['description']);
			$theme-> __set('photo', $row['photo']);	
			$themes[] = $theme;
		}
		return $themes;
	}

}