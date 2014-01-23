<?php

class restaurant {
	private $id;
	private $nom;
	private $description;
	private $adresse;
	private $contact;
	private $id_theme;

	public function __construct() {}

	//public function getCarte() {} // liste [plat][descri] ?

  public function __toString() {
        return "idutil : ". $this->idutil . "
				  idplats : ". $this->idplats  ."
				  nb : ". $this->nb;
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
    

    $query = $c->prepare( "UPDATE restaurant set nom = ? description = ? adresse = ? contact = ? id_theme = ?
				                   where id=?");
    
    /* 
     * liaison des paramêtres : 
    */
    $query->bindParam (1, $this->nom, PDO::PARAM_STR); 
    $query->bindParam (2, $this->description, PDO::PARAM_STR);
    $query->bindParam (3, $this->adresse, PDO::PARAM_STR);
    $query->bindParam (4, $this->contact, PDO::PARAM_STR);
    $query->bindParam (5, $this->id_theme, PDO::PARAM_INT);
    $query->bindParam (6, $this->id, PDO::PARAM_INT);


    /*
     * exécution de la requête
     */

    return $query->execute();


  }


  /**
   *   Suppression dans la base
   *
   *   Supprime la ligne dans la table corrsepondant à l'objet courant
   *   L'objet doit posséder un OID
   */
  public function delete() { 
    
    if (!isset($this->id)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    $c = Base::getConnection(); 
    $query = $c->prepare( "DELETE from restaurant where id =?");
     //liaison des paramêtres : 

    $query->bindParam (1, $this->id, PDO::PARAM_INT);
    $query->execute();
  }
		
		
  /**
   *   Insertion dans la base
   *
   *   Insère l'objet comme une nouvelle ligne dans la table
   *   l'objet doit posséder  un code_rayon
   *
   */									
  public function insert() { 


   
   if (isset($this->id)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    $c = Base::getConnection();
    $query = $c->prepare("INSERT INTO restaurant (nom, description, adresse, contact, id_theme) VALUES ( ? , ? , ? , ? , ? )");

    $query->bindParam (1, $this->nom, PDO::PARAM_STR); 
    $query->bindParam (2, $this->description, PDO::PARAM_STR);
    $query->bindParam (3, $this->adresse, PDO::PARAM_STR);
    $query->bindParam (4, $this->contact, PDO::PARAM_STR);
    $query->bindParam (5, $this->id_theme, PDO::PARAM_INT);
   	$this->id = $c->LastInsertId("restaurant");
    
    $query->execute();

    
  }
		
    public static function findAll() { 
      
      $c = Base::getConnection();
      $reponse = $c->prepare("SELECT * FROM restaurant");
      $dbres = $reponse->execute(); 

      while ($d = $reponse->fetch(PDO::FETCH_BOTH)){

		$bil = new restaurant();
		$bil->id=$d['id'];
		$bil->nom=$d['nom'];
		$bil->description=$d['description'];
		$bil->adresse=$d['adresse'];
		$bil->contact=$d['contact'];
		$bil->id_theme=$d['id_theme'];


      $tab[$bil->id] = $bil;

      }

      return $tab;

    }
	public static function findByTheme($theme){
		$c = Base::getConnection();
		$reponse = $c->prepare("SELECT * FROM restaurant where id_theme =?");
		$query->bindParam (1, $theme, PDO::PARAM_STR); 
		$dbres = $reponse->execute(); 

      while ($d = $reponse->fetch(PDO::FETCH_BOTH)){

		$bil = new restaurant();
		$bil->id=$d['id'];
		$bil->nom=$d['nom'];
		$bil->description=$d['description'];
		$bil->adresse=$d['adresse'];
		$bil->contact=$d['contact'];
		$bil->id_theme=$d['id_theme'];


      $tab[$bil->id] = $bil;

      }

      return $tab;


	}

}
