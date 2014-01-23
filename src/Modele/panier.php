<?php

class panier{


  public function __construct() {
    // rien à faire
  }
 
   
   public function __get($attr_name) {
    if (property_exists( __CLASS__, $attr_name)) { 
      return $this->$attr_name;
    } 


    $emess = __CLASS__ . ": unknown member $attr_name (getAttr)";
    throw new Exception($emess, 45);
  }


    public function add($id_plat, $quantite) {
    if(!isset($_SESSION['panier'][$id_plat])){
      $_SESSION['panier'][$id_plat] = $quantite;
    }else{
      $_SESSION['panier'][$id_plat] += $quantite;
    }
  }

  public function modif($id_plat, $quantite) {
    if($quantite == 0){
      $this->delete($idplats);
    }else{
      $_SESSION['panier'][$id_plat] = $quantite;
    }
  }


  public function delete($id_plat) { 
     unset($_SESSION['panier'][$id_plat]);
  }
		

}