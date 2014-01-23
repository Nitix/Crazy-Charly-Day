<?php

class utilisateur{

	private $id;
	private $login;
	private $mp;
	private $eemail;



public function __construct(){
//rien a faire
}

public function __toString() {
        return "[". __CLASS__ . "] id : ". $this->id . ":
				   login  ". $this->login .":
				   email ". $this->email  ;
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
    

    $query = $c->prepare( "UPDATE utilisateur set login = ?, mp = ?,email = ?
                           where id=?");

    $query->bindParam (1, $this->login, PDO::PARAM_STR);
    $query->bindParam (2, $this->mp, PDO::PARAM_STR); 
    $query->bindParam (3, $this->email, PDO::PARAM_STR); 
    $query->bindParam (4, $this->id, PDO::PARAM_INT);


    return $query->execute();
  }


  public function delete() { 
    
      if (!isset($this->id)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    $c = Base::getConnection(); 
    $query = $c->prepare( "DELETE from utilisateur where id=?");
     //liaison des paramêtres : 

    $query->bindParam (1, $this->id, PDO::PARAM_INT); 
    $query->execute();
  }


    
  public function insert() { 

   if (isset($this->id)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    $c = Base::getConnection();
    $query = $c->prepare("INSERT INTO utilisateur (login, mp, email) VALUES ( ?, ?,? )");

    $query->bindParam(1, $this->login, PDO::PARAM_STR);
    $query->bindParam(2, $this->mp, PDO::PARAM_STR);
    $query->bindParam (3, $this->email, PDO::PARAM_STR);
    $query->execute();
    $this->id = $c->LastInsertId("utilisateur");
    
  }


    /**
     *   Finder All
     *
     *   Renvoie toutes les lignes de la table utilisateur
     *   sous la forme d'un tableau d'objet
     *  
     *   @static
     *   @return Array renvoie un tableau de utilisateur
     */
    
    public static function findAll() { 
      
    $c = Base::getConnection();
    $reponse = $c->prepare("SELECT * FROM utilisateur");
    $dbres = $reponse->execute(); 

    while ($d = $reponse->fetch(PDO::FETCH_BOTH)){

    $cat = new utilisateur();
    $cat->id=$d['id'];
    $cat->login=$d['login'];
    $cat->email=$d['email'];

    $tab[$cat->login] = $cat;

    }
    return $tab;

  }


  public static function findByLogin($title){
    $c = Base::getConnection();
    $query = $c->prepare("SELECT * from utilisateur where login=?") ;
    $query->bindParam(1, $title, PDO::PARAM_STR);
    $dbres = $query->execute();


    $d = $query->fetch(PDO::FETCH_BOTH);
    $cat = new utilisateur();
    $cat->id=$d['id'];
    $cat->login = $d['login'];
    $cat->email = $d['email'];

    return $cat;
  
  }


  public static function findById($title){
    $c = Base::getConnection();
    $query = $c->prepare("SELECT * from utilisateur where id=?") ;
    $query->bindParam(1, $title, PDO::PARAM_STR);
    $dbres = $query->execute();


    $d = $query->fetch(PDO::FETCH_BOTH);
    $cat = new utilisateur();
    $cat->id=$d['id'];
    $cat->login = $d['login'];
    $cat->email = $d['email'];

    return $cat;

  }

  public static function verif($id,$mdp){
    $c = Base::getConnection();
    $query = $c->prepare("SELECT count(*) from utilisateur where login=? and mp =?") ;
    $query->bindParam(1, $id, PDO::PARAM_STR);
    $query->bindParam(2, $mdp, PDO::PARAM_STR);
    $dbres = $query->execute();
    $d = $query->fetch(PDO::FETCH_BOTH);

    if($d[0] == 1) return "1";
    else return "0";
  }

 
}