<?php

class PLats{

	private $id;
	private $nom;
	private $description;
	private $prix;
	private $photo;

	public function __toString() {
        return "[". __CLASS__ . "] id : ". $this->id . ":
				   nom  ". $this->nom  .":
				   description ". $this->description."
				   prix". $this->prix."
				   photo". $this->photo  ;
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
    

    $query = $c->prepare( "UPDATE plats set nom= ?, description= ?, prix =  ?, photo =?
				                   where id=?");

    $query->bindParam (1, $this->nom, PDO::PARAM_STR);
    $query->bindParam (2, $this->description, PDO::PARAM_STR); 
    $query->bindParam (3, $this->prix, PDO::PARAM_INT); 
    $query->bindParam (4, $this->photo, PDO::PARAM_INT); 
    $query->bindParam (5, $this->id, PDO::PARAM_INT); 



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
    $query = $c->prepare( "DELETE from plats where id=?");
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

   /*
    *  A ECRIRE :
    *  CONSTRUIT et exécute LA REQUETE
    *  INSERT INTO plats (nom, description) VALUES ( 'nom', 'desription' )
    *  PUIS PLACE LA VALEUR DE ID (AUTO-INCREMENT)
    *  DANS L'OBJET COURANT (UTILISE pour cela LA méthode pdo LastInsertId)
    */
   if (isset($this->id)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    $c = Base::getConnection();
    $query = $c->prepare("INSERT INTO plats (nom, description, prix, photo) VALUES ( ?, ? ,? ,?)");

    $query->bindParam (1, $this->nom, PDO::PARAM_STR);
    $query->bindParam (2, $this->description, PDO::PARAM_STR); 
    $query->bindParam (3, $this->prix, PDO::PARAM_INT); 
    $query->bindParam (4, $this->photo, PDO::PARAM_INT); 
    
    $query->execute();
    $this->id = $c->LastInsertId("plats");
    
  }


 /**
   *   Finder sur ID
   *
   *   Retrouve la ligne de la table correspondant au ID passé en paramètre,
   *   retourne un objet
   *  
   *   @static
   *   @param integer $id OID to find
   *   @return plats renvoie un objet de type plats
   */
    public static function findById($id) {  

      $c = Base::getConnection();
      $query = $c->prepare("SELECT * from plats where id=?") ;
      $query->bindParam(1, $id, PDO::PARAM_INT);
      $dbres = $query->execute();

      $d = $query->fetch(PDO::FETCH_BOTH);
      $cat = new plats();
      $cat->id=$d['id'];
      $cat->nom = $d['nom'];
      $cat->description = $d['description'];
      $cat->photo = $d['photo'];
      $cat->prix = $d['prix'];
      return $cat;
    }

    
    /**
     *   Finder All
     *
     *   Renvoie toutes les lignes de la table plats
     *   sous la forme d'un tableau d'objet
     *  
     *   @static
     *   @return Array renvoie un tableau de plats
     */
    
    public static function findAll() { 
      
      $c = Base::getConnection();
      $reponse = $c->prepare("SELECT * FROM plats");
      $dbres = $reponse->execute(); 

      while ($d = $reponse->fetch(PDO::FETCH_BOTH)){

      $cat = new plats();
      $cat->id=$d['id'];
      $cat->nom = $d['nom'];
      $cat->description = $d['description'];
      $cat->photo = $d['photo'];
      $cat->prix = $d['prix'];

      $tab[$cat->id] = $cat;

      }

      return $tab;

    }

  public static function findBynom($title){
    $c = Base::getConnection();
    $query = $c->prepare("SELECT * from plats where nom=?") ;
    $query->bindParam(1, $title, PDO::PARAM_INT);
    $dbres = $query->execute();


    $d = $query->fetch(PDO::FETCH_BOTH);
$cat = new plats();
      $cat->id=$d['id'];
      $cat->nom = $d['nom'];
      $cat->description = $d['description'];
      $cat->photo = $d['photo'];
      $cat->prix = $d['prix'];

    return $cat;
    }



}