<?php

class panier{

	private $idutil;
	private $idplats;
	private $nd;


  public function __construct() {
    // rien à faire
  }


  
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
    

    $query = $c->prepare( "UPDATE panier set nb=?
				                   where idutil = ?, idplats=?");
    
    /* 
     * liaison des paramêtres : 
    */
    $query->bindParam (1, $this->nb, PDO::PARAM_STR);
    $query->bindParam (2, $this->idutil, PDO::PARAM_STR); 
    $query->bindParam (3, $this->idplats, PDO::PARAM_INT);

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
    
    if (!isset($this->idutil) || !isset($this->idplats) ) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    $c = Base::getConnection(); 
    $query = $c->prepare( "DELETE from panier where idutil=? ,idplats=?");
     //liaison des paramêtres : 

    $query->bindParam (1, $this->id_util, PDO::PARAM_INT);
    $query->bindParam (2, $this->idplats, PDO::PARAM_INT); 
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
    $query = $c->prepare("INSERT INTO panier (nb, idutil, idplats) VALUES ( ?, ? , ? )");

    $query->bindParam (1, $this->nb, PDO::PARAM_STR);
    $query->bindParam (2, $this->idutil, PDO::PARAM_STR); 
    $query->bindParam (3, $this->idplats, PDO::PARAM_INT);
    
    $query->execute();

    
  }
		

 /**
   *   Finder sur ID
   *
   *   Retrouve la ligne de la table correspondant au ID passé en paramètre,
   *   retourne un objet
   *  
   *   @static
   *   @param integer $id OID to find
   *   @return panier renvoie un objet de type panier
   */
    public static function findByIdUtil($id) {  

      $c = Base::getConnection();
      $query = $c->prepare("SELECT * from panier where idutil =?") ;
    $query->bindParam (1, $id, PDO::PARAM_INT); 
      $dbres = $query->execute();
      $bil = null;

      if($d = $query->fetch(PDO::FETCH_BOTH)){
        $bil = new panier();
        $bil->idutil=$d['idutil'];
    	$bil->idplats=$d['idplats'];
    	$bil->nb=$d['nb'];
      }
      return $bil;
    }


    
    /**
     *   Finder All
     *
     *   Renvoie toutes les lignes de la table panier
     *   sous la forme d'un tableau d'objet
     *  
     *   @static
     *   @return Array renvoie un tableau de panier
     */
    
    public static function findAll() { 
      
      $c = Base::getConnection();
      $reponse = $c->prepare("SELECT * FROM panier");
      $dbres = $reponse->execute(); 
      while ($d = $reponse->fetch(PDO::FETCH_BOTH)){

		$bil = new panier();
		$bil->idutil=$d['idutil'];
		$bil->idplats=$d['idplats'];
		$bil->nb=$d['nb'];

      $tab[$bil->id] = $bil;

      }

      return $tab;

    }

}