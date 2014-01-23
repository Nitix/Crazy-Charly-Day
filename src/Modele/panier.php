<?php

class panier{

	private $idutil;
	private $idplats;
	private $nd;


  public function __construct() {
    // rien à faire
  }


  
  public function __toString() {
        return "id : ". $this->id . "
				  titre : ". $this->titre  ."
				  description : ". $this->body."
          categorie : ".$this->cat_id."
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
    

    $query = $c->prepare( "UPDATE billets set titre= ?, body= ? , cat_id= ?, date = ?
				                   where id=?");
    
    /* 
     * liaison des paramêtres : 
    */
    $query->bindParam (1, $this->titre, PDO::PARAM_STR);
    $query->bindParam (2, $this->body, PDO::PARAM_STR); 
    $query->bindParam (3, $this->cat_id, PDO::PARAM_INT);
    $query->bindParam (4, $this->date, PDO::PARAM_STR);  
    $query->bindParam (5, $this->id, PDO::PARAM_INT); 

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
    $query = $c->prepare( "DELETE from billets where id=?");
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
    $query = $c->prepare("INSERT INTO billets (titre, body, cat_id, date) VALUES ( ?, ? , ? ,? )");

    $query->bindParam (1, $this->titre, PDO::PARAM_STR);
    $query->bindParam (2, $this->body, PDO::PARAM_STR); 
    $query->bindParam (3, $this->cat_id, PDO::PARAM_INT);
    $query->bindParam (4, $this->date, PDO::PARAM_STR); 
    
    $query->execute();
    $this->id = $c->LastInsertId("billets");
    
  }
		

 /**
   *   Finder sur ID
   *
   *   Retrouve la ligne de la table correspondant au ID passé en paramètre,
   *   retourne un objet
   *  
   *   @static
   *   @param integer $id OID to find
   *   @return billets renvoie un objet de type billets
   */
    public static function findById($id) {  

      $c = Base::getConnection();
      $query = $c->prepare("SELECT * from billets where id=?") ;
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


    
    /**
     *   Finder All
     *
     *   Renvoie toutes les lignes de la table billets
     *   sous la forme d'un tableau d'objet
     *  
     *   @static
     *   @return Array renvoie un tableau de billets
     */
    
    public static function findAll() { 
      
      $c = Base::getConnection();
      $reponse = $c->prepare("SELECT * FROM billets");
      $dbres = $reponse->execute(); 
      while ($d = $reponse->fetch(PDO::FETCH_BOTH)){

      $bil = new Billet();
      $bil->id=$d['id'];
      $bil->titre = $d['titre'];
      $bil->body = $d['body'];
      $bil->cat_id = $d['cat_id'];
      $bil->date = $d['date'];

      $tab[$bil->id] = $bil;

      }

      return $tab;

    }

  public static function findByTitre($title){
    $c = Base::getConnection();
    $query = $c->prepare("SELECT * from billets where titre=?") ;
    $query->bindParam(1, $title, PDO::PARAM_INT);
    $dbres = $query->execute();
    $bil = 0;

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


 public static function findAllByCateg($id_cat) {
   $c = Base::getConnection();
      $tab = NULL;
      $reponse = $c->prepare("SELECT * FROM billets where cat_id=?");
      $reponse->bindParam(1, $id_cat, PDO::PARAM_INT);
      $dbres = $reponse->execute(); 

      while ($d = $reponse->fetch(PDO::FETCH_BOTH)){
      $bil = new Billet();
      $bil->id=$d['id'];
      $bil->titre = $d['titre'];
      $bil->body = $d['body'];
      $bil->cat_id = $d['cat_id'];
      $bil->date = $d['date'];

      $tab[$bil->id] = $bil;

      }

      return $tab;
  }


}